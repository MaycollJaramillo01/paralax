<?php
@session_start();

/* ============================================
 CONFIGURACIÓN BASE — PARALLAX WEBSITE TEMPLATE
 Agency: Maven Marketing
 Designed by: Maycoll Jaramillo
 ============================================ */

$MAVEN 	 = "https://www.gomavenhub.com/";
$Company 	= "Go Maven Marketing";
$Domain 	 = "www.gomavenhub.com";
$BaseURL 	= "https://www.gomavenhub.com";
$Address 	= "123 Maven Dr, Miami, FL 33130"; // Fictional new address
$City 	 	= "Miami";
$State 	 = "FL";
$Zip 	 	= "33130";
$Country 	= "US";
$Mail 	 	= "developer1@gomavenhub.com";
$Phone 	 = "(305) 555-MAVN"; // Updated fictional number
$Phone2 	 = "(305) 555-HUB2"; // Updated fictional number
$WhatsApp 	= "+13055556286"; // Updated fictional WhatsApp
$Experience = "15+ Years of Digital Expertise"; // Updated
$Estimates = "Free Strategy Session"; // Updated
$Schedule 	= "Mon–Fri: 9:00am–7:00pm / Sat: By Appointment"; // Updated
$Lic 	 	= "Certified Google Partner"; // Updated
$Bilingual = "English / Spanish / Portuguese"; // Updated

$DesignedBy = "Designed by Maycoll Jaramillo";

/* ---------- IDENTITY/NAP FOR LOCAL CONSISTENCY ---------- */
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
	"headline" => "Digital Marketing & Parallax Web Conversion", // Updated
	"sub" 	 => "High-impact digital marketing strategies combined with elite-performance, conversion-ready websites.", // Translated
	"bullets" => [
		"360 Digital Strategy: SEO, PPC, Social Media.", // Translated
		"High-performance websites and business-focused UX.", // Translated
		"Advanced analytics and continuous optimization (CRO)." // Translated
	],
	"primaryCTA" => "Request a Free Strategy Session", // Updated
	"secondaryCTA" => "Explore Our Case Studies" // Updated
];

$AboutUs = [
	"title" => "About Go Maven Marketing", // Updated
	"short" => "We are a full-service digital marketing agency focused on web design, conversion, and scalable growth for our clients.", // Translated
	"detail" => "At Go Maven, we integrate the technical excellence of web development with proven marketing strategies. Our team is composed of SEO, development, design, and CRO specialists, focused on measurable results and total transparency.", // Translated
	"whyUs" => [
		"Data-driven marketing and ROI.", // Translated
		"Web development with native performance and SEO.", // Translated
		"Support, detailed reporting, and long-term partnerships." // Translated
	]
];

$Mission = "To be the digital growth engine for businesses seeking to scale, offering marketing and web development solutions that exceed industry benchmarks."; // Translated
$Vision = "To become the most reliable and highest-impact digital marketing agency in South Florida and LATAM."; // Translated

/* ---------- PHRASES / SLOGANS ---------- */
$Phrase = [
	"Growth Driven. Performance Focused.", // Updated
	"From Strategy to Scalable Success.", // Updated
	"Where Design Meets Digital Strategy.", // Updated
	"Build. Measure. Grow." // Updated
];

/* ---------- SERVICES ---------- */
$SN = [
	1 => "Digital Strategy & Consulting", // Updated
	2 => "SEO & Content Marketing", // Updated
	3 => "High-Performance Web Design", // Updated
	4 => "PPC & Paid Advertising", // Updated
	5 => "Social Media Management", // Updated
	6 => "Conversion Rate Optimization (CRO)" // Updated
];
$ExSD = [
	1 => "Designing 360 strategies focused on the sales funnel.", // Translated
	2 => "Long-lasting organic positioning and domain authority.", // Translated
	3 => "Fast, accessible, and optimized sites for customer acquisition.", // Translated
	4 => "Cost-effective campaigns on Google Ads, Meta Ads, and more.", // Translated
	5 => "Community management and engagement growth.", // Translated
	6 => "Continuous improvement of website and landing page performance." // Translated
];

/* ---------- SERVICE AREAS (LOCAL SEO) ---------- */
$ServiceAreas = ["Miami, FL", "Fort Lauderdale, FL", "West Palm Beach, FL", "Orlando, FL", "Remote US/LATAM"]; // Updated

/* ---------- NETWORKS / OFF-PAGE CITATIONS ---------- */
// Update social media URLs to Go Maven Marketing format (using "gomavenhub" as a fictional identifier for the accounts)
$Facebook = "https://www.facebook.com/gomavenhub";
$Instagram = "https://www.instagram.com/gomavenhub";
$TikTok 	= "https://www.tiktok.com/@gomavenhub";
$YouTube 	= "https://www.youtube.com/@gomavenhub";
$LinkedIn = "https://www.linkedin.com/company/gomavenhub";
$Clutch 	= "https://clutch.co/profile/go-maven-marketing";
$Behance 	= "https://www.behance.net/gomavenhub";

