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
    <title>Reviewer - Dashboard</title>
    <meta name="title" Content="Reviewer - Dashboard">

    <meta name="description" content="asfiresearchjournal">
    <meta name="keywords" content="asfiresearchjournal">
    <link rel="shortcut icon" href="../../assets/images/logoIcon/favicon.png" type="image/x-icon">
 
    <link rel="apple-touch-icon" href="../../assets/images/logoIcon/logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Reviewer - Dashboard">
    
    <meta itemprop="name" content="Reviewer - Dashboard">
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
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .due-date-warning {
            background-color: #fef3c7;
            color: #92400e;
        }
        .due-date-urgent {
            background-color: #fee2e2;
            color: #b91c1c;
        }
        /* Enhanced dropdown styles */
.reviewAction {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
}

/* Remove default arrow in IE */
.reviewAction::-ms-expand {
    display: none;
}

/* Focus styles */
.reviewAction:focus {
    outline: 2px solid transparent;
    outline-offset: 2px;
    box-shadow: 0 0 0 3px rgba(49, 3, 135, 0.1);
}

/* Hover effects for table rows */
tr.hover\\:bg-gray-50:hover {
    background-color: #f9fafb;
}
        /* Date highlighting styles */
.bg-red-100 {
    background-color: #fee2e2;
}
.text-red-800 {
    color: #991b1b;
}
.bg-orange-100 {
    background-color: #ffedd5;
}
.text-orange-800 {
    color: #9a3412;
}
.bg-yellow-100 {
    background-color: #fef3c7;
}
.text-yellow-800 {
    color: #92400e;
}
.font-semibold {
    font-weight: 600;
}

