/* =========================================================================
 * modules/forms.js — Validación y envío de formularios (App.Modules.Forms)
 * Basado en la implementación original de forms.js por Maycoll (Maven Marketing)
 * ========================================================================= */

(function (global) {
  'use strict';

  const App = global.App || (global.App = {});
  const Modules = App.Modules || (App.Modules = {});
  const d = global.document;

  const fallbackUtils = {
    qsa(sel, ctx = d) { return Array.prototype.slice.call(ctx.querySelectorAll(sel)); },
    on(el, evt, fn, opts) { el && el.addEventListener(evt, fn, opts); },
    off(el, evt, fn, opts) { el && el.removeEventListener(evt, fn, opts); },
    toggleClass(el, cls, force) { if (!el || !el.classList) return; el.classList.toggle(cls, force); },
  };

  Modules.Forms = (function () {
    const defaults = {
      formSelector: 'form[data-ajax="true"]',
      successClass: 'is-success',
      errorClass: 'is-error',
      disabledClass: 'is-disabled',
      honeypotName: 'contact_time',
      statusDelay: 3800,
    };

    let utils = fallbackUtils;
    let bus = null;
    let cfg = { ...defaults };
    const initializedForms = new WeakSet();

    function resolveDeps(options = {}) {
      utils = options.utils || App.Utils || fallbackUtils;
      bus = options.bus || App.Bus || null;
      cfg = { ...defaults, ...(options.config || {}) };
    }

    function emit(evt, payload) {
      try { bus && typeof bus.emit === 'function' && bus.emit(evt, payload); }
      catch (err) { console.error('[Forms] emit error', err); }
    }

    function init(options = {}) {
      resolveDeps(options);
      const ctx = options.context || d;
      const forms = utils.qsa(cfg.formSelector, ctx);
      forms.forEach(setupForm);
      emit('forms:ready', { count: forms.length });
      return forms;
    }

    function setupForm(form) {
      if (!form || initializedForms.has(form)) return;
      initializedForms.add(form);

      const statusEl = ensureStatusEl(form);
      addHoneypot(form);

      utils.on(form, 'submit', (e) => handleSubmit(e, form, statusEl));

      utils.qsa('input, textarea, select', form).forEach((el) => {
        utils.on(el, 'input', () => validateField(el));
        utils.on(el, 'blur', () => validateField(el));
      });
    }

    function ensureStatusEl(form) {
      let statusEl = form.querySelector('[data-form-status]');
      if (!statusEl) {
        statusEl = d.createElement('div');
        statusEl.setAttribute('role', 'status');
        statusEl.className = 'form-status';
        form.appendChild(statusEl);
      }
      return statusEl;
    }

    function addHoneypot(form) {
      if (form.querySelector(`[name="${cfg.honeypotName}"]`)) return;
      const honeypot = d.createElement('input');
      honeypot.type = 'text';
      honeypot.name = cfg.honeypotName;
      honeypot.tabIndex = -1;
      honeypot.autocomplete = 'off';
      honeypot.style.display = 'none';
      form.appendChild(honeypot);
    }

    function validateField(el) {
      if (!el || el.type === 'hidden' || el.disabled) return true;
      const valid = el.checkValidity();
      if (!valid) {
        el.classList.add(cfg.errorClass);
        el.setAttribute('aria-invalid', 'true');
      } else {
        el.classList.remove(cfg.errorClass);
        el.removeAttribute('aria-invalid');
      }
      return valid;
    }

    function validateForm(form) {
      const fields = utils.qsa('input, textarea, select', form);
      return fields.every((field) => validateField(field));
    }

    async function handleSubmit(e, form, statusEl) {
      e.preventDefault();

      if (form[cfg.honeypotName]?.value.trim() !== '') {
        console.warn('[Forms] honeypot activado. Ignorando envío.');
        return;
      }

      if (!validateForm(form)) {
        updateStatus(statusEl, 'Please check the required fields.', true);
        emit('forms:invalid', { form });
        return;
      }

      disableForm(form, true);
      updateStatus(statusEl, 'Sending...', false);

      const action = form.getAttribute('action') || global.location.href;
      const method = (form.getAttribute('method') || 'POST').toUpperCase();
      const encType = form.enctype || 'application/x-www-form-urlencoded';

      try {
        const body = buildRequestBody(form, encType);
        const headers = encType.includes('json') ? { 'Content-Type': 'application/json' } : {};
        const res = await fetch(action, { method, body, headers });
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const text = await res.text();
        handleSuccess(form, statusEl, text);
      } catch (err) {
        console.error('[Forms] Error en envío:', err);
        handleError(form, statusEl);
      } finally {
        disableForm(form, false);
      }
    }

    function buildRequestBody(form, encType) {
      if (encType.includes('json')) {
        const data = {};
        utils.qsa('input, textarea, select', form).forEach((el) => {
          if (!el.name) return;
          if (el.type === 'checkbox') data[el.name] = el.checked;
          else if (el.type === 'radio') { if (el.checked) data[el.name] = el.value; }
          else data[el.name] = el.value;
        });
        return JSON.stringify(data);
      }
      return new FormData(form);
    }

    function disableForm(form, state) {
      utils.toggleClass(form, cfg.disabledClass, state);
      utils.qsa('button, input, textarea, select', form).forEach((el) => { el.disabled = !!state; });
    }

    function updateStatus(statusEl, message, isError) {
      if (!statusEl) return;
      statusEl.textContent = message;
      statusEl.classList.toggle(cfg.errorClass, !!isError);
      statusEl.classList.toggle(cfg.successClass, !isError);
      if (message) {
        clearTimeout(statusEl.__formsTimer);
        statusEl.__formsTimer = setTimeout(() => {
          statusEl.textContent = '';
          statusEl.classList.remove(cfg.errorClass, cfg.successClass);
        }, cfg.statusDelay);
      }
    }

    function handleSuccess(form, statusEl, text) {
      updateStatus(statusEl, text || 'Message sent successfully!', false);
      form.reset();
      emit('forms:success', { form, message: text });
    }

    function handleError(form, statusEl) {
      updateStatus(statusEl, 'Oops! Something went wrong. Please try again later.', true);
      emit('forms:error', { form });
    }

    function refresh(options = {}) {
      return init(options);
    }

    return {
      init,
      refresh,
      validateField,
      validateForm,
    };
  })();
})(window);
