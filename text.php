<?php
$full_name = $_SERVER['PHP_SELF'];
$name_array = explode('/', $full_name);
$count = count($name_array);
$page_name = $name_array[$count-1];
if($page_name=='index.php'){$namepage="Home";}
elseif ($page_name=='about.php') {$namepage="About";}
elseif ($page_name=='services.php') {$namepage="Services";}
elseif ($page_name=='testimonials.php') {$namepage="Testimonials";}
elseif ($page_name=='projects.php') {$namepage="Projects";}
elseif ($page_name=='thank-you.php') {$namepage="Thank You";}
elseif ($page_name=='404.php') {$namepage="Not Found";}
elseif ($page_name=='contact.php') {$namepage="Contact Us";}

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptDir = trim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
if ($scriptDir !== '') {
    $BaseURL = $protocol . $host . '/' . $scriptDir . '/';
} else {
    $BaseURL = $protocol . $host . '/';
}

$Company="EXCLUSIVE HARDSCAPES INC";
$Domain='www.exclusivehardscapesinc.net';
$Address='Newnan, GA';
$City='Newnan';
$State='GA';
$Zip='30263';
$Country='USA';

$Logo = $BaseURL . 'assets/images/logo-exclusive-hardscapes.svg';

$PhoneName="Main";
$Phone='(678) 330-0535';
$PhoneConvert = str_replace(str_split('(-)/:*?"<>|\t\n\r\O\f\i\c\e'), '', $Phone);
$PhoneRef = 'tel:' . str_replace(str_split(' '), '', $PhoneConvert);

$Phone2Name="Secondary";
$Phone2='';
$Phone2Convert = str_replace(str_split('(-)/:*?"<>|\t\n\r\O\f\i\c\e'), '', $Phone2);
$Phone2Ref = 'tel:' . str_replace(str_split(' '), '', $Phone2Convert);

$Mail='exclusivehardscapesinc@gmail.com';
$MailRef='mailto:' . $Mail;

$WhatsApp='';
if (!empty($PhoneConvert)) {
    $WhatsApp = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $PhoneConvert);
}

$Facebook='https://www.facebook.com/exclusivehardscapesinc';
$Instagram='';
$TikTok='';
$YouTube='';
$LinkedIn='';
$Clutch='';
$Behance='';

$Services="Residential and Commercial Services";
$Estimates="Free Estimates Are Available";
$Payment="We Accept Cash, Check, Transfers and Cards";
$Experience="14 Years Of Experience";
$Schedule="Monday to Friday from 7:00 am to 5:00 pm";
$Schedule1="Saturday 9:00 am to 3:00 pm";
$Bilingual="English & Spanish";
$Licen="Fully Insured & Licensed";
$Cover="We Cover 30 miles Around Local Area";

$MetaTitle = "Exclusive Hardscapes Inc | Hardscaping Experts in $City, $State";
$MetaDescription = "Exclusive Hardscapes Inc delivers premium hardscaping, outdoor living, and landscape enhancements across $City, $State. Licensed, insured, and driven by craftsmanship.";
$MetaKeywords = "hardscaping $City, outdoor living $State, landscape design Georgia, retaining walls $City";


$SliderControls = [
    'previous' => 'Previous slide',
    'next' => 'Next slide',
    'pause' => 'Pause slider',
    'play' => 'Play slider',
];

$Phrase = [
    "Transform your outdoor space with Exclusive Hardscapes Inc!",
    "Crafting stunning landscapes, one project at a time.",
    "Elevate your curb appeal with our exclusive hardscaping designs.",
    "Unleash the potential of your outdoor living space with Exclusive Hardscapes Inc.",
    "Quality craftsmanship for your dream outdoor oasis.",
];

