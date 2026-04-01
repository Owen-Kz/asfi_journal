<?php
// Start output buffering for better performance
ob_start();

// Set caching headers for better performance
header("Cache-Control: public, max-age=3600"); // Cache for 1 hour
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 3600) . " GMT");

// Include database connection
include './backend/db.php';
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Secure and reliable investment project">
    <meta name="author" content="Weperch LLC">
    <title> ASFI Research Journal - Home</title>
    <meta name="title" Content="ASFI Research Journal - Home">

    <meta name="description"
        content="ASFI Research Journal is an international journal, accepting contributions from all countries of the world. ASFIRJ publishes original papers, expert reviews, systematic reviews and meta-analyses, position papers, guidelines, protocols, data, editorials, news and commentaries, research letters.">
    <meta name="keywords" content="research,journal,africa,scholars,asfi, asfiresearchjournal, asfischolar">
    <link rel="shortcut icon" href="./assets/images/logoIcon/favicon.png" type="image/x-icon">

    <link rel="apple-touch-icon" href="./assets/images/logoIcon/logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="ASFI Research Journal - Home">

    <meta itemprop="name" content="ASFI Research Journal - Home">
    <meta itemprop="description"
        content="ASFI Research Journal is an international journal, accepting contributions from all countries of the world. ASFIRJ publishes original papers, expert reviews, systematic reviews and meta-analyses, position papers, guidelines, protocols, data, editorials, news and commentaries, research letters.">
    <meta itemprop="image" content="assets/images/seo/65be1258275121706955352.png">

    <meta property="og:type" content="website">
    <meta property="og:title" content="ASFI Research Journal">
    <meta property="og:description"
        content="ASFI Research Journal is an international journal, accepting contributions from all countries of the world. ASFIRJ publishes original papers, expert reviews, systematic reviews and meta-analyses, position papers, guidelines, protocols, data, editorials, news and commentaries, research letters.">
    <meta property="og:image" content="assets/images/seo/65be1258275121706955352.png" />
    <meta property="og:image:type" content="png" />
    <meta property="og:image:width" content="1180" />
    <meta property="og:image:height" content="600" />
    <meta property="og:url" content="index.html">

    <meta name="twitter:card" content="summary_large_image">

    <!-- Optimized CSS loading - combine when possible -->
    <link rel="stylesheet" href="./front/public/css/fontawesome.min.css">
    <link rel="stylesheet" href="./front/public/css/line-awesome.min.css">
    <link rel="stylesheet" href="./front/public/css/business-icon.css">
    <link rel="stylesheet" href="./front/public/css/animate.min.css">
    <link rel="stylesheet" href="./front/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="./front/public/css/slick.min.css">
    <link rel="stylesheet" href="./front/public/css/venobox.min.css">
    <link rel="stylesheet" href="./front/public/css/odometer.min.css">
    <link rel="stylesheet" href="./front/public/css/nice-select.css">
    <link rel="stylesheet" href="./front/public/css/splitting-cells.css">
    <link rel="stylesheet" href="./front/public/css/splitting.css">
    <link rel="stylesheet" href="./front/public/css/keyframe-animation.css">
    <link rel="stylesheet" href="./front/public/css/slider.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./front/public/css/header.css">
    <link rel="stylesheet" href="./front/public/css/footer.css">
    <link href="./front/public/css/carousel/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="./front/public/css/carousel/ie10-viewport-bug-workaround.css" rel="stylesheet" type="text/css" />
    <link href="./front/public/css/carousel/carousel.css" rel="stylesheet" type="text/css" />
    <link href="./front/public/css/carousel/jumbotron.css" rel="stylesheet" type="text/css" />
    <link href="./front/public/css/carousel/custom-icons.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="./front/public/css/main.css">
    <link rel="stylesheet" href="./front/public/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/brands.min.css">
    
    <script src="./front/public/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .footer-section a {
            color: #dbdadaa9;
        }
        .tab__nav {
            border-bottom: 1px solid #80078b;
        }
        .tab__nav li .active {
            background-color: #80078b;
            color: white;
        }
        .tab__nav li {
            display: inline-block;
            margin-bottom: .625rem;
        }
        .tab__nav a {
            font-weight: 600;
            border: none;
            padding: .625rem;
        }
        .doi-access-wrapper {
            padding-bottom: 15px;
            display: flex;
            justify-content: space-between;
        }
        .rlist--inline {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .content-item-format-links .rlist--inline li {
            margin-right: 10px;
            font-weight: bold;
            color: #310357;
        }
        .content-item-format-links .rlist--inline li a {
            padding-right: 10px;
            color: #310357;
        }
        .comma p {
            color: #3b3b3b;
        }
        .issue-item__details {
            margin-top: 10px;
        }
        .section__mainHeader--mid {
            margin-top: 20px;
            font-size: 20px;
        }
        @media (min-width: 768px) {
            .col-md-8 {
                -ms-flex: 0 0 66.666667%;
                flex: 0 0 66.666667%;
                max-width: 100%;
            }
            .col-md-4 {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 100%;
            }
        }
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.5);
            z-index: 9999;
            display: none;
        }
        .loader {
            border: 16px solid #f3f3f3;
            border-top: 16px solid #9834db;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            margin: auto;
            margin-top: 20%;
            animation: spin 2s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .errorpopup, .successpopup {
            position: fixed;
            top: 30%;
            right: 20px;
            padding: 10px 20px;
            color: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            opacity: 0;
            outline: none;
            border: none;
            z-index: 9999999;
            transition: opacity 0.3s ease-in-out;
        }
        .errorpopup { background-color: #e22424; }
        .successpopup { background-color: #4CAF50; }
        .errorpopup.show, .successpopup.show { opacity: 1; }
        .errorpopup.hidden, .successpopup.hidden { display: none; }
        .share-options {
            background-color: white;
            border: 1px solid #ddd;
            padding: 10px;
            z-index: 1000;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .share-options ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .share-options li {
            margin: 5px 0;
            cursor: pointer;
            margin-right: 10px;
        }
        .share-options li:hover { color: #007bff; }
        .shareButton { cursor: pointer; }
        .doi-access-wrapper .articleSpan { margin-right: 20px; }
        
        @media screen and (max-width: 720px) {
            .doi-access-wrapper { font-size: 12px; }
            .doi-access-wrapper .articleSpan {
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            .editchoice { margin-left: 0px; }
            .issue-item__title { font-size: 16px; }
            .comma p { font-size: 12px; }
            .issue-item__details { font-size: 14px; }
            .content-item-format-links .rlist--inline li { font-size: 12px; }
        }
        .footer-widget p, .widget-links a { font-size: 1.3rem; }
        .widget-links .fa-square-full { display: none; }
    </style>
</head>

<body class="header-1 business">
    <!-- <div class="site-preloader-wrap">
        <div class="spinner"></div>
    </div> -->
    <!-- <div class="preloader" id="preloader">
        <div class="loader"></div>
    </div> -->
    <div id="errorPopup" class="errorpopup hidden"></div>
    <div id="successPopup" class="successpopup hidden"></div>

    <?php include './components/top-navbar.php'; ?>
    <?php include './components/header.php'; ?>

    <div class="right-search-submit">
        <input type="text" placeholder="Search articles within this journal" />
        <button class="search-btn"><i class="fas fa-search"></i></button>
    </div>

    <div id="myCarousel" class="carousel" data-ride="carousel">
        <ol class="carousel-indicators"></ol>
        <div class="carousel-inner" role="listbox">
            <?php include "./backend/homeSlideArticles.php"; ?>
        </div>
        <a class="left carousel-control" style="display: flex; justify-content: center; align-items: center;" href="#myCarousel" role="button" data-slide="prev">
            <span class="fa fa-arrow-left" aria-hidden="true"></span><span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" style="display: flex; justify-content: center; align-items: center;" href="#myCarousel" role="button" data-slide="next">
            <span class="fa fa-arrow-right" aria-hidden="true"></span><span class="sr-only">Next</span>
        </a>
    </div>

    <section class="article-section bd-bottom padding" style="display: flex; flex-direction: column;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="gutterless--xs gutterless--sm gutterless--md main-content col-md-9">
                        <div id="rich-text-3643f25c-5be2-4cc8-a718-3728186a2285" class="pb-rich-text">
                            <p><em>ASFIRJ</em>, the official journal of the African Science Frontiers Initiatives (ASFI), stands as an online-only, open-access multidisciplinary journal, dedicated to advancing, impacting, and communicating research from all disciplines, encompassing both basic and applied studies. Within the African scientific community, <em>ASFIRJ</em> endeavors to provide an unparalleled platform, offering an author-friendly approach to scientific publishing from manuscript submission through publication. Our overarching ambition is to emerge as one of Africa's leading research journals, globally competitive, and unwaveringly focused on delivering quality research with significant impact.</p>
                        </div>

                        <div data-widget-def="UX3Tabs" data-widget-id="01cbe741-499a-4611-874e-1061f1f4679e" class="tabs--defult-style articles-section">
    <!-- Section Header -->
    <div class="articles-header">
        <h2 class="section__mainHeader--mid">Articles</h2>
        <div class="articles-dropdown">
            <button class="dropdown-trigger">
                <span>Read More</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="dropdown-menu-custom">
                <a href="./issues">Issues</a>
                <a href="./supplements">Supplements</a>
            </div>
        </div>
    </div>
    
    <div data-ctrl-res="screen-md" class="tab">
        <div class="mb-6">
    <span class="inline-flex items-center gap-2 bg-[#80078b] text-white font-semibold text-[12px] uppercase tracking-wide px-4 py-2 rounded-full">
        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
        Most Recent
    </span>
</div>
        
        <div class="articles-content">
            <div id="pane-01cbe741-499a-4611-874e-1061f1f4679e01" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php 
                include './backend/partials/renderItemsForHome.php';
                renderItemsForHome($con, 10);
                ?>
            </div>
            <div class="articles-footer">
                <a href="./issues" title="More articles" class="more-articles-link">
                    <span>View All Articles</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Articles Section Styling */
    .articles-section {
        margin-top: 40px;
        margin-bottom: 60px;
    }
    
    /* Section Header */
    .articles-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e9ecef;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .section__mainHeader--mid {
        font-size: 28px;
        font-weight: 700;
        color: #2c2c2c;
        margin: 0;
        position: relative;
    }
    
    .section__mainHeader--mid:after {
        content: '';
        position: absolute;
        bottom: -17px;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #80078b, #ffbf00);
        border-radius: 3px;
    }
    
    /* Custom Dropdown */
    .articles-dropdown {
        position: relative;
    }
    
    .dropdown-trigger {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        padding: 10px 20px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 500;
        color: #555;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    
    .dropdown-trigger:hover {
        background: #80078b;
        color: #fff;
        border-color: #80078b;
    }
    
    .dropdown-trigger i {
        font-size: 12px;
        transition: transform 0.3s ease;
    }
    
    .dropdown-trigger.active i {
        transform: rotate(180deg);
    }
    
    .dropdown-menu-custom {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        min-width: 180px;
        padding: 8px 0;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        z-index: 100;
        border: 1px solid #e9ecef;
    }
    
    .dropdown-menu-custom.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    
    .dropdown-menu-custom a {
        display: block;
        padding: 10px 20px;
        color: #555;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.2s ease;
    }
    
    .dropdown-menu-custom a:hover {
        background: #f8f9fa;
        color: #80078b;
        padding-left: 25px;
    }
    
    /* Tab Navigation */
    .tab__nav {
        list-style: none;
        padding: 0;
        margin: 0 0 30px 0;
        display: flex;
        gap: 20px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .tab__nav__item {
        margin-bottom: -1px;
    }
    
    .tab__nav__item__link {
        display: block;
        padding: 10px 0;
        font-size: 16px;
        font-weight: 600;
        color: #888;
        text-decoration: none;
        border-bottom: 2px solid transparent;
        transition: all 0.3s ease;
    }
    
    .tab__nav__item__link:hover {
        color: #80078b;
    }
    
    .tab__nav__item.active .tab__nav__item__link {
        color: #80078b;
        border-bottom-color: #80078b;
    }
    
    /* Articles Grid */
    .articles-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }
    
    /* Articles Footer */
    .articles-footer {
        text-align: right;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
    }
    
    .more-articles-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 24px;
        background: #f8f9fa;
        color: #80078b;
        text-decoration: none;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .more-articles-link:hover {
        background: #80078b;
        color: #fff;
        gap: 12px;
    }
    
    .more-articles-link i {
        font-size: 12px;
        transition: transform 0.3s ease;
    }
    
    .more-articles-link:hover i {
        transform: translateX(4px);
    }
    
    /* Mobile Responsive */
    @media (max-width: 768px) {
        .articles-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .section__mainHeader--mid {
            font-size: 24px;
        }
        
        .section__mainHeader--mid:after {
            bottom: -12px;
            width: 50px;
        }
        
        .articles-dropdown {
            align-self: flex-end;
        }
        
        .dropdown-menu-custom {
            left: 0;
            right: auto;
            min-width: 160px;
        }
        
        .tab__nav {
            gap: 15px;
        }
        
        .tab__nav__item__link {
            font-size: 14px;
        }
        
        .articles-footer {
            text-align: center;
        }
        
        .more-articles-link {
            width: 100%;
            justify-content: center;
        }
    }
    
    /* Tablet Responsive */
    @media (min-width: 769px) and (max-width: 1024px) {
        .articles-grid {
            gap: 25px;
        }
    }
</style>

<script>
    // Dropdown toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownTrigger = document.querySelector('.dropdown-trigger');
        const dropdownMenu = document.querySelector('.dropdown-menu-custom');
        
        if (dropdownTrigger && dropdownMenu) {
            dropdownTrigger.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('show');
                this.classList.toggle('active');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!dropdownTrigger.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                    dropdownTrigger.classList.remove('active');
                }
            });
            
            // Close dropdown when clicking a link
            dropdownMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function() {
                    dropdownMenu.classList.remove('show');
                    dropdownTrigger.classList.remove('active');
                });
            });
        }
    });
