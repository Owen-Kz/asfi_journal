<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage" class="h-full">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Author - Dashboard</title>
    <meta name="title" Content="Author - Dashboard">

    <meta name="description" content="asfiresearchjournal">
    <meta name="keywords" content="asfiresearchjournal">
    <link rel="shortcut icon" href="../../assets/images/logoIcon/favicon.png" type="image/x-icon">

    <link rel="apple-touch-icon" href="../../assets/images/logoIcon/logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Author - Dashboard">
    
    <meta itemprop="name" content="Author - Dashboard">
    <meta itemprop="description" content="asfiresearchjournal">
    <meta itemprop="image" content="../assets/images/seo/65be1258275121706955352.png">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="ASFIRJ">
    <meta property="og:description" content="asfiresearchjournal">
    <meta property="og:image" content="../assets/images/seo/65be1258275121706955352.png"/>
    <meta property="og:image:type" content="png"/>
    <meta property="og:image:width" content="1180" />
    <meta property="og:image:height" content="600" />
    <meta property="og:url" content="/user/dashboard.html">
    
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
        .dashboard-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, #310357, #6B21A8);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .dashboard-card:hover::before {
            opacity: 1;
        }
        .help-box {
            transition: all 0.3s ease;
        }
        .help-box:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
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

    <!-- <a class="scroll-top"><i class="fas fa-angle-double-up"></i></a> -->

    <div class="min-h-screen flex flex-col">
        <!-- Header -->
   <?php include_once("../partials/navbar.php"); ?>

        <!-- Main Content -->
        <div class="flex flex-1">
            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-lg hidden md:block border-r border-gray-100">
                <div class="p-6">
                    <!-- Help Box -->
                    <div class="help-box bg-white border border-gray-200 rounded-xl p-5 mb-8">
                        <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center">
                            <i class="bi bi-question-circle mr-2 text-primary"></i> Help
                        </h3>
                        <ul class="space-y-3">
                            <li>
                                <a href="https://asfirj.org/authors.html" target="_blank" class="flex items-center text-purple-700 hover:text-purple-900 transition-colors">
                                    <i class="bi bi-journal-text mr-2"></i>
                                    Author Instructions
                                    <i class="bi bi-box-arrow-up-right ml-2 text-xs"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://asfirj.org" target="_blank" class="flex items-center text-purple-700 hover:text-purple-900 transition-colors">
                                    <i class="bi bi-globe mr-2"></i>
                                    Journal Website
                                    <i class="bi bi-box-arrow-up-right ml-2 text-xs"></i>
                                </a>
                            </li>
                            <li class="pt-3 mt-3 border-t border-gray-100">
                                <a href="../../portal/logout/" class="flex items-center text-red-600 hover:text-red-800 transition-colors">
                                    <i class="bi bi-box-arrow-right mr-2"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="bg-gray-50 rounded-xl p-5">
                        <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center">
                            <i class="bi bi-graph-up mr-2"></i> Quick Stats
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Submitted</span>
                                <span class="font-medium text-primary newSubmissionsCount">0</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">In Review</span>
                                <span class="font-medium text-primary inReviewCount">0</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Co-Authored</span>
                                <span class="font-medium text-primary coAuhtoredCount">0</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Inbox</span>
                                <span class="font-medium text-primary inboxCount">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content Area -->
            <main class="flex-1 p-6 overflow-auto">
                <div class="max-w-7xl mx-auto">
                    <!-- Editorial Office Notice -->
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 mb-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="bi bi-info-circle text-blue-500 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-blue-800 flex items-center">
                                    Editorial Office <i class="bi bi-pencil-square ml-2 text-blue-600"></i>
                                </h3>
                                <p class="mt-1 text-blue-700">
                                    For assistance, please contact <a href="mailto:submissions@asfirj.org" class="text-blue-600 hover:text-blue-800 font-medium">submissions@asfirj.org</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Welcome Alert -->
                    <div class="bg-purple-50 border border-purple-200 rounded-xl p-5 mb-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="bi bi-info-circle text-purple-500 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-purple-800">
                                    AUTHORS
                                </h3>
                                <p class="mt-1 text-purple-700">
                                    Click on Author in the navigation bar above to access your Authors Dashboard.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Dashboard Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- New Submission Card -->
                        <a href="../authordash/manuscripts/">
                            <div class="dashboard-card bg-white rounded-xl shadow-md p-6 border border-gray-100">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-purple-100 p-3 rounded-lg">
                                        <i class="bi bi-pencil-square text-purple-600 text-2xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h6 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">NEW SUBMISSION</h6>
                                        <span class="text-2xl font-bold text-primary newSubmissionsCount">0</span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Manuscripts with Decisions Card -->
                        <a href="../authordash/inreview/">
                            <div class="dashboard-card bg-white rounded-xl shadow-md p-6 border border-gray-100">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-blue-100 p-3 rounded-lg">
                                        <i class="bi bi-journal-text text-blue-600 text-2xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h6 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">MANUSCRIPTS WITH DECISIONS</h6>
                                        <span class="text-2xl font-bold text-primary inReviewCount">0</span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Manuscripts Co-Authored Card -->
                        <a href="../authordash/coauth/">
                            <div class="dashboard-card bg-white rounded-xl shadow-md p-6 border border-gray-100">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-green-100 p-3 rounded-lg">
                                        <i class="bi bi-people-fill text-green-600 text-2xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h6 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">MANUSCRIPTS CO-AUTHORED</h6>
                                        <span class="text-2xl font-bold text-primary coAuhtoredCount">0</span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Returned Manuscripts Card -->
                        <a href="../authordash/inreview/">
                            <div class="dashboard-card bg-white rounded-xl shadow-md p-6 border border-gray-100">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-yellow-100 p-3 rounded-lg">
                                        <i class="bi bi-arrow-return-left text-yellow-600 text-2xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h6 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">RETURNED MANUSCRIPTS</h6>
                                        <span class="text-2xl font-bold text-primary">0</span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Inbox Card -->
                        <a href="../mail/inbox/">
                            <div class="dashboard-card bg-white rounded-xl shadow-md p-6 border border-gray-100">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-red-100 p-3 rounded-lg">
                                        <i class="bi bi-inbox text-red-600 text-2xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h6 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">INBOX</h6>
                                        <span class="text-2xl font-bold text-primary inboxCount">0</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Menu Button -->
    <div class="md:hidden fixed bottom-4 right-4 z-50">
        <button id="mobileMenuButton" class="p-3 bg-primary text-white rounded-full shadow-lg">
            <i class="bi bi-list text-xl"></i>
        </button>
    </div>

    <!-- Mobile Sidebar -->
    <div id="mobileSidebar" class="fixed inset-0 z-40 transform translate-x-full transition-transform duration-300 md:hidden">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>
        <div class="relative flex flex-col w-full max-w-xs bg-white h-full">
            <div class="p-4 border-b">
                <div class="text-center">
                    <h2 class="text-xl font-bold text-gray-800">ASFIRJ Portal</h2>
                </div>
                <button id="closeMobileMenu" class="absolute top-4 right-4 text-gray-500">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto py-4 px-4">
                <!-- Help Box for Mobile -->
                <div class="help-box bg-white border border-gray-200 rounded-xl p-5 mb-6">
                    <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center">
                        <i class="bi bi-question-circle mr-2 text-primary"></i> Help
                    </h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="https://asfirj.org/authors.html" target="_blank" class="flex items-center text-purple-700 hover:text-purple-900 transition-colors">
                                <i class="bi bi-journal-text mr-2"></i>
                                Author Instructions
                                <i class="bi bi-box-arrow-up-right ml-2 text-xs"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://asfirj.org" target="_blank" class="flex items-center text-purple-700 hover:text-purple-900 transition-colors">
                                <i class="bi bi-globe mr-2"></i>
                                Journal Website
                                <i class="bi bi-box-arrow-up-right ml-2 text-xs"></i>
                            </a>
                        </li>
                        <li class="pt-3 mt-3 border-t border-gray-100">
                            <a href="../../portal/logout/" class="flex items-center text-red-600 hover:text-red-800 transition-colors">
                                <i class="bi bi-box-arrow-right mr-2"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Quick Stats for Mobile -->
                <div class="bg-gray-50 rounded-xl p-5">
                    <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center">
                        <i class="bi bi-graph-up mr-2"></i> Quick Stats
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-sm">Submitted</span>
                            <span class="font-medium text-primary newSubmissionsCount">0</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-sm">In Review</span>
                            <span class="font-medium text-primary inReviewCount">0</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-sm">Co-Authored</span>
                            <span class="font-medium text-primary coAuhtoredCount">0</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-sm">Inbox</span>
                            <span class="font-medium text-primary inboxCount">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="google_translate_element" class="fixed bottom-2 left-2 z-50 bg-white p-2 rounded shadow"></div>
        
    <script src="../../assets/global/js/jquery-3.6.0.min.js?v=<?= time(); ?>"></script>
    <script src="../../assets/global/js/bootstrap.bundle.min.js?v=<?= time(); ?>"></script>
    <script src="../../assets/templates/metro_hyip/js/main.js?v=<?= time(); ?>"></script>

    <script>
        'use strict';
        (function($) {
            // Mobile menu functionality
            $('#mobileMenuButton').on('click', function() {
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

    
    <link rel="stylesheet" href="../../assets/global/css/iziToast.min.css">
    <script src="../../assets/global/js/iziToast.min.js?v=<?= time(); ?>"></script>
    <script type="module" src="../../js/dashboards/author.js?v=<?= time(); ?>"></script>
    <script type="module" src="../../js/dashboards/countItems.js?v=<?= time(); ?>"></script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/65f102799131ed19d9794931/1hoqn3g6l';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

</body>

</html>