<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage" class="h-full">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Manuscript Reviews - Dashboard</title>
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
        .table-row-hover:hover {
            background-color: #f9f5ff;
        }
        .rating-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .review-score {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.875rem;
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
                        <h2 class="text-xl font-bold text-gray-800">Author Dashboard</h2>
                    </div>
                    
                    <ul class="space-y-2">
                        <li>
                            <a href="" class="flex items-center px-4 py-3 text-white bg-gradient-to-r from-accent to-purple-800 rounded-lg sidebar-menu-item active-menu-item shadow-sm">
                                <span class="newSubmissionsCount mr-3 bg-white text-accent rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                                <i class="bi bi-send-check mr-3"></i>
                                Submitted Manuscripts
                            </a>
                        </li>
                        <li>
                            <a href="../coauth/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg sidebar-menu-item">
                                <span class="coAuhtoredCount mr-3 bg-gray-200 text-gray-700 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                                <i class="bi bi-people-fill mr-3"></i>
                                Co-Authored Manuscripts
                            </a>
                        </li>
                        <li>
                            <a href="../submit/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg sidebar-menu-item">
                                <span class="w-6 h-6 flex items-center justify-center mr-3">
                                    <i class="bi bi-plus-circle-fill text-green-500"></i>
                                </span>
                                <i class="bi bi-file-earmark-plus mr-3"></i>
                                Submit New Manuscript
                            </a>
                        </li>
                        <li>
                            <a href="../inreview/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg sidebar-menu-item">
                                <span class="inReviewCount mr-3 bg-gray-200 text-gray-700 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                                <i class="bi bi-clipboard-check mr-3"></i>
                                Manuscripts With Decisions
                            </a>
                        </li>
                        <li>
                            <a href="../../../portal/logout/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg sidebar-menu-item">
                                <i class="bi bi-box-arrow-right mr-3"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                    
                    <!-- Quick Stats -->
                    <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="bi bi-graph-up mr-2"></i> Quick Stats
                        </h3>
                        <div class="space-y-2">
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Submitted</span>
                                <span class="font-medium newSubmissionsCount">0</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">With Decisions</span>
                                <span class="font-medium inReviewCount">0</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Co-Authored</span>
                                <span class="font-medium coAuhtoredCount">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content Area -->
            <main class="flex-1 p-6 overflow-auto">
                <div class="max-w-7xl mx-auto">
                    <!-- Page Header -->
                    <div class="mb-6">
                        <button id="mobileMenuButton" class="md:hidden p-2 bg-primary text-white rounded-lg mb-4">
                            <i class="bi bi-list"></i>
                        </button>
                        <h1 class="text-2xl font-bold text-primary flex items-center">
                            <i class="bi bi-star-fill mr-3"></i>
                            Manuscript Reviews
                        </h1>
                        <p class="text-gray-600 mt-1">Review feedback for <span id="article_id_container" class="font-medium">manuscript</span></p>
                    </div>

                    <!-- Reviews Table -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-primary">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Review ID</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Reviewed By</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Specific Section Score</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Overall Rating</th>
                                    </tr>
                                </thead>
                                <tbody id="reviewsContainer" class="bg-white divide-y divide-gray-200">
                                    <!-- Reviews will be inserted here by JavaScript -->
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center">
                                            <div class="flex flex-col items-center justify-center text-gray-500">
                                                <i class="bi bi-star text-4xl mb-3"></i>
                                                <p class="text-lg">Loading reviews...</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div id="emptyState" class="hidden bg-white rounded-xl shadow-md p-8 text-center mt-6">
                        <i class="bi bi-star text-4xl text-gray-300 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-700">No reviews yet</h3>
                        <p class="text-gray-500 mt-2">Reviews for this manuscript will appear here once they are submitted.</p>
                    </div>

                    <!-- Review Summary -->
                    <div id="reviewSummary" class="hidden bg-gray-50 rounded-xl p-6 mt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="bi bi-bar-chart mr-2"></i> Review Summary
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700">Average Rating</span>
                                    <span class="text-2xl font-bold text-primary" id="averageRating">0.0</span>
                                </div>
                            </div>
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700">Total Reviews</span>
                                    <span class="text-2xl font-bold text-primary" id="totalReviews">0</span>
                                </div>
                            </div>
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700">Completion</span>
                                    <span class="text-2xl font-bold text-primary" id="completionRate">0%</span>
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
                    <h2 class="text-xl font-bold text-gray-800">Author Dashboard</h2>
                </div>
                <button id="closeMobileMenu" class="absolute top-4 right-4 text-gray-500">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto py-4 px-4">
                <ul class="space-y-2">
                    <li>
                        <a href="" class="flex items-center px-4 py-3 text-white bg-gradient-to-r from-accent to-purple-800 rounded-lg">
                            <span class="newSubmissionsCount mr-3 bg-white text-accent rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                            <i class="bi bi-send-check mr-3"></i>
                            Submitted Manuscripts
                        </a>
                    </li>
                    <li>
                        <a href="../coauth/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg">
                            <span class="coAuhtoredCount mr-3 bg-gray-200 text-gray-700 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                            <i class="bi bi-people-fill mr-3"></i>
                            Co-Authored Manuscripts
                        </a>
                    </li>
                    <li>
                        <a href="../submit/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg">
                            <span class="w-6 h-6 flex items-center justify-center mr-3">
                                <i class="bi bi-plus-circle-fill text-green-500"></i>
                            </span>
                            <i class="bi bi-file-earmark-plus mr-3"></i>
                            Submit New Manuscript
                        </a>
                    </li>
                    <li>
                        <a href="../inreview/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg">
                            <span class="inReviewCount mr-3 bg-gray-200 text-gray-700 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                            <i class="bi bi-clipboard-check mr-3"></i>
                            Manuscripts With Decisions
                        </a>
                    </li>
                    <li>
                        <a href="../../../portal/logout/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg">
                            <i class="bi bi-box-arrow-right mr-3"></i>
                            Logout
                        </a>
                    </li>
                </ul>
                
                <!-- Quick Stats for Mobile -->
                <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                    <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                        <i class="bi bi-graph-up mr-2"></i> Quick Stats
                    </h3>
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-600">Submitted</span>
                            <span class="font-medium newSubmissionsCount">0</span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-600">With Decisions</span>
                            <span class="font-medium inReviewCount">0</span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-600">Co-Authored</span>
                            <span class="font-medium coAuhtoredCount">0</span>
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
    <script type="module" src="../../../js/dashboards/manuscriptReviews.js?v=<?= time(); ?>"></script>

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

    <script>
        (function($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "../change/" + $(this).val();
            });

            $('.policy').on('click', function() {
                $.get('../cookie/accept', function(response) {
                    $('.cookies-card').addClass('d-none');
                });
            });

            setTimeout(function() {
                $('.cookies-card').removeClass('hide')
            }, 2000);

            var inputElements = $('[type=text],[type=password],[type=email],[type=number],select,textarea');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });

            $.each($('input, select, textarea'), function(i, element) {
                var elementType = $(element);
                if (elementType.attr('type') != 'checkbox') {
                    if (element.hasAttribute('required')) {
                        $(element).closest('.form-group').find('label').addClass('required');
                    }
                }
            });

            Array.from(document.querySelectorAll('table')).forEach(table => {
                let heading = table.querySelectorAll('thead tr th');
                Array.from(table.querySelectorAll('tbody tr')).forEach((row) => {
                    Array.from(row.querySelectorAll('td')).forEach((colum, i) => {
                        colum.setAttribute('data-label', heading[i].innerText)
                    });
                });
            });

        })(jQuery);
    </script>
    <script type="module" src="../../../js/dashboards/countItems.js?v=<?= time(); ?>"></script>
    
</body>

</html>