$Home = [
    "Welcome to EXCLUSIVE HARDSCAPES INC, where we have proudly served our community for over 14 years with top-quality hardscaping services. As a licensed and insured company, we prioritize professionalism, precision, and customer satisfaction in every project we undertake. From stunning outdoor living spaces to durable driveways and walkways, our team of experienced professionals is dedicated to bringing our clients' visions to life with exceptional craftsmanship and attention to detail.",
    "At EXCLUSIVE HARDSCAPES INC, we take pride in our commitment to excellence and the long-lasting relationships we build with our valued customers. Our knowledgeable staff is always here to answer any questions and provide expert advice on the best hardscaping solutions for your home or commercial property. Let us transform your outdoor space into a beautiful and functional oasis that you can enjoy for years to come. Contact us today to see why we are the trusted choice for all your hardscaping needs.",
];

$Mission = "Our mission is to design and build hardscapes that blend durability with artistry, ensuring every homeowner in $City, $State enjoys an outdoor space tailored to their lifestyle.";
$Vision = "Our vision is to be the leading hardscaping partner in $State, recognized for innovative outdoor environments, sustainable practices, and a customer-first experience.";


$MenuToggleLabel = 'Menu';
$MenuCloseLabel = 'Close';

$NavigationLinks = [
    ['label' => 'Home', 'href' => '#home'],
    ['label' => 'About', 'href' => '#about'],
    ['label' => 'Mission', 'href' => '#mission'],
    ['label' => 'Services', 'href' => '#services'],
    ['label' => 'Gallery', 'href' => '#gallery'],
    ['label' => 'Testimonials', 'href' => '#testimonials'],
    ['label' => 'Contact', 'href' => '#contact'],
];

$HeaderCTA = 'Book Your Consultation';

$HeroTitle = "$Company — Hardscaping in $City, $State";

$HeroTagline = 'Hardscaping artistry for homes and businesses across Georgia.';

$HeroHighlightLabels = [
    'experience' => 'Experience',
    'licensed' => 'Licensing',
    'estimates' => 'Estimates',
    'service_area' => 'Coverage',
];

$HeroHighlights = [
    'experience' => $Experience,
    'licensed' => $Licen,
    'estimates' => $Estimates,
    'service_area' => $Cover,
];

$HeroButtons = [
    'primary' => 'Request a Free On-Site Consultation',
    'secondary' => 'View Signature Projects',
];

$HeroBadges = [
    'craftsmanship' => 'Precision Stonework',
    'satisfaction' => 'Customer Satisfaction Guaranteed',
];

$AboutTitle = "About $Company";
$AboutSubtitle = "Trusted hardscaping professionals serving $City and surrounding areas.";
$AboutHighlights = [
    'teams' => 'Dedicated crews for design, build, and maintenance',
    'materials' => 'Premium pavers, natural stone, and lighting systems',
    'guarantee' => 'Detailed workmanship backed by reliable warranties',
];

$MissionTitle = 'Mission';
$VisionTitle = 'Vision';

$ServiceIntro = "Discover hardscaping and outdoor living solutions tailored to residential and commercial properties.";

$SN = [];
$SD = [];
$SN[1]="Landscaping";
$SD[1]="Our professional landscaping service offers a comprehensive range of solutions to enhance and maintain outdoor spaces. From design and installation of gardens, lawns, trees, and shrubs to ongoing maintenance such as mowing, pruning, and fertilizing.";
$SN[2]="Landscape Irrigation";
$SD[2]="Our professional team will design and install a customized irrigation system to keep your lawn and garden lush and healthy all year round.";
$SN[3]="Outdoor Lighting";
$SD[3]="Transform your outdoor space with our high-quality lighting solutions, highlighting key features of your landscape and creating a warm and inviting atmosphere.";
$SN[4]="Pavers";
$SD[4]="Enhance your outdoor living space with our exquisite selection of pavers, available in various styles and colors to create beautiful walkways, patios, and driveways.";
$SN[5]="Firepits";
$SD[5]="Add a touch of warmth and charm to your outdoor gatherings with our custom-designed firepits, perfect for cozy nights with family and friends.";

$ServiceButton = 'Schedule Your Project Assessment';

