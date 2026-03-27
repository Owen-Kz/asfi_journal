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

                        <div data-widget-def="UX3Tabs" data-widget-id="01cbe741-499a-4611-874e-1061f1f4679e" class="tabs--defult-style">
                            <h2 class="section__mainHeader--mid">Articles</h2>
                            <div data-ctrl-res="screen-md" class="tab">
                                <ul role="tablist" class="tab__nav rlist">
                                    <li role="presentation" class="tab__nav__item active">
                                        <a href="#pane-01cbe741-499a-4611-874e-1061f1f4679e01" aria-controls="pane-01cbe741-499a-4611-874e-1061f1f4679e01" role="tab" data-toggle="tab" class="tab__nav__item__link active">
                                            <span>Most Recent</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="dropdown" style="margin-left: 70%; position: absolute; margin-top: -40px; text-decoration: underline;">
                                    <span>Read More</span>
                                    <div class="dropdown-content">
                                        <a href="./issues">Issues</a>
                                        <a href="./supplements">Supplements</a>
                                    </div>
                                </div>
                                <div >
                                    <div id="pane-01cbe741-499a-4611-874e-1061f1f4679e01" class="grid grid-cols-2 gap-4" >
                                        <!-- <div data-mathjax="" class="top-content" id="articleListContainer"> -->
                                            <?php 
                                            // Include and render home items with caching
                                            include './backend/partials/renderItemsForHome.php';
                                            renderItemsForHome($con, 10);
                                            ?>
                                        <!-- </div> -->
                                        <a href="./issues" title="More articles" class="more-widget-link" style="display:flex; justify-content: flex-end; margin-bottom: 20px; margin-top: 6px; margin-right: 16px;">More articles</a>
                                    </div>
                                </div>
                            </div>
                        </div>

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
    
    document.addEventListener('DOMContentLoaded', function() {
        // Create modal container if it doesn't exist
        let shareModal = document.getElementById('shareModal');
        if (!shareModal) {
            shareModal = document.createElement('div');
            shareModal.id = 'shareModal';
            shareModal.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center';
            shareModal.innerHTML = `
                <div class="bg-white rounded-lg max-w-md w-full mx-4 p-6 relative">
                    <button class="absolute top-4 right-4 text-gray-400 hover:text-gray-600" id="closeShareModal">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <h3 class="text-xl font-semibold mb-4" id="shareModalTitle">Share Article</h3>
                    <p class="text-gray-600 mb-4" id="shareModalDescription"></p>
                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <button class="share-platform-btn bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors" data-platform="twitter">
                            <i class="fab fa-twitter mr-2"></i> Twitter
                        </button>
                        <button class="share-platform-btn bg-blue-800 text-white px-4 py-2 rounded-lg hover:bg-blue-900 transition-colors" data-platform="facebook">
                            <i class="fab fa-facebook mr-2"></i> Facebook
                        </button>
                        <button class="share-platform-btn bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition-colors" data-platform="linkedin">
                            <i class="fab fa-linkedin mr-2"></i> LinkedIn
                        </button>
                        <button class="share-platform-btn bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors" data-platform="whatsapp">
                            <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                        </button>
                        <button class="share-platform-btn bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors" data-platform="copy">
                            <i class="fas fa-copy mr-2"></i> Copy Link
                        </button>
                        <button class="share-platform-btn bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-700 transition-colors" data-platform="email">
                            <i class="fas fa-envelope mr-2"></i> Email
                        </button>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <input type="text" id="shareLink" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-gray-50" readonly>
                        <button id="copyLinkBtn" class="mt-2 w-full bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                            Copy Link
                        </button>
                    </div>
                </div>
            `;
            document.body.appendChild(shareModal);
        }

        let currentArticleUrl = '';
        let currentArticleTitle = '';

        // Share button click handler
        document.body.addEventListener('click', function(event) {
            const shareButton = event.target.closest('.shareButton');
            if (shareButton) {
                event.preventDefault();
                const articleId = shareButton.getAttribute('data-id');
                const articleTitle = shareButton.getAttribute('data-title');
                const currentUrl = window.location.origin + '/content?sid=' + articleId;
                
                currentArticleUrl = currentUrl;
                currentArticleTitle = articleTitle;
                
                // Update modal content
                document.getElementById('shareModalTitle').textContent = `Share: ${articleTitle}`;
                document.getElementById('shareModalDescription').textContent = `Share this article with your network`;
                document.getElementById('shareLink').value = currentUrl;
                
                // Show modal
                shareModal.classList.remove('hidden');
                shareModal.classList.add('flex');
            }
        });

        // Close modal handlers
        function closeModal() {
            shareModal.classList.add('hidden');
            shareModal.classList.remove('flex');
        }
        
        document.getElementById('closeShareModal').addEventListener('click', closeModal);
        shareModal.addEventListener('click', function(e) {
            if (e.target === shareModal) closeModal();
        });

        // Copy link button handler
        document.getElementById('copyLinkBtn').addEventListener('click', function() {
            const linkInput = document.getElementById('shareLink');
            linkInput.select();
            linkInput.setSelectionRange(0, 99999);
            
            try {
                document.execCommand('copy');
                showToast('Link copied to clipboard!', 'success');
            } catch (err) {
                showToast('Failed to copy link', 'error');
            }
        });

        // Platform-specific share handlers
        document.body.addEventListener('click', function(event) {
            const platformBtn = event.target.closest('.share-platform-btn');
            if (platformBtn && currentArticleUrl) {
                const platform = platformBtn.getAttribute('data-platform');
                let shareUrl = '';
                
                switch(platform) {
                    case 'twitter':
                        shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(currentArticleTitle)}&url=${encodeURIComponent(currentArticleUrl)}`;
                        break;
                    case 'facebook':
                        shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentArticleUrl)}`;
                        break;
                    case 'linkedin':
                        shareUrl = `https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(currentArticleUrl)}&title=${encodeURIComponent(currentArticleTitle)}`;
                        break;
                    case 'whatsapp':
                        shareUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(currentArticleTitle)} ${encodeURIComponent(currentArticleUrl)}`;
                        break;
                    case 'copy':
                        const linkInput = document.getElementById('shareLink');
                        linkInput.select();
                        linkInput.setSelectionRange(0, 99999);
                        document.execCommand('copy');
                        showToast('Link copied to clipboard!', 'success');
                        closeModal();
                        return;
                    case 'email':
                        shareUrl = `mailto:?subject=${encodeURIComponent(currentArticleTitle)}&body=${encodeURIComponent(`Check out this article: ${currentArticleTitle}\n\n${currentArticleUrl}`)}`;
                        break;
                    default:
                        return;
                }
                
                if (shareUrl) {
                    window.open(shareUrl, '_blank', 'width=600,height=400');
                    closeModal();
                }
            }
        });

        // Toast notification function
        function showToast(message, type) {
            const toast = document.createElement('div');
            toast.className = `fixed bottom-4 right-4 px-4 py-2 rounded-lg text-white z-50 transition-opacity duration-300 ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            }`;
            toast.textContent = message;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Optional: Add Web Share API support for mobile devices
        function useNativeShare(title, url) {
            if (navigator.share) {
                navigator.share({
                    title: title,
                    text: 'Check out this article',
                    url: url
                }).catch(console.error);
                return true;
            }
            return false;
        }
        
        // You can add a native share button in the modal if needed
        const shareModalContent = document.querySelector('#shareModal .bg-white');
        if (shareModalContent && navigator.share) {
            const nativeShareBtn = document.createElement('button');
            nativeShareBtn.className = 'w-full bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors mb-3';
            nativeShareBtn.innerHTML = '<i class="fas fa-share-alt mr-2"></i> Share via Native Share';
            nativeShareBtn.onclick = () => {
                useNativeShare(currentArticleTitle, currentArticleUrl);
                closeModal();
            };
            shareModalContent.insertBefore(nativeShareBtn, shareModalContent.querySelector('.grid-cols-2'));
        }
    });
</script>
</body>
</html>

<?php
// End output buffering and flush
ob_end_flush();
?>