/* Hover effects */
.hover\:bg-gray-50:hover {
    background-color: #f9fafb;
}
.transition {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
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
       <!-- Header -->
     <?php include_once("../partials/navbar.php"); ?>

        <!-- Main Content -->
        <div class="flex flex-1">
            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-lg hidden md:block border-r border-gray-100">
                <div class="p-6">
                    <div class="text-center mb-8">
                        <h2 class="text-1xl font-bold text-gray-800">Reviewer Dashboard</h2>
                    </div>
                    
                    <ul class="space-y-2">
                        <li>
                            <a href="" class="flex items-center px-4 py-3 text-white bg-gradient-to-r from-accent to-purple-800 rounded-lg sidebar-menu-item active-menu-item shadow-sm">
                                <span class="reviewsCount mr-3 bg-white text-accent rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                                <i class="bi bi-clipboard-check mr-3"></i>
                                Review and Score
                            </a>
                        </li>
                        <li>
                            <a href="/dashboard/reviewerdash/submitted/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg sidebar-menu-item">
                                <span class="submittedReviewsCount mr-3 bg-gray-200 text-gray-700 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                                <i class="bi bi-send-check mr-3"></i>
                                Reviews Submitted
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
                            <i class="bi bi-graph-up mr-2"></i> Review Stats
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
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Due Soon</span>
                                <span class="font-medium text-orange-600" id="dueSoonCount">0</span>
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
                        <h1 class="text-1xl font-bold text-primary flex items-center">
                            <i class="bi bi-clipboard-check mr-3"></i>
                            Review and Score
                        </h1>
                        <p class="text-gray-600 mt-1">Manuscripts awaiting your review and scoring</p>
                    </div>

                    <!-- Reviews Table -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-primary">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Action</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Due Date</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Type</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">ID/Title</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="reviewsTableBody">
                                    <!-- Reviews will be populated by PHP -->
                                    <?php
                                    $user = $_COOKIE["user"] ?? '';
                                    if ($user) {
                                        $url = "https://greek.asfirj.org/backend/reviewers/toReview.php?user=$user";
                                        // $url = "http://localhost/asfirj_submission_controls/backend/reviewers/toReview.php?user=$user";

                                        $content = @file_get_contents($url);
                                        if ($content !== false) {
                                            echo $content;
                                        } else {
                                            echo '
                                            <tr>
                                                <td colspan="5" class="px-6 py-8 text-center">
                                                    <div class="flex flex-col items-center justify-center text-red-500">
                                                        <i class="bi bi-exclamation-triangle text-4xl mb-3"></i>
                                                        <p class="text-lg">Error loading reviews</p>
                                                        <p class="text-sm mt-1">Please try again later</p>
                                                    </div>
                                                </td>
                                            </tr>';
                                        }
                                    } else {
                                        echo '
                                        <tr>
                                            <td colspan="5" class="px-6 py-8 text-center">
                                                <div class="flex flex-col items-center justify-center text-red-500">
                                                    <i class="bi bi-person-x text-4xl mb-3"></i>
                                                    <p class="text-lg">Please log in</p>
                                                    <p class="text-sm mt-1">You need to be logged in to view reviews</p>
                                                </div>
                                            </td>
                                        </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div id="emptyState" class="hidden bg-white rounded-xl shadow-md p-8 text-center mt-6">
                        <i class="bi bi-clipboard-check text-4xl text-gray-300 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-700">No reviews pending</h3>
                        <p class="text-gray-500 mt-2">All caught up! New review invitations will appear here.</p>
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
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden=" true"></div>
        <div class="relative flex flex-col w-full max-w-xs bg-white h-full">
            <div class="p-4 border-b">
                <div class="text-center">
                    <h2 class="text-1xl font-bold text-gray-800">Reviewer Dashboard</h2>
                </div>
                <button id="closeMobileMenu" class="absolute top-4 right-4 text-gray-500">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto py-4 px-4">
                <ul class="space-y-2">
                    <li>
                        <a href="" class="flex items-center px-4 py-3 text-white bg-gradient-to-r from-accent to-purple-800 rounded-lg">
                            <span class="reviewsCount mr-3 bg-white text-accent rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                            <i class="bi bi-clipboard-check mr-3"></i>
                            Review and Score
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/reviewerdash/submitted/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg">
                            <span class="submittedReviewsCount mr-3 bg-gray-200 text-gray-700 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                            <i class="bi bi-send-check mr-3"></i>
                            Reviews Submitted
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
                        <i class="bi bi-graph-up mr-2"></i> Review Stats
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
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-600">Due Soon</span>
                            <span class="font-medium text-orange-600" id="mobileDueSoonCount">0</span>
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
    <script type="module" src="../../js/dashboards/author.js?v=<?= time(); ?>"></script>
    <script type="module" src="../../js/dashboards/toReview.js?v=<?= time(); ?>"></script>

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
            
            // Enhance the PHP-generated table with Tailwind classes
            setTimeout(function() {
                $('#reviewsTableBody tr').each(function() {
                    const $row = $(this);
                    
                    // Add hover effect
                    $row.addClass('table-row-hover');
                    
                    // Style action dropdowns
                    $row.find('select.action').addClass('w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent');
                    
                    // Style due dates with color coding
                    const dueDateText = $row.find('td:nth-child(2)').text().trim();
                    if (dueDateText) {
                        const dueDate = new Date(dueDateText);
                        const today = new Date();
                        const diffTime = dueDate - today;
                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                        
                        if (diffDays < 3) {
                            $row.find('td:nth-child(2)').addClass('due-date-urgent font-semibold');
                        } else if (diffDays < 7) {
                            $row.find('td:nth-child(2)').addClass('due-date-warning font-semibold');
                        }
                    }
                    
                    // Style status badges
                    const statusText = $row.find('td:last-child').text().trim();
                    if (statusText === 'PENDING') {
                        $row.find('td:last-child').html('<span class="status-badge bg-yellow-100 text-yellow-800">PENDING</span>');
                    } else if (statusText === 'COMPLETED') {
                        $row.find('td:last-child').html('<span class="status-badge bg-green-100 text-green-800">COMPLETED</span>');
                    }
                });
                
                // Count due soon items
                const dueSoonCount = $('.due-date-urgent').length;
                $('#dueSoonCount').text(dueSoonCount);
                $('#mobileDueSoonCount').text(dueSoonCount);
                
                // Show empty state if no reviews
                if ($('#reviewsTableBody tr').length === 0) {
                    $('#emptyState').removeClass('hidden');
                }
            }, 100);
            
        })(jQuery);
    </script>

    <link rel="stylesheet" href="../../assets/global/css/iziToast.min.css">
    <script src="../../assets/global/js/iziToast.min.js?v=<?= time(); ?>"></script>

    <script src="../../assets/global/js/firebase/firebase-8.3.2.js?v=<?= time(); ?>"></script>

    <script>
        (function($) {
            "use strict";
            
            // Handle action dropdown changes
            $(document).on('change', 'select.action', function() {
                if ($(this).val() === 'review') {
                    $(this).closest('form').submit();
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

    <script type="module" src="../../js/dashboards/countItems.js?v=<?= time(); ?>"></script>
</body>

</html>