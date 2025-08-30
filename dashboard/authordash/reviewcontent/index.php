<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage" class="h-full">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Review Details - Dashboard</title>
    <meta name="title" Content="Author - Dashboard">

    <meta name="description" content="asfiresearchjournal">
    <meta name="keywords" content="asfiresearchjournal">
    <link rel="shortcut icon" href="../../../assets/images/logoIcon/favicon.png" type="image/x-icon">

    <link rel="apple-touch-icon" href="../../../assets/images/logoIcon/logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Author - Dashboard">
    
    <meta itemprop="name" content="Author - Dashboard">
    <meta itemprop="description" content="asfiresearchjournal">
    <meta itemprop="image" content="../../../assets/images/seo/65be1258275121706955352.png">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="ASFIRJ">
    <meta property="og:description" content="asfiresearchjournal">
    <meta property="og:image" content="../../../assets/images/seo/65be1258275121706955352.png"/>
    <meta property="og:image:type" content="png"/>
    <meta property="og:image:width" content="1180" />
    <meta property="og:image:height" content="600" />
    <meta property="og:url" content="../../../dashboard">
    
    <meta name="twitter:card" content="summary_large_image">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#310357',
                        secondary: '#EB4830',
                        accent: '#320359',
                        light: '#f8f9fa',
                        dark: '#404040',
                    }
                }
            }
        }
    </script>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar-menu-item {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .sidebar-menu-item:hover {
            padding-left: 1.5rem;
            transform: translateX(5px);
        }
        .sidebar-menu-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: #310357;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .sidebar-menu-item:hover::before {
            opacity: 1;
        }
        .active-menu-item {
            background: linear-gradient(90deg, rgba(49, 3, 87, 0.1) 0%, rgba(49, 3, 87, 0.05) 100%);
            padding-left: 1.5rem;
            border-left: 4px solid #310357;
        }
        .active-menu-item::before {
            opacity: 1;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #310357 0%, #6B21A8 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        .nav-active {
            border-bottom: 3px solid #EB4830;
        }
        .score-cell {
            width: 80px;
            text-align: center;
            font-weight: 600;
        }
        .score-progress {
            height: 6px;
            background-color: #e5e7eb;
            border-radius: 3px;
            overflow: hidden;
        }
        .score-progress-fill {
            height: 100%;
            border-radius: 3px;
        }
        .section-header {
            background: linear-gradient(90deg, #f9fafb 0%, #f3f4f6 100%);
        }
    </style>
    
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
        }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>