$GalleryTitle = 'Featured Outdoor Transformations';
$GallerySubtitle = 'Explore recent installations that showcase our custom stonework, lighting, and landscaping solutions.';
$GalleryItems = [
    [
        'src' => $BaseURL . 'assets/images/gallery-1.svg',
        'alt' => $Company . ' courtyard renovation in ' . $City,
        'caption' => 'Elegant courtyard with layered stone planters and accent lighting.',
    ],
    [
        'src' => $BaseURL . 'assets/images/gallery-2.svg',
        'alt' => $Company . ' patio upgrade in ' . $City,
        'caption' => 'Entertainment-ready patio featuring modern pavers and seating walls.',
    ],
    [
        'src' => $BaseURL . 'assets/images/gallery-3.svg',
        'alt' => $Company . ' fire feature in ' . $City,
        'caption' => 'Warm gathering space with custom fire feature and integrated lighting.',
    ],
];

$TestimonialsTitle = 'What Our Clients Say';
$TestimonialsSubtitle = 'Homeowners and businesses rely on our expertise for durable, beautiful outdoor upgrades.';
$Testimonials = [
    [
        'name' => 'Jonathan Pierce',
        'location' => 'Homeowner in Newnan, GA',
        'quote' => 'Exclusive Hardscapes Inc delivered a patio beyond our expectations. The crew was punctual, professional, and kept the site immaculate throughout the project.',
    ],
    [
        'name' => 'Meghan Lewis',
        'location' => 'Property Manager in Peachtree City, GA',
        'quote' => 'Their team transformed our common areas with stunning stone walkways and lighting. Residents constantly compliment the new look.',
    ],
    [
        'name' => 'Carlos Ramirez',
        'location' => 'Restaurant Owner in Senoia, GA',
        'quote' => 'From design to installation, the process was smooth and collaborative. Our outdoor dining space is now the highlight of our restaurant.',
    ],
];

$ContactTitle = 'Ready to Elevate Your Outdoor Space?';
$ContactSubtitle = 'Connect with our specialists to discuss design options, materials, and scheduling.';
$ContactFormText = [
    'name' => 'Full Name',
    'email' => 'Email Address',
    'phone' => 'Phone Number',
    'service' => 'Service of Interest',
    'message' => 'Tell us about your project',
    'submit' => 'Send My Request',
];
$ContactCTA = [
    'call' => 'Call Our Team',
    'email' => 'Email Our Specialists',
    'whatsapp' => 'Chat on WhatsApp',
];

$ContactDetails = [
    'address_label' => 'Headquarters',
    'service_area_label' => 'Service Area',
    'hours_label' => 'Service Hours',
];

$SocialProfiles = [
    ['label' => 'Facebook', 'url' => $Facebook],
    ['label' => 'Instagram', 'url' => $Instagram],
    ['label' => 'YouTube', 'url' => $YouTube],
    ['label' => 'LinkedIn', 'url' => $LinkedIn],
];

$FooterExtras = [$Payment, $Bilingual, $Licen];

$ContactInformation = [
    ['label' => 'Phone', 'value' => $Phone, 'href' => $PhoneRef],
    ['label' => 'Email', 'value' => $Mail, 'href' => $MailRef],
    ['label' => 'Main Office', 'value' => $Address],
    ['label' => 'Coverage', 'value' => $Cover],
    ['label' => 'Service Hours', 'value' => $Schedule . ' | ' . $Schedule1],
];

$FooterSocialTitle = 'Connect with Us';
$FooterContactTitle = 'Company Details';

$FooterNotes = [
    'rights' => 'All Rights Reserved',
    'credit' => 'Website crafted for performance and conversion.',
];

$GoogleMap='<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d53307.90310131645!2d-84.76311095000001!3d33.37775035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88f4c62a4dc53ab9%3A0xf4ea9dda60240ecb!2sNewnan%2C%20GA%2C%20USA!5e0!3m2!1sen!2sni!4v1714168581395!5m2!1sen!2sni" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>';

?>