</script>

                        

                        <?php include './components/welcome-section.php'; ?>
                    </div>

                    <?php include './components/sidebar.php'; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section bg-grey">
        <div class="container">
            <div class="row cta-wrap">
                <div class="col-md-12 wow fadeInLeft" data-wow-delay="200ms">
                    <div class="cta-content">
                        <h2>Why Publish in ASFIRJ?</h2>
                        <p style="color: rgba(245, 245, 245, 0.781);">
                            Within the African scientific community, ASFIRJ aims to offer an unparalleled reach and an author-friendly approach in scientific publishing - from manuscript submission through publication.
                        </p>
                        <a href="./aboutus.html" class="default-btn">About Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include './components/why-publish-section.php'; ?>
    <?php include './components/footer.php'; ?>

    <!-- Optimized script loading at the end -->
    <script src="./front/public/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="./front/public/js/vendor/popper.min.js"></script>
    <script src="./front/public/js/vendor/bootstrap.min.js"></script>

    <script>
// Ensure carousel works when page loads
$(document).ready(function() {
    // Initialize carousel
    $('#myCarousel').carousel({
        interval: 5000,  // Auto-slide every 5 seconds
        pause: 'hover',   // Pause on hover
        wrap: true,       // Continuous loop
        keyboard: true    // Keyboard navigation
    });
    
    // Generate indicators if they don't exist
    var itemCount = $('#myCarousel .item').length;
    var indicatorCount = $('#myCarousel .carousel-indicators li').length;
    
    if (itemCount > 0 && indicatorCount === 0) {
        var indicators = '<ol class="carousel-indicators">';
        for (var i = 0; i < itemCount; i++) {
            indicators += '<li data-target="#myCarousel" data-slide-to="' + i + '"' + (i === 0 ? ' class="active"' : '') + '></li>';
        }
        indicators += '</ol>';
        $('#myCarousel').prepend(indicators);
    }
});
</script>
    <script src="./front/public/js/vendor/waypoints.min.js"></script>
    <script src="./front/public/js/vendor/slick.min.js"></script>
    <script src="./front/public/js/vendor/jquery.ajaxchimp.min.js"></script>
    <script src="./front/public/js/vendor/odometer.min.js"></script>
    <script src="./front/public/js/vendor/jquery.isotope.v3.0.2.js"></script>
    <script src="./front/public/js/vendor/imagesloaded.pkgd.min.js"></script>
    <script src="./front/public/js/vendor/venobox.min.js"></script>
    <script src="./front/public/js/vendor/jquery.hoverdir.js"></script>
    <script src="./front/public/js/vendor/splitting.min.js"></script>
    <script src="./front/public/js/vendor/jquery.nice-select.min.js"></script>
    <script src="./front/public/js/vendor/wow.min.js"></script>
    <script src="./assets/templates/metro_hyip/js/main.js"></script>
    <script src="./assets/global/js/iziToast.min.js"></script>
    <script src="./front/public/js/slider.js" type="module"></script>
    <script type="module" src="./js/general.js"></script>
    <script src="./front/public/js/main.js"></script>
    <script src="./js/announcements/getPriority.js"></script>
    <script src="./js/slider/bootstrap.min.js" type="text/javascript"></script>
    <script src="./js/slider/ie10-viewport-bug-workaround.js" type="text/javascript"></script>
    
