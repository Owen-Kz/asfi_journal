<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage" class="h-full">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Inbox - Dashboard</title>
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
    
    <!-- QUILL JS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <!-- END QUILL JS -->
    
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
        .email-item {
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }
        .email-item:hover {
            background-color: #f9f5ff;
            border-left-color: #310357;
        }
        .email-item.unread {
            background-color: #f0f9ff;
            border-left-color: #0ea5e9;
        }
        .email-item.selected {
            background-color: #eef2ff;
            border-left-color: #6366f1;
        }
        .email-content {
            transition: all 0.3s ease;
        }
        @media (max-width: 768px) {
            .email-content {
                position: fixed;
                top: 0;
                right: -100%;
                width: 100%;
                height: 100%;
                z-index: 50;
                background: white;
                transition: right 0.3s ease;
            }
            .email-content.open {
                right: 0;
            }
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
            <aside class="w-64 bg-white shadow-lg hidden md:block border-r border-gray-100">
                <div class="p-6">
                    <div class="text-center mb-8">
                        <h2 class="text-1xl font-bold text-gray-800 flex items-center justify-center">
                            <i class="bi bi-inbox mr-2 text-primary"></i> Inbox
                        </h2>
                    </div>
                    
                    <ul class="space-y-2">
                        <li>
                            <a href="../../authordash/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg sidebar-menu-item">
                                <i class="bi bi-journal-text mr-3"></i>
                                Authors Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="../../reviewerdash/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg sidebar-menu-item">
                                <i class="bi bi-clipboard-check mr-3"></i>
                                Reviewers Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="../../../portal/logout/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg sidebar-menu-item">
                                <i class="bi bi-box-arrow-right mr-3"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                    
                    <!-- Inbox Stats -->
                    <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="bi bi-bar-chart mr-2"></i> Inbox Stats
                        </h3>
                        <div class="space-y-2">
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Total Messages</span>
                                <span class="font-medium" id="totalMessages">0</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Unread</span>
                                <span class="font-medium text-blue-600" id="unreadMessages">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content Area -->
            <main class="flex-1 p-6 overflow-auto">
                <div class="max-w-7xl mx-auto h-full flex flex-col">
                    <!-- Page Header -->
                    <div class="mb-6 flex items-center justify-between">
                        <div>
                            <h1 class="text-1xl font-bold text-primary flex items-center">
                                <i class="bi bi-inbox mr-3"></i>
                                Inbox
                            </h1>
                            <p class="text-gray-600 mt-1">Your messages and notifications</p>
                        </div>
                        <button id="mobileMenuButton" class="md:hidden p-2 bg-primary text-white rounded-lg">
                            <i class="bi bi-list"></i>
                        </button>
                    </div>

                    <!-- Email Container -->
                    <div class="bg-white rounded-xl shadow-md flex-1 flex overflow-hidden">
                        <!-- Email List -->
                        <div class="w-full md:w-1/3 border-r border-gray-200 flex flex-col">
                            <div class="p-4 border-b border-gray-200">
                                <div class="relative">
                                    <input type="text" placeholder="Search messages..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                    <i class="bi bi-search absolute left-3 top-3 text-gray-400"></i>
                                </div>
                            </div>
                            <div class="flex-1 overflow-y-auto">
                                <div id="emailListContainer" class="divide-y divide-gray-100">
                                    <!-- Email items will be inserted here by JavaScript -->
                                    <div class="p-4 text-center text-gray-500">
                                        <i class="bi bi-inbox text-3xl mb-2"></i>
                                        <p>Loading messages...</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Email Content -->
                        <div class="hidden md:flex md:w-2/3 email-content" id="emailContent">
                            <div class="flex flex-col w-full">
                                <div class="p-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                                    <button id="backButton" class="md:hidden p-2 rounded-lg hover:bg-gray-200">
                                        <i class="bi bi-arrow-left"></i>
                                    </button>
                                    <h3 class="text-lg font-semibold text-gray-800">Select a message to view</h3>
                                </div>
                                <div class="flex-1 overflow-y-auto p-4 flex items-center justify-center">
                                    <div class="text-center text-gray-500">
                                        <i class="bi bi-envelope-open text-4xl mb-3"></i>
                                        <p class="text-lg">Select a message to read</p>
                                        <p class="text-sm mt-1">Click on any message in the list to view its contents</p>
                                    </div>
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
    <div id="mobileSidebar" class="fixed inset-0 z-40 transform translate-x-full transition-transform duration-300 md:hidden">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>
        <div class="relative flex flex-col w-full max-w-xs bg-white h-full">
            <div class="p-4 border-b">
                <div class="text-center">
                    <h2 class="text-1xl font-bold text-gray-800">Inbox Menu</h2>
                </div>
                <button id="closeMobileMenu" class="absolute top-4 right-4 text-gray-500">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto py-4 px-4">
                <ul class="space-y-2">
                    <li>
                        <a href="../../authordash/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg">
                            <i class="bi bi-journal-text mr-3"></i>
                            Authors Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="../../reviewerdash/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg">
                            <i class="bi bi-clipboard-check mr-3"></i>
                            Reviewers Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="../../../portal/logout/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg">
                            <i class="bi bi-box-arrow-right mr-3"></i>
                            Logout
                        </a>
                    </li>
                </ul>
                
                <!-- Inbox Stats for Mobile -->
                <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                    <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                        <i class="bi bi-bar-chart mr-2"></i> Inbox Stats
                    </h3>
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-600">Total Messages</span>
                            <span class="font-medium" id="mobileTotalMessages">0</span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-600">Unread</span>
                            <span class="font-medium text-blue-600" id="mobileUnreadMessages">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="google_translate_element" class="fixed bottom-2 left-2 z-50 bg-white p-2 rounded shadow"></div>
        
    <script src="../../../assets/global/js/jquery-3.6.0.min.js?v=<?= time(); ?>"></script>
    <script src="../../../assets/global/js/bootstrap.bundle.min.js?v=<?= time(); ?>"></script>
    <script src="../../../assets/templates/metro_hyip/js/main.js?v=<?= time(); ?>"></script>
    <script type="module" src="../../../js/dashboards/author.js?v=<?= time(); ?>"></script>
    <script type="module" src="../../../js/dashboards/getMails.js?v=<?= time(); ?>"></script>

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
            
            // Back button functionality for mobile email view
            $('#backButton').on('click', function() {
                $('#emailContent').removeClass('open');
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