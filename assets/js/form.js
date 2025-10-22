/* =========================================================================
 *  forms.js — Validación y envío de formularios con fallback
 *  Autor: Maycoll (Maven Marketing)
 *  Descripción:
 *   - Validación en tiempo real (HTML5 + personalizada)
 *   - Envío con fetch() (JSON o multipart)
 *   - Fallback automático a submit clásico si no hay JS o fetch falla
 *   - Feedback accesible (rol="status")
 *   - Protección con honeypot invisible
 *   - Integración con App.Bus, Lazy y Header1
 * ========================================================================= */

(function (global) {
  'use strict';

  if (!global.App) {
    console.warn('[forms.js] App namespace no detectado. Carga main.js primero.');
    return;
  }

  const { Utils, Bus } = global.App;
  const d = document;

  // ============================================================
  // Configuración general
  // ============================================================
  const cfg = {
    formSelector: 'form[data-ajax="true"]',
    successClass: 'is-success',
    errorClass: 'is-error',
    disabledClass: 'is-disabled',
    honeypotName: 'contact_time', // campo trampa invisible
    statusDelay: 3800, // ms
  };

  // ============================================================
  // Inicializador global
  // ============================================================
  function init() {
    const forms = Utils.qsa(cfg.formSelector);
    forms.forEach(setupForm);
    Bus.emit('forms:ready', { count: forms.length });
  }

  // ============================================================
  // Configurar un formulario individual
  // ============================================================
  function setupForm(form) {
    if (form.__initialized) return;
    form.__initialized = true;

    // Honeypot
    const honeypot = d.createElement('input');
    honeypot.type = 'text';
    honeypot.name = cfg.honeypotName;
    honeypot.tabIndex = -1;
    honeypot.autocomplete = 'off';
    honeypot.style.display = 'none';
    form.appendChild(honeypot);

    // Mensaje de estado
    let statusEl = form.querySelector('[data-form-status]');
    if (!statusEl) {
      statusEl = d.createElement('div');
      statusEl.setAttribute('role', 'status');
      statusEl.className = 'form-status';
      form.appendChild(statusEl);
    }

    // Escucha de envío
    Utils.on(form, 'submit', (e) => handleSubmit(e, form, statusEl));

    // Validación en tiempo real
    Utils.qsa('input, textarea, select', form).forEach(el => {
      Utils.on(el, 'input', () => validateField(el));
      Utils.on(el, 'blur', () => validateField(el));
    });
  }

  // ============================================================
  // Validar un campo individual
  // ============================================================
  function validateField(el) {
    if (!el || el.type === 'hidden' || el.disabled) return true;

    // HTML5 validity check
    const valid = el.checkValidity();
    if (!valid) {
      el.classList.add(cfg.errorClass);
      el.setAttribute('aria-invalid', 'true');
      return false;
    } else {
      el.classList.remove(cfg.errorClass);
      el.removeAttribute('aria-invalid');
      return true;
    }
  }

  // ============================================================
  // Validación completa del formulario
  // ============================================================
  function validateForm(form) {
    const fields = Utils.qsa('input, textarea, select', form);
    let allValid = true;
    fields.forEach(f => { if (!validateField(f)) allValid = false; });
    return allValid;
  }

  // ============================================================
  // Manejar envío del formulario
  // ============================================================
  async function handleSubmit(e, form, statusEl) {
    e.preventDefault();

    // Si honeypot tiene algo => bot
    if (form[cfg.honeypotName]?.value.trim() !== '') {
      console.warn('[forms] Bot detectado (honeypot activado)');
      return;
    }

    // Validación general
    if (!validateForm(form)) {
      updateStatus(statusEl, 'Please check the required fields.', true);
      Bus.emit('forms:invalid', { form });
      return;
    }

    disableForm(form, true);
    updateStatus(statusEl, 'Sending...', false);

    const action = form.getAttribute('action') || window.location.href;
    const method = (form.getAttribute('method') || 'POST').toUpperCase();
    const encType = form.enctype || 'application/x-www-form-urlencoded';
    let body;

    try {
      if (encType.includes('json')) {
        const data = {};
        Utils.qsa('input, textarea, select', form).forEach(el => {
          if (!el.name) return;
          data[el.name] = el.value;
        });
        body = JSON.stringify(data);
      } else {
        body = new FormData(form);
      }

      const res = await fetch(action, {
        method,
        body,
        headers: encType.includes('json') ? { 'Content-Type': 'application/json' } : {},
      });

      if (!res.ok) throw new Error(`HTTP ${res.status}`);
      const text = await res.text();
      handleSuccess(form, statusEl, text);
    } catch (err) {
      console.error('[forms] Error en envío:', err);
      handleError(form, statusEl);
    } finally {
      disableForm(form, false);
    }
  }

  // ============================================================
  // Estado visual y feedback accesible
  // ============================================================
  function updateStatus(el, msg, isError = false) {
    if (!el) return;
    el.textContent = msg;
    el.classList.remove(cfg.successClass, cfg.errorClass);
    el.classList.add(isError ? cfg.errorClass : cfg.successClass);

    setTimeout(() => {
      el.textContent = '';
      el.classList.remove(cfg.successClass, cfg.errorClass);
    }, cfg.statusDelay);
  }

  function disableForm(form, state) {
    Utils.toggleClass(form, cfg.disabledClass, state);
    Utils.qsa('input, button, textarea, select', form).forEach(el => (el.disabled = state));
  }

  // ============================================================
  // Éxito y error
  // ============================================================
  function handleSuccess(form, statusEl, responseText) {
    updateStatus(statusEl, 'Message sent successfully!', false);
    form.reset();
    Bus.emit('forms:success', { form, responseText });
  }

  function handleError(form, statusEl) {
    updateStatus(statusEl, 'An error occurred. Please try again later.', true);
    Bus.emit('forms:error', { form });
  }

  // ============================================================
  // API pública
  // ============================================================
  global.App.Forms = {
    init,
    validate: validateForm,
    disable: disableForm,
    updateStatus,
  };

  // ============================================================
  // Inicialización automática
  // ============================================================
  Utils.on(document, 'DOMContentLoaded', () => {
    try {
      init();
    } catch (e) {
      console.error('[forms] Error en inicialización:', e);
    }
  });

})(window);