<script>
    tailwind.config = { plugins: [tailwind.plugins.lineClamp] }
</script>

<!-- ═══════════════════════════════════════════════════════════
     SHARE MODAL — built entirely with inline styles so it is
     100% immune to Tailwind's  display:none !important  and to
     Bootstrap / any other CSS on the page.
     The modal div is injected directly on <body> so it can never
     be clipped by an  overflow:hidden  ancestor.
════════════════════════════════════════════════════════════════ -->
<style>
  /* Only non-Tailwind rules needed for the modal */
  #asfirj-share-modal {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.65);
    z-index: 2147483647;   /* Maximum possible z-index */
    display: none;         /* toggled via JS style.display only */
    align-items: center;
    justify-content: center;
    padding: 16px;
    box-sizing: border-box;
  }
  #asfirj-share-modal.open { display: flex; }

  #asfirj-share-inner {
    background: #fff;
    border-radius: 14px;
    width: 100%;
    max-width: 440px;
    padding: 28px 24px 24px;
    position: relative;
    box-shadow: 0 24px 48px rgba(0,0,0,.18);
    box-sizing: border-box;
  }

  #asfirj-share-close {
    position: absolute;
    top: 14px; right: 14px;
    background: #f3f4f6;
    border: none;
    border-radius: 50%;
    width: 32px; height: 32px;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    color: #6b7280;
    font-size: 18px;
    line-height: 1;
    transition: background .15s;
  }
  #asfirj-share-close:hover { background: #e5e7eb; }

  #asfirj-share-modal h3 {
    font-size: 18px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 6px;
  }
  #asfirj-share-modal p {
    font-size: 13px;
    color: #6b7280;
    margin: 0 0 18px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .asfirj-share-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-bottom: 16px;
  }
  .asfirj-share-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 14px;
    border: none;
    border-radius: 9px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    color: #fff;
    transition: opacity .15s, transform .1s;
  }
  .asfirj-share-btn:hover  { opacity: .88; }
  .asfirj-share-btn:active { transform: scale(.97); }
  .asfirj-share-btn.full   { grid-column: span 2; }

  .asfirj-share-btn.twitter  { background: #1d9bf0; }
  .asfirj-share-btn.facebook { background: #1877f2; }
  .asfirj-share-btn.linkedin { background: #0a66c2; }
  .asfirj-share-btn.whatsapp { background: #25d366; }
  .asfirj-share-btn.email    { background: #7b306c; }
  .asfirj-share-btn.copy     { background: #374151; }

  #asfirj-share-link-row {
    display: flex;
    gap: 8px;
    align-items: center;
    margin-top: 4px;
  }
  #asfirj-share-link-input {
    flex: 1;
    padding: 8px 10px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 13px;
    background: #f9fafb;
    color: #374151;
    outline: none;
  }
  #asfirj-copy-link-btn {
    padding: 8px 14px;
    background: #7b306c;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    white-space: nowrap;
    transition: opacity .15s;
  }
  #asfirj-copy-link-btn:hover { opacity: .88; }

  #asfirj-toast {
    position: fixed;
    bottom: 28px;
    left: 50%;
    transform: translateX(-50%);
    background: #111827;
    color: #fff;
    padding: 10px 22px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    z-index: 2147483647;
    pointer-events: none;
    opacity: 0;
    transition: opacity .25s;
  }
  #asfirj-toast.show { opacity: 1; }
</style>

<script>
(function () {
  /* ── Build modal DOM once ─────────────────────────────────── */
  var modal = document.createElement('div');
  modal.id = 'asfirj-share-modal';
  modal.setAttribute('role', 'dialog');
  modal.setAttribute('aria-modal', 'true');
  modal.innerHTML =
    '<div id="asfirj-share-inner">' +
      '<button id="asfirj-share-close" aria-label="Close">&times;</button>' +
      '<h3>Share Article</h3>' +
      '<p id="asfirj-share-subtitle"></p>' +
      '<div class="asfirj-share-grid">' +
        '<button class="asfirj-share-btn twitter"  data-platform="twitter">' +
          '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>' +
          'Twitter' +
        '</button>' +
        '<button class="asfirj-share-btn facebook" data-platform="facebook">' +
          '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>' +
          'Facebook' +
        '</button>' +
        '<button class="asfirj-share-btn linkedin" data-platform="linkedin">' +
          '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451c.979 0 1.771-.773 1.771-1.729V1.729C24 .774 23.205 0 22.225 0z"/></svg>' +
          'LinkedIn' +
        '</button>' +
        '<button class="asfirj-share-btn whatsapp" data-platform="whatsapp">' +
          '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.277-.582c.948.552 2.046.846 3.054.846 3.18 0 5.767-2.586 5.768-5.766.001-3.18-2.585-5.767-5.768-5.767zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.068-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.938-.708-1.791 0-.852.448-1.27.608-1.444.159-.174.347-.218.463-.218h.324c.116 0 .3-.015.463.348.163.362.52 1.259.566 1.349.047.09.075.193.018.31-.058.118-.099.189-.189.302-.089.113-.187.26-.269.35-.089.1-.182.208-.078.407.104.199.464.766.996 1.24.685.61 1.262.796 1.44.886.178.09.283.074.386-.045.104-.119.448-.524.567-.704.119-.18.239-.151.401-.09.162.06 1.034.488 1.212.576.178.088.296.13.34.204.045.075.045.433-.099.838z"/></svg>' +
          'WhatsApp' +
        '</button>' +
        '<button class="asfirj-share-btn email" data-platform="email">' +
          '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>' +
          'Email' +
        '</button>' +
        '<button class="asfirj-share-btn copy" data-platform="copy">' +
          '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>' +
          'Copy Link' +
        '</button>' +
      '</div>' +
      '<div id="asfirj-share-link-row">' +
        '<input id="asfirj-share-link-input" type="text" readonly />' +
        '<button id="asfirj-copy-link-btn">Copy</button>' +
      '</div>' +
    '</div>';

  /* Toast element */
  var toast = document.createElement('div');
  toast.id = 'asfirj-toast';

  /* Append both to body immediately (not waiting for DOMContentLoaded
     so they are always in the DOM when the user clicks) */
  document.addEventListener('DOMContentLoaded', function () {
    document.body.appendChild(modal);
    document.body.appendChild(toast);
    bindEvents();
  });

  /* ── State ───────────────────────────────────────────────── */
  var articleUrl   = '';
  var articleTitle = '';

  /* ── Open / Close ────────────────────────────────────────── */
  function openModal(id, title) {
    articleUrl   = window.location.origin + '/content?sid=' + encodeURIComponent(id);
    articleTitle = title;

    document.getElementById('asfirj-share-subtitle').textContent = title;
    document.getElementById('asfirj-share-link-input').value = articleUrl;

    /* Use style.display directly — completely bypasses Tailwind hidden / Bootstrap */
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    modal.style.display = 'none';
    document.body.style.overflow = '';
  }

  /* ── Share platforms ─────────────────────────────────────── */
  function share(platform) {
    var url = '';
    switch (platform) {
      case 'twitter':
        url = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(articleTitle) + '&url=' + encodeURIComponent(articleUrl);
        break;
      case 'facebook':
        url = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(articleUrl);
        break;
      case 'linkedin':
        url = 'https://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(articleUrl) + '&title=' + encodeURIComponent(articleTitle);
        break;
      case 'whatsapp':
        url = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(articleTitle + ' ' + articleUrl);
        break;
      case 'email':
        url = 'mailto:?subject=' + encodeURIComponent(articleTitle) + '&body=' + encodeURIComponent('Check out this article:\n\n' + articleUrl);
        break;
      case 'copy':
        copyToClipboard(articleUrl);
        closeModal();
        return;
    }
    if (url) { window.open(url, '_blank', 'noopener,noreferrer,width=600,height=450'); closeModal(); }
  }

  /* ── Clipboard helper ────────────────────────────────────── */
  function copyToClipboard(text) {
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(text).then(function () { showToast('Link copied!'); }).catch(fallbackCopy.bind(null, text));
    } else {
      fallbackCopy(text);
    }
  }
  function fallbackCopy(text) {
    var ta = document.createElement('textarea');
    ta.value = text;
    ta.style.cssText = 'position:fixed;opacity:0;top:0;left:0';
    document.body.appendChild(ta);
    ta.focus(); ta.select();
    try { document.execCommand('copy'); showToast('Link copied!'); } catch(e) { showToast('Copy failed — please copy manually.'); }
    document.body.removeChild(ta);
  }

  /* ── Toast ───────────────────────────────────────────────── */
  function showToast(msg) {
    toast.textContent = msg;
    toast.classList.add('show');
    setTimeout(function () { toast.classList.remove('show'); }, 2500);
  }

  /* ── Event bindings ──────────────────────────────────────── */
  function bindEvents() {
    /* Open: delegated click on any .shareButton anywhere on page */
    document.body.addEventListener('click', function (e) {
      var btn = e.target.closest('.shareButton');
      if (btn) {
        e.preventDefault();
        e.stopPropagation();
        openModal(
          btn.getAttribute('data-id'),
          btn.getAttribute('data-title')
        );
        return;
      }

      /* Platform buttons inside modal */
      var platformBtn = e.target.closest('[data-platform]');
      if (platformBtn && modal.contains(platformBtn)) {
        share(platformBtn.getAttribute('data-platform'));
        return;
      }

      /* Backdrop click closes */
      if (e.target === modal) { closeModal(); }
    });

    /* Close button */
    document.getElementById('asfirj-share-close').addEventListener('click', closeModal);

    /* Copy button in link row */
    document.getElementById('asfirj-copy-link-btn').addEventListener('click', function () {
      copyToClipboard(document.getElementById('asfirj-share-link-input').value);
    });

    /* Escape key */
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeModal();
    });
  }
})();
</script>
</body>
</html>

<?php
// End output buffering and flush
ob_end_flush();
?>