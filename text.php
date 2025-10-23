<?php
@session_start();

/* ============================================
 CONFIGURACIÓN BASE — PARALLAX WEBSITE TEMPLATE
 Agencia: Maven Marketing
 Designed by: Maycoll Jaramillo
 ============================================ */

$MAVEN   = "https://www.gomavenhub.com/";
$Company  = "Go Maven Marketing";
$Domain   = "www.gomavenhub.com";
$BaseURL  = "https://www.gomavenhub.com";
$Address  = "123 Maven Dr, Miami, FL 33130"; // Nueva dirección ficticia
$City    = "Miami";
$State   = "FL";
$Zip    = "33130";
$Country  = "US";
$Mail    = "developer1@gomavenhub.com";
$Phone   = "(305) 555-MAVN"; // Número ficticio actualizado
$Phone2   = "(305) 555-HUB2"; // Número ficticio actualizado
$WhatsApp  = "+13055556286"; // WhatsApp ficticio actualizado
$Experience = "15+ Years of Digital Expertise"; // Actualizado
$Estimates = "Free Strategy Session"; // Actualizado
$Schedule  = "Mon–Fri: 9:00am–7:00pm / Sat: By Appointment"; // Actualizado
$Lic    = "Certified Google Partner"; // Actualizado
$Bilingual = "English / Spanish / Portuguese"; // Actualizado

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

$WebRoot = '/';

/* ---------- HOME INTRO / ABOUT / MISSION / VISION ---------- */
$HomeIntro = [
 "headline" => "Digital Marketing & Parallax Web Conversion", // Actualizado
 "sub"   => "Estrategias de marketing digital de alto impacto combinadas con sitios web de rendimiento élite y listos para conversión.", // Actualizado
 "bullets" => [
  "Estrategia digital 360: SEO, PPC, Social Media.", // Actualizado
  "Sitios web de alto rendimiento y UX enfocada en negocio.", // Actualizado
  "Analítica avanzada y optimización continua (CRO)." // Actualizado
 ],
 "primaryCTA" => "Request a Free Strategy Session", // Actualizado
 "secondaryCTA" => "Explore Our Case Studies" // Actualizado
];

$AboutUs = [
 "title" => "Acerca de Go Maven Marketing", // Actualizado
 "short" => "Somos una agencia full-service de marketing digital con un enfoque en diseño web, conversión y crecimiento escalable para nuestros clientes.", // Actualizado
 "detail" => "En Go Maven, integramos la excelencia técnica del desarrollo web con estrategias de marketing probadas. Nuestro equipo está compuesto por especialistas en SEO, desarrollo, diseño y CRO, enfocados en resultados medibles y transparencia total.", // Actualizado
 "whyUs" => [
  "Marketing digital basado en datos y ROI.", // Actualizado
  "Desarrollo web con performance y SEO nativo.", // Actualizado
  "Soporte, reporting detallado y partnerships a largo plazo." // Actualizado
 ]
];

$Mission = "Ser el motor de crecimiento digital para negocios que buscan escalar, ofreciendo soluciones de marketing y desarrollo web que superan los benchmarks de la industria."; // Actualizado
$Vision = "Convertirnos en la agencia de marketing digital más confiable y de mayor impacto en el sur de Florida y LATAM."; // Actualizado

/* ---------- FRASES / SLOGANS ---------- */
$Phrase = [
 "Growth Driven. Performance Focused.", // Actualizado
 "From Strategy to Scalable Success.", // Actualizado
 "Where Design Meets Digital Strategy.", // Actualizado
 "Build. Measure. Grow." // Actualizado
];

/* ---------- SERVICIOS ---------- */
$SN = [
 1 => "Digital Strategy & Consulting", // Actualizado
 2 => "SEO & Content Marketing", // Actualizado
 3 => "High-Performance Web Design", // Actualizado
 4 => "PPC & Paid Advertising", // Actualizado
 5 => "Social Media Management", // Actualizado
 6 => "Conversion Rate Optimization (CRO)" // Actualizado
];
$ExSD = [
 1 => "Diseño de estrategias 360 enfocadas en el funnel de ventas.", // Actualizado
 2 => "Posicionamiento orgánico duradero y autoridad de dominio.", // Actualizado
 3 => "Sitios rápidos, accesibles y optimizados para la adquisición de clientes.", // Actualizado
 4 => "Campañas rentables en Google Ads, Meta Ads y más.", // Actualizado
 5 => "Gestión de comunidades y crecimiento de engagement.", // Actualizado
 6 => "Mejora continua del rendimiento del sitio web y landing pages." // Actualizado
];

