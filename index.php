<?php
// Start output buffering for better performance
ob_start();
header('Content-Type: text/html; charset=UTF-8');
header("Cache-Control: public, max-age=3600");
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 3600) . " GMT");

// Include database connection
include './backend/db.php';
?>
<!-- mango mango  -->
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ASFI Research Journal - International Journal accepting contributions from all countries">
    <meta name="author" content="Weperch LLC">
    <title>ASFI Research Journal - Home</title>
    <meta name="title" content="ASFI Research Journal - Home">
    <meta name="description" content="ASFI Research Journal is an international journal, accepting contributions from all countries of the world. ASFIRJ publishes original papers, expert reviews, systematic reviews and meta-analyses, position papers, guidelines, protocols, data, editorials, news and commentaries, research letters.">
    <meta name="keywords" content="research,journal,africa,scholars,asfi,asfiresearchjournal,asfischolar">
    <link rel="shortcut icon" href="./assets/images/logoIcon/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="./assets/images/logoIcon/logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="ASFI Research Journal - Home">
    <meta itemprop="name" content="ASFI Research Journal - Home">
    <meta itemprop="description" content="ASFI Research Journal is an international journal, accepting contributions from all countries of the world.">
    <meta itemprop="image" content="assets/images/seo/65be1258275121706955352.png">
    <meta property="og:type" content="website">
    <meta property="og:title" content="ASFI Research Journal">
    <meta property="og:description" content="ASFI Research Journal - International Journal accepting contributions from all countries">
    <meta property="og:image" content="assets/images/seo/65be1258275121706955352.png">
    <meta property="og:image:type" content="png">
    <meta property="og:image:width" content="1180">
    <meta property="og:image:height" content="600">
    <meta property="og:url" content="index.html">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { 
            plugins: [tailwind.plugins.lineClamp],
            theme: {
                extend: {
                    colors: {
                        primary: '#80078b',
                        'primary-dark': '#6a0674',
                        'primary-light': '#9834db',
                        'dark-bg': '#1a1a2e',
                        'dark-card': '#2a2a4a',
                        gold: '#ffbf00',
                    }
                }
            }
        }
    </script>

    <style>
        /* Minimal custom styles that can't be done with Tailwind */
        #asfirj-share-modal {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.65);
            z-index: 2147483647;
            display: none;
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
        .asfirj-share-btn:hover { opacity: .88; }
        .asfirj-share-btn:active { transform: scale(.97); }
        .asfirj-share-btn.twitter { background: #1d9bf0; }
        .asfirj-share-btn.facebook { background: #1877f2; }
        .asfirj-share-btn.linkedin { background: #0a66c2; }
        .asfirj-share-btn.whatsapp { background: #25d366; }
        .asfirj-share-btn.email { background: #7b306c; }
        .asfirj-share-btn.copy { background: #374151; }
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
        .scroll-to-top {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }
        .scroll-to-top.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .google-translate-select {
            background: #2a2a4a !important;
            color: #fff !important;
            border: 1px solid #3a3a5a !important;
            padding: 4px 8px !important;
            border-radius: 4px !important;
            font-size: 13px !important;
        }

        /* SLIDE  */
        /* Carousel Styles - Add this to your page */
.carousel-item {
    display: none;
    position: relative;
    width: 100%;
    transition: opacity 0.7s ease-in-out;
}

.carousel-item.active {
    display: block;
}

.carousel-item.active.entering {
    opacity: 0;
}

.carousel-item.active.entered {
    opacity: 1;
}

/* Carousel controls */
.carousel-control {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 20;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    background: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
}

.carousel-control:hover {
    background: rgba(128, 7, 139, 0.8);
    transform: translateY(-50%) scale(1.1);
}

.carousel-control-prev {
    left: 16px;
}

.carousel-control-next {
    right: 16px;
}

/* Carousel indicators */
.carousel-indicators {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 20;
    display: flex;
    gap: 8px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.carousel-indicators li {
    width: 30px;
    height: 4px;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 2px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: block;
}

.carousel-indicators li.active {
    background: #80078b;
    width: 40px;
}

.carousel-indicators li:hover {
    background: rgba(255, 255, 255, 0.8);
}

/* Mobile responsive */
@media (max-width: 768px) {
    .carousel-control {
        width: 36px;
        height: 36px;
        font-size: 14px;
    }
    
    .carousel-control-prev {
        left: 8px;
    }
    
    .carousel-control-next {
        right: 8px;
    }
    
    .carousel-indicators li {
        width: 20px;
        height: 3px;
    }
    
    .carousel-indicators li.active {
        width: 30px;
    }
}
    </style>


<style>
/* Announcement animations and hover effects */
.announcement {
    animation: fadeInUp 0.5s ease-out forwards;
    opacity: 0;
}

.announcement:nth-child(1) { animation-delay: 0.1s; }
.announcement:nth-child(2) { animation-delay: 0.2s; }
.announcement:nth-child(3) { animation-delay: 0.3s; }
.announcement:nth-child(4) { animation-delay: 0.4s; }
.announcement:nth-child(5) { animation-delay: 0.5s; }

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Hover effect for announcement cards */
.announcement a:hover .fa-arrow-right {
    transform: translateX(4px);
}

/* Line clamp for multi-line truncation */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Loading spinner animation */
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

  
.animate-spin {
    animation: spin 1s linear infinite;
}
</style>
</head>

<body class="bg-white">
    <!-- Error/Success Popups -->
    <div id="errorPopup" class="fixed top-[30%] right-5 px-5 py-2.5 text-white rounded-md shadow-md opacity-0 border-none z-[9999999] transition-opacity duration-300 bg-red-600 hidden"></div>
    <div id="successPopup" class="fixed top-[30%] right-5 px-5 py-2.5 text-white rounded-md shadow-md opacity-0 border-none z-[9999999] transition-opacity duration-300 bg-green-500 hidden"></div>

    <?php include './components/top-navbar.php'; ?>

    <!-- Search Bar -->
    <div class="max-w-7xl mx-auto px-4 py-4">
        <form action="search" class="flex items-center gap-2 max-w-xl mx-auto bg-transparent border-none shadow-none">
            <input type="text" name="k" placeholder="Search articles within this journal" 
                   class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-primary transition-colors" />
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition-colors">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

<!-- Carousel -->
<div id="myCarousel" class="relative overflow-hidden">
    <!-- Indicators -->
    <ol class="carousel-indicators" id="carousel-indicators"></ol>
    
    <!-- Slides -->
    <div class="carousel-inner relative w-full overflow-hidden">
        <?php include "./backend/homeSlideArticles.php"; ?>
    </div>
    
    <!-- Controls -->
    <button class="carousel-control carousel-control-prev" id="carousel-prev">
        <i class="fas fa-chevron-left"></i>
        <span class="sr-only">Previous</span>
    </button>
    <button class="carousel-control carousel-control-next" id="carousel-next">
        <i class="fas fa-chevron-right"></i>
        <span class="sr-only">Next</span>
    </button>
</div>

    <!-- Main Content -->
    <section class="py-12">
        <div class="max-w-8xl mx-auto px-4">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-3/4 px-4">
                    <?php include './components/welcome-section.php'; ?>

                    <!-- Articles Section -->
                    <div class="mt-10 mb-16">
                        <!-- Section Header -->
                        <div class="flex flex-wrap justify-between items-center mb-6 pb-4 border-b-2 border-gray-200 gap-4">
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 m-0 relative after:content-[''] after:absolute after:bottom-[-17px] after:left-0 after:w-[60px] after:h-1 after:bg-gradient-to-r after:from-primary after:to-gold after:rounded">
                                Most Recent Articles
                            </h2>
                            <div class="relative">
                                <button class="dropdown-trigger bg-gray-100 border border-gray-200 px-5 py-2.5 rounded-full text-sm font-medium text-gray-600 hover:bg-primary hover:text-white hover:border-primary transition-all flex items-center gap-2">
                                    <span>Read More</span>
                                    <i class="fas fa-chevron-down text-xs transition-transform"></i>
                                </button>
                                <div class="dropdown-menu absolute top-full right-0 mt-2.5 bg-white rounded-xl shadow-lg min-w-[180px] py-2 opacity-0 invisible -translate-y-2.5 transition-all z-[100] border border-gray-200">
                                    <a href="./issues" class="block px-5 py-2.5 text-sm text-gray-600 hover:bg-gray-100 hover:text-primary hover:pl-6 transition-all">Issues</a>
                                    <a href="./supplements" class="block px-5 py-2.5 text-sm text-gray-600 hover:bg-gray-100 hover:text-primary hover:pl-6 transition-all">Supplements</a>
                                </div>
                            </div>
                        </div>

                        <!-- Articles Grid -->
                        <div id="pane-01cbe741-499a-4611-874e-1061f1f4679e01" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <?php 
                            include './backend/partials/renderItemsForHome.php';
                            renderItemsForHome($con, 10);
                            ?>
                        </div>

                        <!-- View All Link -->
                        <div class="text-right mt-5 pt-5 border-t border-gray-200">
                            <a href="./issues" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gray-100 text-primary rounded-full text-sm font-medium hover:bg-primary hover:text-white hover:gap-3 transition-all">
                                <span>View All Articles</span>
                                <i class="fas fa-arrow-right text-xs transition-transform"></i>
                            </a>
                        </div>
                    </div>

                    <?php include './components/action-cards.php'; ?>
                </div>

                <div class="w-full md:w-1/4 px-4">
                    <?php include './components/sidebar.php'; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-[#80078b] to-[#6a0674] py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center text-white">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Why Publish in ASFIRJ?</h2>
                <p class="text-gray-300 max-w-2xl mx-auto mb-6">
                    Within the African scientific community, ASFIRJ aims to offer an unparalleled reach and an author-friendly approach in scientific publishing - from manuscript submission through publication.
                </p>
                <a href="./aboutus.html" class="inline-block px-8 py-3 bg-[#6a0674] text-primary font-semibold rounded-md hover:bg-yellow-400 transition-colors">
                    About Us
                </a>
            </div>
        </div>
    </section>

    <?php include './components/why-publish-section.php'; ?>
    <?php include './components/footer.php'; ?>

    <!-- Scroll to Top Button -->
    <button id="scroll-top" class="scroll-to-top fixed bottom-8 right-8 z-50 w-12 h-12 bg-primary text-white rounded-full hover:bg-primary-dark hover:scale-110 transition-all shadow-lg border-none cursor-pointer">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Scripts -->
    <script src="./front/public/js/vendor/jquery-1.12.4.min.js"></script>
    <script>
    // Dropdown toggle
    document.addEventListener('DOMContentLoaded', function() {
        const trigger = document.querySelector('.dropdown-trigger');
        const menu = document.querySelector('.dropdown-menu');
        
        if (trigger && menu) {
            trigger.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.classList.toggle('show');
                menu.classList.toggle('opacity-100');
                menu.classList.toggle('visible');
                menu.classList.toggle('translate-y-0');
                this.querySelector('i').classList.toggle('rotate-180');
            });
            
            document.addEventListener('click', function(e) {
                if (!trigger.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.remove('show', 'opacity-100', 'visible', 'translate-y-0');
                    trigger.querySelector('i').classList.remove('rotate-180');
                }
            });
        }
    });

    // Scroll to top
    window.addEventListener('scroll', function() {
        var btn = document.getElementById('scroll-top');
        if (window.scrollY > 300) {
            btn.classList.add('visible');
        } else {
            btn.classList.remove('visible');
        }
    });

    document.getElementById('scroll-top').addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Set current year in footer
    document.addEventListener('DOMContentLoaded', function() {
        var yearSpan = document.getElementById('currentYear');
        if (yearSpan) yearSpan.textContent = new Date().getFullYear();
    });
    </script>
    <script src="./front/public/js/main.js"></script>
    <script src="./js/announcements/getPriority.js?v=3.w1k23"></script>

    <!-- Share Modal -->
    <div id="asfirj-share-modal" role="dialog" aria-modal="true">
        <div id="asfirj-share-inner">
            <button id="asfirj-share-close" aria-label="Close">&times;</button>
            <h3>Share Article</h3>
            <p id="asfirj-share-subtitle"></p>
            <div class="asfirj-share-grid">
                <button class="asfirj-share-btn twitter" data-platform="twitter">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    Twitter
                </button>
                <button class="asfirj-share-btn facebook" data-platform="facebook">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    Facebook
                </button>
                <button class="asfirj-share-btn linkedin" data-platform="linkedin">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451c.979 0 1.771-.773 1.771-1.729V1.729C24 .774 23.205 0 22.225 0z"/></svg>
                    LinkedIn
                </button>
                <button class="asfirj-share-btn whatsapp" data-platform="whatsapp">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.277-.582c.948.552 2.046.846 3.054.846 3.18 0 5.767-2.586 5.768-5.766.001-3.18-2.585-5.767-5.768-5.767zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.068-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.938-.708-1.791 0-.852.448-1.27.608-1.444.159-.174.347-.218.463-.218h.324c.116 0 .3-.015.463.348.163.362.52 1.259.566 1.349.047.09.075.193.018.31-.058.118-.099.189-.189.302-.089.113-.187.26-.269.35-.089.1-.182.208-.078.407.104.199.464.766.996 1.24.685.61 1.262.796 1.44.886.178.09.283.074.386-.045.104-.119.448-.524.567-.704.119-.18.239-.151.401-.09.162.06 1.034.488 1.212.576.178.088.296.13.34.204.045.075.045.433-.099.838z"/></svg>
                    WhatsApp
                </button>
                <button class="asfirj-share-btn email" data-platform="email">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    Email
                </button>
                <button class="asfirj-share-btn copy" data-platform="copy">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                    Copy Link
                </button>
            </div>
            <div id="asfirj-share-link-row">
                <input id="asfirj-share-link-input" type="text" readonly />
                <button id="asfirj-copy-link-btn">Copy</button>
            </div>
        </div>
    </div>
    <div id="asfirj-toast"></div>

    
<script>
    // Carousel functionality
(function() {
    const carousel = document.getElementById('myCarousel');
    if (!carousel) return;
    
    const items = carousel.querySelectorAll('.carousel-item');
    if (items.length === 0) return;
    
    let current = 0;
    let intervalId = null;
    const AUTO_INTERVAL = 5000; // 5 seconds

    // Build indicators
    const indicators = document.getElementById('carousel-indicators');
    if (indicators) {
        indicators.innerHTML = '';
        items.forEach((item, index) => {
            const li = document.createElement('li');
            if (index === 0) li.classList.add('active');
            li.setAttribute('data-index', index);
            li.addEventListener('click', () => goTo(index));
            indicators.appendChild(li);
        });
    }

    function goTo(index) {
        // Remove active class from current item
        items[current].classList.remove('active');
        if (indicators) {
            indicators.children[current].classList.remove('active');
        }
        
        // Add active class to new item
        current = index;
        items[current].classList.add('active');
        if (indicators) {
            indicators.children[current].classList.add('active');
        }
    }

    function next() {
        goTo((current + 1) % items.length);
    }

    function prev() {
        goTo((current - 1 + items.length) % items.length);
    }

    function startAutoPlay() {
        if (intervalId) clearInterval(intervalId);
        intervalId = setInterval(next, AUTO_INTERVAL);
    }

    function stopAutoPlay() {
        if (intervalId) {
            clearInterval(intervalId);
            intervalId = null;
        }
    }

    // Event listeners
    const prevBtn = document.getElementById('carousel-prev');
    const nextBtn = document.getElementById('carousel-next');
    
    if (prevBtn) prevBtn.addEventListener('click', (e) => {
        e.preventDefault();
        stopAutoPlay();
        prev();
        startAutoPlay();
    });
    
    if (nextBtn) nextBtn.addEventListener('click', (e) => {
        e.preventDefault();
        stopAutoPlay();
        next();
        startAutoPlay();
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            stopAutoPlay();
            prev();
            startAutoPlay();
        }
        if (e.key === 'ArrowRight') {
            stopAutoPlay();
            next();
            startAutoPlay();
        }
    });

    // Pause on hover
    carousel.addEventListener('mouseenter', stopAutoPlay);
    carousel.addEventListener('mouseleave', startAutoPlay);

    // Start auto-play
    startAutoPlay();
})();
</script>
    <script>
    (function() {
        var modal = document.getElementById('asfirj-share-modal');
        var toast = document.getElementById('asfirj-toast');
        var articleUrl = '';
        var articleTitle = '';

        function openModal(id, title) {
            articleUrl = window.location.origin + '/content?sid=' + encodeURIComponent(id);
            articleTitle = title;
            document.getElementById('asfirj-share-subtitle').textContent = title;
            document.getElementById('asfirj-share-link-input').value = articleUrl;
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }

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

        function copyToClipboard(text) {
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(text).then(function() { showToast('Link copied!'); }).catch(function() { fallbackCopy(text); });
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

        function showToast(msg) {
            toast.textContent = msg;
            toast.classList.add('show');
            setTimeout(function() { toast.classList.remove('show'); }, 2500);
        }

        document.body.addEventListener('click', function(e) {
            var btn = e.target.closest('.shareButton');
            if (btn) {
                e.preventDefault();
                e.stopPropagation();
                openModal(btn.getAttribute('data-id'), btn.getAttribute('data-title'));
                return;
            }
            var platformBtn = e.target.closest('[data-platform]');
            if (platformBtn && modal.contains(platformBtn)) {
                share(platformBtn.getAttribute('data-platform'));
                return;
            }
            if (e.target === modal) { closeModal(); }
        });

        document.getElementById('asfirj-share-close').addEventListener('click', closeModal);
        document.getElementById('asfirj-copy-link-btn').addEventListener('click', function() {
            copyToClipboard(document.getElementById('asfirj-share-link-input').value);
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
    })();
    </script>
</body>
</html>

<?php
ob_end_flush();
?>