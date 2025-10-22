<?php
@session_start();

/* ============================================
   CONFIGURACIÓN BASE — PARALLAX WEBSITE TEMPLATE
   Agencia: Maven Marketing
   Designed by: Maycoll Jaramillo
   ============================================ */

$MAVEN      = "https://www.gomavenhub.com/";
$Company    = "Aurora Creative Agency";
$Domain     = "www.auroracreative.com";
$BaseURL    = "https://www.auroracreative.com";
$Address    = "Miami, FL 33130";
$City       = "Miami";
$State      = "FL";
$Zip        = "33130";
$Country    = "US";
$Mail       = "developer1@gomavenhub.com";
$Phone      = "(305) 555-1024";
$Phone2     = "(305) 555-1025";
$WhatsApp   = "+13055551024";
$Experience = "10 Years of Experience";
$Estimates  = "Free Consultations";
$Schedule   = "Mon–Fri: 8:00am–6:00pm / Sat: 9:00am–1:00pm";
$Lic        = "Fully Licensed & Insured";
$Bilingual  = "English / Spanish";

$DesignedBy = "Designed by Maycoll Jaramillo";

/* ---------- IDENTIDAD/NAP PARA CONSISTENCIA LOCAL ---------- */
$NAP = [
  "name" => $Company,
  "streetAddress" => $Address,
  "addressLocality" => $City,
  "addressRegion" => $State,
  "postalCode" => $Zip,
  "addressCountry" => $Country,
  "telephone" => $Phone,
  "email" => $Mail,
  "url" => $BaseURL
];

/* ---------- HOME INTRO / ABOUT / MISSION / VISION ---------- */
$HomeIntro = [
  "headline" => "Parallax Websites that Convert",
  "sub"      => "Creamos experiencias web inmersivas con rendimiento, accesibilidad y SEO listos para producción.",
  "bullets"  => [
    "Diseño responsive con animaciones fluidas (GPU friendly).",
    "Arquitectura SEO on-page completa desde el día 1.",
    "Velocidad y Core Web Vitals optimizados."
  ],
  "primaryCTA" => "Request a Free Consultation",
  "secondaryCTA" => "See Our Work"
];

$AboutUs = [
  "title" => "Quiénes Somos",
  "short" => "Somos un equipo de diseñadores y desarrolladores especializados en sitios con efectos parallax de alto impacto, enfocados en rendimiento, UX y posicionamiento.",
  "detail" => "Integramos estrategia, diseño y tecnología. Trabajamos con pipelines CI/CD, control de versiones y auditorías de accesibilidad. Entregamos sitios listos para escalar con estándares modernos (HTML semántico, ARIA, lazy-loading, compresión y cacheo).",
  "whyUs" => [
    "UX y performance por encima de lo decorativo.",
    "Componentes accesibles y SEO-first.",
    "Soporte, mantenimiento y roadmap de mejoras."
  ]
];

$Mission = "Impulsar a marcas y negocios con sitios parallax rápidos, accesibles y rentables, combinando creatividad con ingeniería aplicada.";
$Vision  = "Ser referencia en el desarrollo de experiencias web inmersivas que cumplan métricas de negocio y estándares web abiertos.";

/* ---------- FRASES / SLOGANS ---------- */
$Phrase = [
  "We Create. You Inspire.",
  "Next-Level Parallax & Performance.",
  "From Concept to Conversion.",
  "Design, Motion, Results."
];

/* ---------- SERVICIOS ---------- */
$SN = [
  1 => "Web Design & Development",
  2 => "Creative Branding",
  3 => "SEO Optimization",
  4 => "E-Commerce Integration",
  5 => "3D Parallax Animation",
  6 => "Maintenance & Support"
];
$ExSD = [
  1 => "Sitios modernos, rápidos y seguros, listos para escalar.",
  2 => "Identidades visuales consistentes con guías de estilo.",
  3 => "Arquitectura de contenidos, marcado semántico y schema.",
  4 => "Tiendas online con checkout seguro y gestión sencilla.",
  5 => "Efectos de profundidad y animaciones fluidas sin jank.",
  6 => "Actualizaciones, backups, monitoreo y optimización continua."
];

/* ---------- ÁREAS DE SERVICIO (LOCAL SEO) ---------- */
$ServiceAreas = ["Miami, FL", "Fort Lauderdale, FL", "West Palm Beach, FL", "Orlando, FL"];

/* ---------- REDES / CITAS OFF-PAGE ---------- */
$Facebook  = "https://www.facebook.com/auroracreative";
$Instagram = "https://www.instagram.com/auroracreative";
$TikTok    = "https://www.tiktok.com/@auroracreative";
$YouTube   = "https://www.youtube.com/@auroracreative";
$LinkedIn  = "https://www.linkedin.com/company/auroracreative";
$Clutch    = "https://clutch.co/profile/aurora-creative";
$Behance   = "https://www.behance.net/auroracreative";

/* ---------- IMÁGENES HERO / PARALLAX ---------- */
$HeroImages = [
  "assets/images/hero/hero1.jpg",
  "assets/images/hero/hero2.jpg",
  "assets/images/hero/hero3.jpg"
];