/* ---------- ÁREAS DE SERVICIO (LOCAL SEO) ---------- */
$ServiceAreas = ["Miami, FL", "Fort Lauderdale, FL", "West Palm Beach, FL", "Orlando, FL", "Remote US/LATAM"]; // Actualizado

/* ---------- REDES / CITAS OFF-PAGE ---------- */
// Actualizar la URL de las redes sociales al formato de Go Maven Marketing (usando "gomavenhub" como identificador ficticio para las cuentas)
$Facebook = "https://www.facebook.com/gomavenhub";
$Instagram = "https://www.instagram.com/gomavenhub";
$TikTok  = "https://www.tiktok.com/@gomavenhub";
$YouTube  = "https://www.youtube.com/@gomavenhub";
$LinkedIn = "https://www.linkedin.com/company/gomavenhub";
$Clutch  = "https://clutch.co/profile/go-maven-marketing";
$Behance  = "https://www.behance.net/gomavenhub";

/* ---------- IMÁGENES HERO / PARALLAX ---------- */
// PROHIBIDO TOCAR LAS IMÁGENES
$HeroImages = [
 "assets/images/hero/hero1.jpg",
 "assets/images/hero/hero2.jpg",
 "assets/images/hero/hero3.jpg"
];

/* ---------- GALERÍA ---------- */
// PROHIBIDO TOCAR LAS IMÁGENES
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
 ["name" => "Alejandro Pérez", "text" => "Doble el ROI de mis campañas en 3 meses. Estrategia y ejecución impecable."], // Actualizado
 ["name" => "Sophia Chen", "text" => "Transición a un sitio web de alta velocidad sin perder mi posicionamiento. Altamente recomendados."] // Actualizado
];

/* =========================================================
 SEO — ON-PAGE (METAS POR PÁGINA, OG, TWITTER, KEYWORDS)
 ========================================================= */
$BrandKeywords = [
 "digital marketing miami", "seo agency miami", "performance marketing",
 "conversion rate optimization", "ppc management", "full-service digital" // Actualizado
];