<body class="h-full bg-gray-50">
    
    <div class="preloader">
        <div class="loader-p"></div>
    </div>

    <div class="body-overlay"></div>

    <div class="sidebar-overlay"></div>

    <a class="scroll-top"><i class="fas fa-angle-double-up"></i></a>

    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <?php include_once("../../partials/navbar.php"); ?>

        <!-- Main Content -->
        <div class="flex flex-1">
            <!-- Sidebar -->
      <?php include_once("../../partials/author_sidebar.php"); ?>

            <!-- Main Content Area -->
            <main class="flex-1 p-6 overflow-auto">
                <div class="max-w-6xl mx-auto">
                    <!-- Page Header -->
                    <div class="mb-6">
                        <button id="mobileMenuButton" class="md:hidden p-2 bg-primary text-white rounded-lg mb-4">
                            <i class="bi bi-list"></i>
                        </button>
                        <h1 class="text-2xl font-bold text-primary flex items-center">
                            <i class="bi bi-star-fill mr-3"></i>
                            Review Details
                        </h1>
                        <p class="text-gray-600 mt-1">Review ID: <span id="reviewIdContainer" class="font-mono bg-gray-100 px-2 py-1 rounded">Loading...</span></p>
                    </div>

                    <!-- Review Comments Section -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                        <div class="p-6">
                            <!-- One Paragraph Comment -->
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                    <i class="bi bi-chat-text mr-2"></i> One Paragraph Comment
                                </h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p id="one_paragraph_comment" class="text-gray-700">Loading comment...</p>
                                </div>
                                <div class="mt-2" id="one_paragraph_file">
                                    <span class="text-sm text-gray-600">No file attached</span>
                                </div>
                            </div>

                            <!-- General Comment -->
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                    <i class="bi bi-chat-dots mr-2"></i> General Comment
                                </h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p id="general_comment" class="text-gray-700">Loading comment...</p>
                                </div>
                                <div class="mt-2" id="general_comment_file">
                                    <span class="text-sm text-gray-600">No file attached</span>
                                </div>
                            </div>

                            <!-- Specific Comment -->
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                    <i class="bi bi-chat-square-quote mr-2"></i> Specific Comment
                                </h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p id="specific_comment" class="text-gray-700">Loading comment...</p>
                                </div>
                                <div class="mt-2" id="specific_comment_file">
                                    <span class="text-sm text-gray-600">No file attached</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Scoring Sections -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <!-- Specific Section Scores -->
                        <div class="bg-white rounded-xl shadow-md overflow-hidden">
                            <div class="bg-primary text-white p-4">
                                <h3 class="text-lg font-semibold flex items-center">
                                    <i class="bi bi-bar-chart mr-2"></i> Specific Section Scores
                                </h3>
                                <p class="text-sm opacity-90 mt-1">Total: <span id="totalSpecificScore" class="font-bold">0</span>/115</p>
                            </div>
                            <div class="p-4 max-h-96 overflow-y-auto">
                                <div class="space-y-3">
                                    <!-- Scores will be populated by JavaScript -->
                                    <div id="specificScoresContainer"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Overall Rating -->
                        <div class="bg-white rounded-xl shadow-md overflow-hidden">
                            <div class="bg-primary text-white p-4">
                                <h3 class="text-lg font-semibold flex items-center">
                                    <i class="bi bi-star-fill mr-2"></i> Overall Rating
                                </h3>
                                <p class="text-sm opacity-90 mt-1">Total: <span id="totalOverallRating" class="font-bold">0</span>/25</p>
                            </div>
                            <div class="p-4">
                                <div class="space-y-3">
                                    <!-- Scores will be populated by JavaScript -->
                                    <div id="overallScoresContainer"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Overall Recommendation -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                        <div class="bg-primary text-white p-4">
                            <h3 class="text-lg font-semibold flex items-center">
                                <i class="bi bi-award mr-2"></i> Overall Recommendation
                            </h3>
                        </div>
                        <div class="p-4">
                            <div id="overallRecommendationContainer">
                                <div class="text-center text-gray-500 py-8">
                                    <i class="bi bi-hourglass-split text-3xl mb-3"></i>
                                    <p>Loading recommendation...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Menu Button -->
    <div class="md:hidden fixed bottom-4 right-4 z-50">
        <button id="mobileSidebarButton" class="p-3 bg-primary text-white rounded-full shadow-lg">
            <i class="bi bi-list text-xl"></i>
        </button>
    </div>

    <!-- Mobile Sidebar -->
<?php include_once("../../partials/mobile_sidebar.php"); ?>

    <div id="google_translate_element" class="fixed bottom-2 left-2 z-50 bg-white p-2 rounded shadow"></div>
        
    <script src="../../../assets/global/js/jquery-3.6.0.min.js?v=<?= time(); ?>"></script>
    <script src="../../../assets/global/js/bootstrap.bundle.min.js?v=<?= time(); ?>"></script>
    <script src="../../../assets/templates/metro_hyip/js/main.js?v=<?= time(); ?>"></script>
    <script type="module" src="../../../js/dashboards/author.js?v=<?= time(); ?>"></script>
    <script type="module" src="../../../js/dashboards/viewReview.js?v=<?= time(); ?>"></script>

    <script>
        'use strict';
        (function($) {
            // Mobile menu functionality
            $('#mobileSidebarButton').on('click', function() {
                $('#mobileSidebar').removeClass('translate-x-full');
            });
            
            $('#closeMobileMenu').on('click', function() {
                $('#mobileSidebar').addClass('translate-x-full');
            });
            
            // Close mobile menu when clicking outside
            $('#mobileSidebar > div:first-child').on('click', function() {
                $('#mobileSidebar').addClass('translate-x-full');
            });
            
            // Set user initials for avatar
            const userFullname = $('.user_fullnameContainer').text().trim();
            if (userFullname) {
                const names = userFullname.split(' ');
                let initials = '';
                if (names.length > 0) {
                    initials += names[0].charAt(0);
                }
                if (names.length > 1) {
                    initials += names[names.length - 1].charAt(0);
                }
                $('#userInitials').text(initials.toUpperCase());
            }
        })(jQuery);
    </script>

    <link rel="stylesheet" href="../../../assets/global/css/iziToast.min.css">
    <script src="../../../assets/global/js/iziToast.min.js?v=<?= time(); ?>"></script>

    <script src="../../../assets/global/js/firebase/firebase-8.3.2.js?v=<?= time(); ?>"></script>

    <script type="module" src="../../../js/dashboards/countItems.js?v=<?= time(); ?>"></script>
</body>

</html>