/* ---------- HERO / PARALLAX IMAGES ---------- */
// DO NOT TOUCH IMAGES
$HeroImages = [
	"assets/images/hero/hero1.jpg",
	"assets/images/hero/hero2.jpg",
	"assets/images/hero/hero3.jpg"
];

/* ---------- GALLERY ---------- */
// DO NOT TOUCH IMAGES
$Gallery = [
	"assets/images/gallery/1.jpg",
	"assets/images/gallery/2.jpg",
	"assets/images/gallery/3.jpg",
	"assets/images/gallery/4.jpg",
	"assets/images/gallery/5.jpg",
	"assets/images/gallery/6.jpg"
];

/* ---------- TESTIMONIALS ---------- */
$Testimonials = [
	["name" => "Alejandro Pérez", "text" => "Doubled the ROI of my campaigns in 3 months. Impeccable strategy and execution."], // Translated
	["name" => "Sophia Chen", "text" => "Transition to a high-speed website without losing my ranking. Highly recommended."] // Translated
];

/* =========================================================
 SEO — ON-PAGE (PER-PAGE METAS, OG, TWITTER, KEYWORDS)
 ========================================================= */
$BrandKeywords = [
	"digital marketing miami", "seo agency miami", "performance marketing",
	"conversion rate optimization", "ppc management", "full-service digital" // Updated
];

$SEO = [
	"home" => [
		"title" 	 	=> "Digital Marketing Agency & Web Performance | $Company", // Updated
		"description" => "Digital marketing agency in Miami. SEO, PPC, and high-performance web development strategies focused on your ROI.", // Translated
		"canonical" 	=> $BaseURL . "/",
		"keywords" 	=> array_merge(["digital marketing agency miami", "seo in florida", "digital roi"], $BrandKeywords), // Translated
		"og" => [
			"type" 	 	=> "website",
			"title" 	 	=> "The Performance Digital Marketing Hub | $Company", // Updated
			"description" => "Strategies that generate real and measurable growth.", // Translated
			"url" 	 	 => $BaseURL . "/",
			"image" 	 	=> $BaseURL . "/assets/images/og/home.jpg"
		],
		"twitter" => [
			"card" 	 	=> "summary_large_image",
			"site" 	 	=> "@gomavenhub", // Updated
			"title" 	 	=> "Digital Marketing & Performance | $Company", // Updated
			"description" => "Strategy, design, and measurable results.", // Translated
			"image" 	 	=> $BaseURL . "/assets/images/og/home.jpg"
		]
	],
	"about" => [
		"title" 	 	=> "About $Company — Strategy, Team, and Results", // Updated
		"description" => "Meet the team of specialists that will boost your brand. Mission, vision, and our focus on performance marketing.", // Translated
		"canonical" 	=> $BaseURL . "/about.php",
		"keywords" 	=> ["about us digital agency", "marketing team miami", "seo team"], // Translated
		"og" => [
			"type" => "article", "title" => "About $Company", "description" => "Our philosophy: data, performance, and growth.", // Translated
			"url" => $BaseURL . "/about.php", "image" => $BaseURL . "/assets/images/og/about.jpg"
		],
		"twitter" => [
			"card" => "summary_large_image", "title" => "About $Company",
			"description" => "Specialists in marketing and development.", // Translated
			"image" => $BaseURL . "/assets/images/og/about.jpg"
		]
	],
	"services" => [
		"title" 	 	=> "Digital Marketing and Web Services | $Company", // Translated
		"description" => "We offer consulting, SEO/PPC, web design, social media, and CRO to maximize your digital presence and sales.", // Translated
		"canonical" 	=> $BaseURL . "/services.php",
		"keywords" 	=> ["digital marketing services", "ppc management", "cro services", "seo agency"], // Translated
		"og" => [
			"type" => "website", "title" => "Services | $Company",
			"description" => "360 solutions for your business growth.", // Translated
			"url" => $BaseURL . "/services.php", "image" => $BaseURL . "/assets/images/og/services.jpg"
		],
		"twitter" => [
			"card" => "summary_large_image", "title" => "Services | $Company",
			"description" => "Marketing, Design, Strategy.", // Translated
			"image" => $BaseURL . "/assets/images/og/services.jpg"
		]
	],
	"contact" => [
		"title" 	 	=> "Contact $Company — Free Strategy Session", // Updated
		"description" => "Schedule your free strategy session today. Let's talk about your digital growth goals.", // Translated
		"canonical" 	=> $BaseURL . "/contact.php",
		"keywords" 	=> ["contact marketing agency", "seo quote", "ppc miami"], // Translated
		"og" => [
			"type" => "website", "title" => "Contact $Company",
			"description" => "Ready to scale? Contact us.", // Translated
			"url" => $BaseURL . "/contact.php", "image" => $BaseURL . "/assets/images/og/contact.jpg"
		],
		"twitter" => [
			"card" => "summary_large_image", "title" => "Contact $Company",
			"description" => "Free strategy session today.", // Translated
			"image" => $BaseURL . "/assets/images/og/contact.jpg"
		]
	]
];