$SEO = [
 "home" => [
  "title"    => "Digital Marketing Agency & Web Performance | $Company", // Actualizado
  "description" => "Agencia de marketing digital en Miami. Estrategias de SEO, PPC y desarrollo web de alto rendimiento enfocadas en tu ROI.", // Actualizado
  "canonical"  => $BaseURL . "/",
  "keywords"  => array_merge(["agencia marketing digital miami", "seo en florida", "roi digital"], $BrandKeywords),
  "og" => [
   "type"    => "website",
   "title"    => "The Performance Digital Marketing Hub | $Company", // Actualizado
   "description" => "Estrategias que generan crecimiento real y medible.", // Actualizado
   "url"     => $BaseURL . "/",
   "image"    => $BaseURL . "/assets/images/og/home.jpg"
  ],
  "twitter" => [
   "card"    => "summary_large_image",
   "site"    => "@gomavenhub", // Actualizado
   "title"    => "Digital Marketing & Performance | $Company", // Actualizado
   "description" => "Estrategia, diseño y resultados medibles.", // Actualizado
   "image"    => $BaseURL . "/assets/images/og/home.jpg"
  ]
 ],
 "about" => [
  "title"    => "About $Company — Strategy, Team, and Results", // Actualizado
  "description" => "Conoce el equipo de especialistas que impulsará tu marca. Misión, visión y nuestro enfoque en el marketing de rendimiento.", // Actualizado
  "canonical"  => $BaseURL . "/about.php",
  "keywords"  => ["about us digital agency", "marketing team miami", "equipo de seo"], // Actualizado
  "og" => [
   "type" => "article", "title" => "About $Company", "description" => "Nuestra filosofía: datos, rendimiento y crecimiento.", // Actualizado
   "url" => $BaseURL . "/about.php", "image" => $BaseURL . "/assets/images/og/about.jpg"
  ],
  "twitter" => [
   "card" => "summary_large_image", "title" => "About $Company",
   "description" => "Especialistas en marketing y desarrollo.", // Actualizado
   "image" => $BaseURL . "/assets/images/og/about.jpg"
  ]
 ],
 "services" => [
  "title"    => "Servicios de Marketing Digital y Web | $Company", // Actualizado
  "description" => "Ofrecemos consultoría, SEO/PPC, diseño web, redes sociales y CRO para maximizar tu presencia digital y ventas.", // Actualizado
  "canonical"  => $BaseURL . "/services.php",
  "keywords"  => ["servicios marketing digital", "ppc management", "cro services", "seo agency"], // Actualizado
  "og" => [
   "type" => "website", "title" => "Servicios | $Company",
   "description" => "Soluciones 360 para el crecimiento de tu negocio.", // Actualizado
   "url" => $BaseURL . "/services.php", "image" => $BaseURL . "/assets/images/og/services.jpg"
  ],
  "twitter" => [
   "card" => "summary_large_image", "title" => "Servicios | $Company",
   "description" => "Marketing, Diseño, Estrategia.", // Actualizado
   "image" => $BaseURL . "/assets/images/og/services.jpg"
  ]
 ],
 "contact" => [
  "title"    => "Contact $Company — Free Strategy Session", // Actualizado
  "description" => "Agenda tu sesión de estrategia gratuita hoy. Hablemos de tus metas de crecimiento digital.", // Actualizado
  "canonical"  => $BaseURL . "/contact.php",
  "keywords"  => ["contacto agencia marketing", "cotización seo", "ppc miami"], // Actualizado
  "og" => [
   "type" => "website", "title" => "Contact $Company",
   "description" => "Listo para escalar? Contáctanos.", // Actualizado
   "url" => $BaseURL . "/contact.php", "image" => $BaseURL . "/assets/images/og/contact.jpg"
  ],
  "twitter" => [
   "card" => "summary_large_image", "title" => "Contact $Company",
   "description" => "Sesión de estrategia gratuita hoy.", // Actualizado
   "image" => $BaseURL . "/assets/images/og/contact.jpg"
  ]
 ]
];

/* ---------- FAQs (SEO + Schema FAQPage) ---------- */
$FAQs = [
 ["q" => "¿Cuál es el enfoque principal de Go Maven Marketing?", // Actualizado
 "a" => "Nos enfocamos en el Marketing de Rendimiento (Performance Marketing), donde cada inversión está ligada a resultados medibles: generación de leads, ventas y ROI."], // Actualizado
 ["q" => "¿Por qué combinan marketing y desarrollo web?", // Actualizado
 "a" => "Un sitio web de bajo rendimiento mata cualquier estrategia de marketing. Garantizamos que la plataforma sea un activo rápido, accesible y optimizado para la conversión desde el inicio."], // Actualizado
 ["q" => "¿Ofrecen servicios de PPC (Paid Advertising)?", // Actualizado
 "a" => "Sí. Diseñamos, gestionamos y optimizamos campañas en Google Ads, Meta Ads (Facebook/Instagram) y otras plataformas con un enfoque en la rentabilidad (ROAS)."] // Actualizado
];

/* ---------- ENLACES INTERNOS ÚTILES ---------- */
$InternalLinks = [
 ["label" => "Case Studies", "href" => "/casestudies.php"], // Actualizado
 ["label" => "Services", "href" => "/services.php"],
 ["label" => "About Us", "href" => "/about.php"], // Actualizado
 ["label" => "Contact", "href" => "/contact.php"]
];

/* ---------- BLOG (TEMAS PARA SEO) ---------- */
$BlogIdeas = [
 "Estrategias de PPC para ecommerce con bajo ROAS", // Actualizado
 "Impacto de Core Web Vitals en el SEO y las conversiones", // Actualizado
 "Cómo crear un funnel de ventas digital efectivo", // Actualizado
 "El Rol del CRO en el Marketing de Contenidos" // Actualizado
];