/* ---------- GALERÍA ---------- */
$Gallery = [
  "assets/images/gallery/1.jpg",
  "assets/images/gallery/2.jpg",
  "assets/images/gallery/3.jpg",
  "assets/images/gallery/4.jpg",
  "assets/images/gallery/5.jpg",
  "assets/images/gallery/6.jpg"
];

/* ---------- TESTIMONIOS ---------- */
$Testimonials = [
  ["name" => "Daniel Rivera", "text" => "Sitio parallax impecable. Rápido y visualmente impactante. Nuestro SEO subió."],
  ["name" => "Laura Gómez",  "text" => "Excelente atención al detalle y rendimiento. Recomendados."]
];

/* =========================================================
   SEO — ON-PAGE (METAS POR PÁGINA, OG, TWITTER, KEYWORDS)
   ========================================================= */
$BrandKeywords = [
  "parallax websites", "web design miami", "performance optimization",
  "accessible web", "seo-friendly architecture", "3D parallax"
];

$SEO = [
  "home" => [
    "title"       => "Parallax Web Design in Miami | $Company",
    "description" => "Diseño y desarrollo web con efectos parallax de alto rendimiento. UX, accesibilidad y SEO listos para crecer.",
    "canonical"   => $BaseURL . "/",
    "keywords"    => array_merge(["parallax web design miami", "sitios rápidos", "core web vitals"], $BrandKeywords),
    "og" => [
      "type"        => "website",
      "title"       => "Parallax Web Design that Converts | $Company",
      "description" => "Experiencias inmersivas, rápidas y accesibles.",
      "url"         => $BaseURL . "/",
      "image"       => $BaseURL . "/assets/images/og/home.jpg"
    ],
    "twitter" => [
      "card"        => "summary_large_image",
      "site"        => "@auroracreative",
      "title"       => "Parallax Web Design | $Company",
      "description" => "Rendimiento, accesibilidad y SEO.",
      "image"       => $BaseURL . "/assets/images/og/home.jpg"
    ]
  ],
  "about" => [
    "title"       => "About $Company — Equipo, Misión y Visión",
    "description" => "Conoce nuestro equipo y filosofía: misión, visión y proceso para crear sitios parallax de alto impacto.",
    "canonical"   => $BaseURL . "/about.php",
    "keywords"    => ["about us parallax agency", "web studio miami", "equipo de diseño"],
    "og" => [
      "type" => "article", "title" => "About $Company", "description" => "Quiénes somos, misión y visión.",
      "url"  => $BaseURL . "/about.php", "image" => $BaseURL . "/assets/images/og/about.jpg"
    ],
    "twitter" => [
      "card" => "summary_large_image", "title" => "About $Company",
      "description" => "Nuestro enfoque y equipo.",
      "image" => $BaseURL . "/assets/images/og/about.jpg"
    ]
  ],
  "services" => [
    "title"       => "Servicios de Diseño Web Parallax y SEO | $Company",
    "description" => "Diseño web, branding, SEO, e-commerce y animación 3D/Parallax con foco en rendimiento.",
    "canonical"   => $BaseURL . "/services.php",
    "keywords"    => ["servicios web", "branding", "seo technical", "ecommerce"],
    "og" => [
      "type" => "website", "title" => "Servicios | $Company",
      "description" => "Todo para tu presencia digital.",
      "url" => $BaseURL . "/services.php", "image" => $BaseURL . "/assets/images/og/services.jpg"
    ],
    "twitter" => [
      "card" => "summary_large_image", "title" => "Servicios | $Company",
      "description" => "Diseño, SEO, e-commerce.",
      "image" => $BaseURL . "/assets/images/og/services.jpg"
    ]
  ],
  "contact" => [
    "title"       => "Contact $Company — Free Consultation",
    "description" => "Agenda una consulta gratuita. Respuesta el mismo día. Atención en inglés y español.",
    "canonical"   => $BaseURL . "/contact.php",
    "keywords"    => ["contacto agencia web", "cotización sitio web", "parallax miami"],
    "og" => [
      "type" => "website", "title" => "Contact $Company",
      "description" => "Hablemos de tu proyecto.",
      "url" => $BaseURL . "/contact.php", "image" => $BaseURL . "/assets/images/og/contact.jpg"
    ],
    "twitter" => [
      "card" => "summary_large_image", "title" => "Contact $Company",
      "description" => "Consulta gratuita hoy.",
      "image" => $BaseURL . "/assets/images/og/contact.jpg"
    ]
  ]
];

/* ---------- FAQs (SEO + Schema FAQPage) ---------- */
$FAQs = [
  ["q" => "¿Qué es un sitio con efecto parallax y cuándo conviene usarlo?",
   "a" => "Parallax es el desplazamiento con capas a distintas velocidades que añade profundidad. Conviene cuando la narrativa visual aporta valor sin sacrificar rendimiento y accesibilidad."],
  ["q" => "¿Cómo garantizan el rendimiento y Core Web Vitals?",
   "a" => "Usamos imágenes optimizadas (WebP/AVIF), lazy-loading, compresión, cacheo, CSS/JS críticos y animaciones aceleradas por GPU."],
  ["q" => "¿Trabajan SEO desde el inicio?",
   "a" => "Sí. Arquitectura de información, marcado semántico, schema, metas por página, enlazado interno y contenido evergreen."]
];

