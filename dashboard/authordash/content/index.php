<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage" class="h-full">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>View Manuscript - Dashboard</title>
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
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
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
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .prose {
            max-width: none;
        }
        .prose h1, .prose h2, .prose h3, .prose h4 {
            color: #310357;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }
        .prose p {
            margin-bottom: 1rem;
            line-height: 1.6;
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
                        <h1 class="text-1xl font-bold text-primary flex items-center">
                            <i class="bi bi-journal-text mr-3"></i>
                            Manuscript Details
                        </h1>
                        <p class="text-gray-600 mt-1">View and manage your manuscript submission</p>
                    </div>

                    <!-- Manuscript Content -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <!-- Manuscript Header -->
                        <div class="bg-gradient-to-r from-primary to-purple-800 p-6 text-white">
                            <h2 class="text-1xl font-bold mb-2" id="manu_title">Loading manuscript title...</h2>
                            <div class="flex flex-wrap gap-4 text-sm">
                                <div class="flex items-center">
                                    <i class="bi bi-calendar-event mr-2"></i>
                                    <span id="published_date">Loading date...</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="bi bi-tag mr-2"></i>
                                    <span id="articleTypeContainer">Loading article type...</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="bi bi-grid-3x3 mr-2"></i>
                                    <span id="disciplineContainer">Loading discipline...</span>
                                </div>
                            </div>
                        </div>

                        <!-- Manuscript Body -->
                        <div class="p-6 space-y-6">
                            <!-- Basic Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h3 class="text-sm font-semibold text-gray-800 mb-3 flex items-center">
                                        <i class="bi bi-info-circle mr-2"></i> Basic Information
                                    </h3>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Previous ID:</span>
                                            <span class="font-medium" id="previous_manuscript_id">Loading...</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Status:</span>
                                            <span class="status-badge bg-blue-100 text-blue-800" id="status">Loading...</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h3 class="text-sm font-semibold text-gray-800 mb-3 flex items-center">
                                        <i class="bi bi-person mr-2"></i> Corresponding Author
                                    </h3>
                                    <div class="text-sm">
                                        <p id="correspondingAuthorsEmail" class="truncate">
                                            <span class="text-gray-600">Email:</span> Loading...
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Abstract Section -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="bi bi-file-text mr-2"></i> Abstract
                                </h3>
                                <div id="content" class="prose bg-white p-4 rounded border"></div>
                            </div>

                            <!-- Authors Section -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="bi bi-people mr-2"></i> Authors
                                </h3>
                                <ul class="grid grid-cols-1 md:grid-cols-2 gap-2" id="authorsListBottom"></ul>
                            </div>

                            <!-- Keywords Section -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="bi bi-tags mr-2"></i> Keywords
                                </h3>
                                <div class="flex flex-wrap gap-2" id="keywordsContainer"></div>
                            </div>

                            <!-- Files Section -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="bi bi-folder mr-2"></i> Files
                                </h3>
                                <div class="space-y-2 text-sm" id="filesContainer">
                                    <p class="text-gray-600">Loading files...</p>
                                </div>
                            </div>

                            <!-- Actions Section -->
                            <div class="bg-gray-50 p-4 rounded-lg" id="action_container">
                                <h3 class="text-sm font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="bi bi-lightning mr-2"></i> Actions
                                </h3>
                                <div class="flex flex-wrap gap-3">
                                    <a href="#" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-purple-800 transition-colors">
                                        <i class="bi bi-pencil mr-2"></i> Edit Submission
                                    </a>
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
     <!-- Header -->
      <?php include_once("../../partials/mobile_sidebar.php"); ?>
    <div id="google_translate_element" class="fixed bottom-2 left-2 z-50 bg-white p-2 rounded shadow"></div>
        
    <script src="../../../assets/global/js/jquery-3.6.0.min.js?v=<?= time(); ?>"></script>
    <script src="../../../assets/global/js/bootstrap.bundle.min.js?v=<?= time(); ?>"></script>
    <script src="../../../assets/templates/metro_hyip/js/main.js?v=<?= time(); ?>"></script>
    <script type="module" src="../../../js/dashboards/author.js?v=<?= time(); ?>"></script>
    <script type="module" src="../../../js/dashboards/getSubmission.js?v=<?= time(); ?>"></script>

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