/* ---------- FAQs (SEO + Schema FAQPage) ---------- */
$FAQs = [
	["q" => "What is Go Maven Marketing's main focus?", // Translated
	"a" => "We focus on Performance Marketing, where every investment is linked to measurable results: lead generation, sales, and ROI."], // Translated
	["q" => "Why do you combine marketing and web development?", // Translated
	"a" => "A low-performing website kills any marketing strategy. We ensure the platform is a fast, accessible, and conversion-optimized asset from the start."], // Translated
	["q" => "Do you offer PPC (Paid Advertising) services?", // Translated
	"a" => "Yes. We design, manage, and optimize campaigns on Google Ads, Meta Ads (Facebook/Instagram), and other platforms with a focus on profitability (ROAS)."] // Translated
];

/* ---------- USEFUL INTERNAL LINKS ---------- */
$InternalLinks = [
	["label" => "Case Studies", "href" => "/casestudies.php"], // Updated
	["label" => "Services", "href" => "/services.php"],
	["label" => "About Us", "href" => "/about.php"], // Updated
	["label" => "Contact", "href" => "/contact.php"]
];

/* ---------- BLOG (SEO TOPICS) ---------- */
$BlogIdeas = [
	"PPC Strategies for e-commerce with low ROAS", // Translated
	"Impact of Core Web Vitals on SEO and conversions", // Translated
	"How to create an effective digital sales funnel", // Translated
	"The Role of CRO in Content Marketing" // Translated
];

/* ---------- BREADCRUMBS ---------- */
$Breadcrumbs = [
	"home" 	 => [["name" => "Home", "item" => $BaseURL . "/"]],
	"about" 	=> [["name" => "Home", "item" => $BaseURL . "/"], ["name" => "About Us", "item" => $BaseURL . "/about.php"]], // Updated
	"services" => [["name" => "Home", "item" => $BaseURL . "/"], ["name" => "Services", "item" => $BaseURL . "/services.php"]],
	"contact" => [["name" => "Home", "item" => $BaseURL . "/"], ["name" => "Contact", "item" => $BaseURL . "/contact.php"]]
];

/* ---------- SITEMAP / ROBOTS PRIORITIES ---------- */
$Sitemap = [
	["loc" => $BaseURL . "/", 	 	 "priority" => "1.0", "changefreq" => "weekly"],
	["loc" => $BaseURL . "/about.php", 	"priority" => "0.8", "changefreq" => "monthly"],
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
		"@type" 	=> "DigitalMarketingAgency", // Updated to a more specific type
		"name" 	 => $Company,
		"url" 	 => $BaseURL,
		"logo" 	 => $BaseURL . "/assets/images/logo.png",
		"sameAs" 	=> [$Facebook, $Instagram, $TikTok, $YouTube, $LinkedIn, $Clutch, $Behance],
		"contactPoint" => [
			"@type" => "ContactPoint",
			"telephone" => $Phone,
			"contactType" => "customer service",
			"availableLanguage" => ["English","Spanish","Portuguese"], // Updated
			"areaServed" => "US"
		],
		"address" => [
			"@type" => "PostalAddress",
			"streetAddress" 	=> $Address,
			"addressLocality" => $City,
			"addressRegion" 	=> $State,
			"postalCode" 	 => $Zip,
			"addressCountry" => $Country
		]
	],
	"website" => [
		"@context" => "https://schema.org",
		"@type" 	=> "WebSite",
		"name" 	 => $Company,
		"url" 	 => $BaseURL,
		"potentialAction" => [
			"@type" => "SearchAction",
			"target" => $BaseURL . "/search.php?q={query}",
			"query-input" => "required name=query"
		]
	],
	"faq" => [
		"@context" => "https://schema.org",
		"@type" 	=> "FAQPage",
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
		"@type" 	=> "BreadcrumbList",
		"itemListElement" => array_map(function($i, $idx){
			return ["@type" => "ListItem", "position" => $idx+1, "name" => $i["name"], "item" => $i["item"]];
		}, $Breadcrumbs["home"], array_keys($Breadcrumbs["home"]))
	]
];

/* ---------- COPYRIGHT / CREDIT ---------- */
$CopyRight = "© " . date('Y') . " " . $Company . ". All Rights Reserved.";
$Designed = $DesignedBy;

/* ---------- USEFUL HELPERS ---------- */
function telRef($p) {
	$clean = str_replace(str_split('()-/\\:*?"<>|., '), '', $p);
	return "tel:" . $clean;
}
$PhoneRef = telRef($Phone);
$Phone2Ref = telRef($Phone2);
$WARef 	 = "https://wa.me/" . preg_replace('/\D+/', '', $WhatsApp);

/* ---------- UTILS: ECHO JSON-LD BY KEY ---------- */
function echoJSONLD($block) {
	echo '<script type="application/ld+json">'.json_encode($block, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
}
?>