/* ---------- ENLACES INTERNOS ÚTILES ---------- */
$InternalLinks = [
  ["label" => "Our Work", "href" => "/portfolio.php"],
  ["label" => "Services", "href" => "/services.php"],
  ["label" => "About", "href" => "/about.php"],
  ["label" => "Contact", "href" => "/contact.php"]
];

/* ---------- BLOG (TEMAS PARA SEO) ---------- */
$BlogIdeas = [
  "Parallax sin perder Core Web Vitals: guía práctica",
  "Accesibilidad en sitios con animaciones y scroll-driven",
  "Arquitectura SEO para sitios one-page y landing parallax",
  "Cómo medir impacto de animaciones en conversión"
];

/* ---------- BREADCRUMBS ---------- */
$Breadcrumbs = [
  "home"     => [["name" => "Home", "item" => $BaseURL . "/"]],
  "about"    => [["name" => "Home", "item" => $BaseURL . "/"], ["name" => "About", "item" => $BaseURL . "/about.php"]],
  "services" => [["name" => "Home", "item" => $BaseURL . "/"], ["name" => "Services", "item" => $BaseURL . "/services.php"]],
  "contact"  => [["name" => "Home", "item" => $BaseURL . "/"], ["name" => "Contact", "item" => $BaseURL . "/contact.php"]]
];

/* ---------- SITEMAP / ROBOTS PRIORIDADES ---------- */
$Sitemap = [
  ["loc" => $BaseURL . "/",             "priority" => "1.0", "changefreq" => "weekly"],
  ["loc" => $BaseURL . "/about.php",    "priority" => "0.8", "changefreq" => "monthly"],
  ["loc" => $BaseURL . "/services.php", "priority" => "0.9", "changefreq" => "weekly"],
  ["loc" => $BaseURL . "/contact.php",  "priority" => "0.7", "changefreq" => "monthly"]
];
$RobotsRules = [
  "User-agent: *",
  "Allow: /",
  "Sitemap: $BaseURL/sitemap.xml"
];

/* =========================================================
   JSON-LD (ORGANIZATION / WEBSITE / WEBPAGE / FAQ / BREADCRUMB)
   ========================================================= */
$JSONLD = [
  "organization" => [
    "@context" => "https://schema.org",
    "@type"    => "Organization",
    "name"     => $Company,
    "url"      => $BaseURL,
    "logo"     => $BaseURL . "/assets/images/logo.png",
    "sameAs"   => [$Facebook, $Instagram, $TikTok, $YouTube, $LinkedIn, $Clutch, $Behance],
    "contactPoint" => [
      "@type" => "ContactPoint",
      "telephone" => $Phone,
      "contactType" => "customer service",
      "availableLanguage" => ["English","Spanish"],
      "areaServed" => "US"
    ],
    "address" => [
      "@type" => "PostalAddress",
      "streetAddress"   => $Address,
      "addressLocality" => $City,
      "addressRegion"   => $State,
      "postalCode"      => $Zip,
      "addressCountry"  => $Country
    ]
  ],
  "website" => [
    "@context" => "https://schema.org",
    "@type"    => "WebSite",
    "name"     => $Company,
    "url"      => $BaseURL,
    "potentialAction" => [
      "@type" => "SearchAction",
      "target" => $BaseURL . "/search.php?q={query}",
      "query-input" => "required name=query"
    ]
  ],
  "faq" => [
    "@context" => "https://schema.org",
    "@type"    => "FAQPage",
    "mainEntity" => array_map(function($f){
      return [
        "@type" => "Question",
        "name"  => $f["q"],
        "acceptedAnswer" => ["@type" => "Answer", "text" => $f["a"]]
      ];
    }, $FAQs)
  ],
  "breadcrumbs_home" => [
    "@context" => "https://schema.org",
    "@type"    => "BreadcrumbList",
    "itemListElement" => array_map(function($i, $idx){
      return ["@type" => "ListItem", "position" => $idx+1, "name" => $i["name"], "item" => $i["item"]];
    }, $Breadcrumbs["home"], array_keys($Breadcrumbs["home"]))
  ]
];

/* ---------- COPYRIGHT / CREDIT ---------- */
$CopyRight = "© " . date('Y') . " " . $Company . ". All Rights Reserved.";
$Designed  = $DesignedBy;

/* ---------- HELPERS ÚTILES ---------- */
function telRef($p) {
  $clean = str_replace(str_split('()-/\\:*?"<>|., '), '', $p);
  return "tel:" . $clean;
}
$PhoneRef  = telRef($Phone);
$Phone2Ref = telRef($Phone2);
$WARef     = "https://wa.me/" . preg_replace('/\D+/', '', $WhatsApp);

/* ---------- UTILS: ECHO JSON-LD SEGÚN CLAVE ---------- */
function echoJSONLD($block) {
  echo '<script type="application/ld+json">'.json_encode($block, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
}
?>