/* ---------- BREADCRUMBS ---------- */
$Breadcrumbs = [
 "home"   => [["name" => "Home", "item" => $BaseURL . "/"]],
 "about"  => [["name" => "Home", "item" => $BaseURL . "/"], ["name" => "About Us", "item" => $BaseURL . "/about.php"]], // Actualizado
 "services" => [["name" => "Home", "item" => $BaseURL . "/"], ["name" => "Services", "item" => $BaseURL . "/services.php"]],
 "contact" => [["name" => "Home", "item" => $BaseURL . "/"], ["name" => "Contact", "item" => $BaseURL . "/contact.php"]]
];

/* ---------- SITEMAP / ROBOTS PRIORIDADES ---------- */
$Sitemap = [
 ["loc" => $BaseURL . "/",       "priority" => "1.0", "changefreq" => "weekly"],
 ["loc" => $BaseURL . "/about.php",  "priority" => "0.8", "changefreq" => "monthly"],
 ["loc" => $BaseURL . "/services.php", "priority" => "0.9", "changefreq" => "weekly"],
 ["loc" => $BaseURL . "/contact.php", "priority" => "0.7", "changefreq" => "monthly"]
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
  "@type"  => "DigitalMarketingAgency", // Actualizado a tipo más específico
  "name"   => $Company,
  "url"   => $BaseURL,
  "logo"   => $BaseURL . "/assets/images/logo.png",
  "sameAs"  => [$Facebook, $Instagram, $TikTok, $YouTube, $LinkedIn, $Clutch, $Behance],
  "contactPoint" => [
   "@type" => "ContactPoint",
   "telephone" => $Phone,
   "contactType" => "customer service",
   "availableLanguage" => ["English","Spanish","Portuguese"], // Actualizado
   "areaServed" => "US"
  ],
  "address" => [
   "@type" => "PostalAddress",
   "streetAddress"  => $Address,
   "addressLocality" => $City,
   "addressRegion"  => $State,
   "postalCode"   => $Zip,
   "addressCountry" => $Country
  ]
 ],
 "website" => [
  "@context" => "https://schema.org",
  "@type"  => "WebSite",
  "name"   => $Company,
  "url"   => $BaseURL,
  "potentialAction" => [
   "@type" => "SearchAction",
   "target" => $BaseURL . "/search.php?q={query}",
   "query-input" => "required name=query"
  ]
 ],
 "faq" => [
  "@context" => "https://schema.org",
  "@type"  => "FAQPage",
  "mainEntity" => array_map(function($f){
   return [
    "@type" => "Question",
    "name" => $f["q"],
    "acceptedAnswer" => ["@type" => "Answer", "text" => $f["a"]]
   ];
  }, $FAQs)
 ],
 "breadcrumbs_home" => [
  "@context" => "https://schema.org",
  "@type"  => "BreadcrumbList",
  "itemListElement" => array_map(function($i, $idx){
   return ["@type" => "ListItem", "position" => $idx+1, "name" => $i["name"], "item" => $i["item"]];
  }, $Breadcrumbs["home"], array_keys($Breadcrumbs["home"]))
 ]
];

/* ---------- COPYRIGHT / CREDIT ---------- */
$CopyRight = "© " . date('Y') . " " . $Company . ". All Rights Reserved.";
$Designed = $DesignedBy;

/* ---------- HELPERS ÚTILES ---------- */
function telRef($p) {
 $clean = str_replace(str_split('()-/\\:*?"<>|., '), '', $p);
 return "tel:" . $clean;
}
$PhoneRef = telRef($Phone);
$Phone2Ref = telRef($Phone2);
$WARef   = "https://wa.me/" . preg_replace('/\D+/', '', $WhatsApp);

/* ---------- UTILS: ECHO JSON-LD SEGÚN CLAVE ---------- */
function echoJSONLD($block) {
 echo '<script type="application/ld+json">'.json_encode($block, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
}
?>