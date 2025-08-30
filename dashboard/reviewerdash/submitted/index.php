<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage" class="h-full">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Reviewer - Dashboard</title>
    <meta name="title" Content="Reviewer - Dashboard">

    <meta name="description" content="asfiresearchjournal">
    <meta name="keywords" content="asfiresearchjournal">
    <link rel="shortcut icon" href="../../../assets/images/logoIcon/favicon.png" type="image/x-icon">
 
    
    <link rel="apple-touch-icon" href="../../../assets/images/logoIcon/logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Reviewer - Dashboard">
    
    <meta itemprop="name" content="Reviewer - Dashboard">
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
    
    <!-- Font Awesome -->
    <link href="../../../assets/global/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/global/css/line-awesome.min.css" />
    <link rel="stylesheet" href="../../../assets/templates/metro_hyip/css/custom.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
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
        .notification-badge {
            position: relative;
        }
        .notification-badge::after {
            content: '';
            position: absolute;
            top: -5px;
            right: -5px;
            width: 12px;
            height: 12px;
            background-color: #EB4830;
            border-radius: 50%;
            border: 2px solid white;
            display: none;
        }
        .notification-badge.has-notification::after {
            display: block;
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
        .table-header {
            background-color: #310357;
            color: white;
        }
        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .status-completed {
            background-color: #10B981;
            color: white;
        }
        .status-pending {
            background-color: #F59E0B;
            color: white;
        }
        .status-rejected {
            background-color: #EF4444;
            color: white;
        }
        .status-in-review {
            background-color: #3B82F6;
            color: white;
        }
    </style>
</head>

<body class="h-full bg-gray-50">
    
    <div class="preloader">
        <div class="loader-p"></div>
    </div>

    <div class="min-h-screen flex flex-col">
        <!-- Header -->
     <?php include_once("../../partials/navbar.php"); ?>

        <!-- Main Content -->
        <div class="flex flex-1">
            <!-- Sidebar -->
            <div class="hidden md:flex md:w-64 md:flex-col bg-white border-r border-gray-200">
                <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center justify-center px-4">
                        <h2 class="text-lg font-semibold text-gray-800">Reviewer Dashboard</h2>
                    </div>
                    <div class="mt-8 flex-1 px-4">
                        <nav class="space-y-2">
                            <a href="../" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg">
                                <span class="reviewsCount mr-3 bg-gray-200 text-gray-700 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                                <i class="bi bi-clipboard-check mr-3"></i>
                                Review and Score
                            </a>
                            <a href="" class="flex items-center px-4 py-3 text-white bg-primary rounded-lg">
                                <span class="submittedReviewsCount mr-3 bg-white text-primary rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                                <i class="bi bi-send-check mr-3"></i>
                                Reviews Submitted
                            </a>
                            <a href="../../../portal/logout/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-red-50 rounded-lg">
                                <i class="bi bi-box-arrow-right mr-3"></i>
                                Logout
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Welcome Alert -->
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 mb-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="las la-info-circle text-purple-600 text-xl"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-purple-800">
                                    Welcome, <span class="user_fullnameContainer font-bold"></span>
                                </h3>
                                <div class="mt-1 text-sm text-purple-700">
                                    <p>Here are all the reviews you have submitted.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Page Title -->
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-primary">Reviews Submitted</h1>
                        <p class="text-gray-600 mt-1">View all your completed review submissions</p>
                    </div>

                    <!-- Reviews Table -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="table-header">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ACTION</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">COMPLETED</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID/TITLE</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php
                                    $user = $_COOKIE["user"];
                                    // $url = "http://localhost/asfirj_submission_controls/backend/reviewers/reviewsSubmitted.php?user=$user";
                                              
                                    $url = "https://greek.asfirj.org/backend/reviewers/reviewsSubmitted.php?user=$user";
                                    $content = file_get_contents($url);
                                    if ($content !== false) {
                                        echo $content;
                                    } else {
                                        echo '<tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Error fetching content from URL</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div id="emptyState" class="hidden bg-white rounded-lg shadow-md p-8 text-center mt-6">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-purple-100">
                            <i class="las la-clipboard-list text-purple-600 text-xl"></i>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No reviews submitted yet</h3>
                        <p class="mt-1 text-gray-500">Get started by completing your first review.</p>
                        <div class="mt-6">
                            <a href="../" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                <i class="las la-clipboard-check mr-2"></i>
                                Start Reviewing
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Menu Button -->
    <div class="md:hidden fixed bottom-4 right-4 z-50">
        <button id="mobileMenuButton" class="p-3 bg-primary text-white rounded-full shadow-lg">
            <i class="las la-bars text-xl"></i>
        </button>
    </div>

    <!-- Mobile Sidebar -->
    <div id="mobileSidebar" class="fixed inset-0 z-40 transform translate-x-full transition-transform duration-300 md:hidden">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>
        <div class="relative flex flex-col w-full max-w-xs bg-white h-full">
            <div class="p-4 border-b">
                <div class="text-center">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center justify-center">
                        <i class="bi bi-clipboard-check mr-2 text-primary"></i> Reviewer Dashboard
                    </h2>
                </div>
                <button id="closeMobileMenu" class="absolute top-4 right-4 text-gray-500">
                    <i class="las la-times text-1xl"></i>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto py-4 px-4">
                <nav class="space-y-3">
                    <a href="../" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg">
                        <span class="reviewsCount mr-3 bg-gray-200 text-gray-700 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                        <i class="bi bi-clipboard-check mr-3"></i>
                        Review and Score
                    </a>
                    <a href="" class="flex items-center px-4 py-3 text-white bg-primary rounded-lg">
                        <span class="submittedReviewsCount mr-3 bg-white text-primary rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                        <i class="bi bi-send-check mr-3"></i>
                        Reviews Submitted
                    </a>
                    <a href="../../../portal/logout/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-red-50 rounded-lg">
                        <i class="bi bi-box-arrow-right mr-3"></i>
                        Logout
                    </a>
                </nav>
                
                <!-- Quick Stats for Mobile -->
                <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                    <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                        <i class="bi bi-graph-up mr-2"></i> Quick Stats
                    </h3>
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-600">Pending Reviews</span>
                            <span class="font-medium reviewsCount">0</span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-600">Submitted Reviews</span>
                            <span class="font-medium submittedReviewsCount">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <script src="../../../assets/global/js/jquery-3.6.0.min.js?v=<?= time(); ?>"></script>
    <script src="../../../assets/global/js/bootstrap.bundle.min.js?v=<?= time(); ?>"></script>
    <script src="../../../assets/templates/metro_hyip/js/main.js?v=<?= time(); ?>"></script>
    <script src="../../../js/dashboards/reviewsSubmitted.js?v=<?= time(); ?>" type="module"></script>
        <script type="module" src="../../../js/dashboards/author.js?v=<?= time(); ?>"></script>

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
            
            // Check if table is empty and show empty state
            const tableRows = $('tbody tr').length;
            if (tableRows === 0 || (tableRows === 1 && $('tbody tr td').text().includes('Error'))) {
                $('#emptyState').removeClass('hidden');
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