<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage" class="h-full">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Reviewer - Dashboard</title>
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
        .score-cell {
            min-width: 80px;
            text-align: center;
            font-weight: bold;
        }
        .table-header {
            background-color: #310357;
            color: white;
        }
        .section-title {
            background-color: #f3f4f6;
            font-weight: bold;
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
                            <a href="" class="flex items-center px-4 py-3 text-white bg-primary rounded-lg">
                                <span class="reviewsCount mr-3 bg-white text-primary rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                                <i class="bi bi-clipboard-check mr-3"></i>
                                Review and Score
                            </a>
                            <a href="./submitted/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg">
                                <span class="submittedReviewsCount mr-3 bg-gray-200 text-gray-700 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
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
                                    <p>You are viewing a review submission.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Manuscript Details -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        
                        <h4 class="text-xl font-semibold text-gray-800 mb-2" id="manu_title"></h4>
                        <div class="text-sm text-gray-600 mb-4">
                            <p><span class="font-medium">Review ID:</span> <span id="reviewIdContainer"></span></p>
                        </div>
                        
                        <!-- Comments Sections -->
                        <div class="space-y-6">
                            <!-- One Paragraph Comment -->
                            <div>
                                <h4 class="text-lg font-medium text-primary mb-2">One Paragraph Comment</h4>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p id="one_paragraph_comment" class="text-gray-700"></p>
                                    <p id="one_paragraph_file" class="text-sm text-gray-500 mt-2"><span class="font-medium">File:</span> </p>
                                </div>
                            </div>
                            
                            <!-- General Comment -->
                            <div>
                                <h4 class="text-lg font-medium text-primary mb-2">General Comment</h4>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p id="general_comment" class="text-gray-700"></p>
                                    <p id="general_comment_file" class="text-sm text-gray-500 mt-2"><span class="font-medium">File:</span> </p>
                                </div>
                            </div>
                            
                            <!-- Specific Comment -->
                            <div>
                                <h4 class="text-lg font-medium text-primary mb-2">Specific Comment</h4>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p id="specific_comment" class="text-gray-700"></p>
                                    <p id="specific_comment_file" class="text-sm text-gray-500 mt-2"><span class="font-medium">File:</span> </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Specific Section Scores -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h3 class="text-xl font-semibold text-primary mb-4">SPECIFIC SECTION SCORES</h3>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr class="table-header">
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">QUESTIONS</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">SCORES<br>1=Poor, 5=Excellent</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr class="section-title">
                                        <td colspan="2" class="px-6 py-3 font-bold">QUESTIONS REGARDING TITLE AND ABSTRACT</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Does the title accurately reflect the subject of the manuscript?</td>
                                        <td class="px-6 py-4 score-cell" id="accurate_reflect">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Does the abstract clearly summarize the content of the manuscript?</td>
                                        <td class="px-6 py-4 score-cell" id="clearly_summarize">6/6</td>
                                    </tr>
                                    
                                    <tr class="section-title">
                                        <td colspan="2" class="px-6 py-3 font-bold">QUESTIONS REGARDING INTRODUCTION</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Does the manuscript present what is already known and unknown (gaps) on the topic in the introduction section?</td>
                                        <td class="px-6 py-4 score-cell" id="already_known">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Does the manuscript give an accurate summary of key recent research on the topic in the introduction section?</td>
                                        <td class="px-6 py-4 score-cell" id="accurate_summary">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Is the purpose (aim or objective) of the paper, its originality and novelty clear as indicated in the introduction section?</td>
                                        <td class="px-6 py-4 score-cell" id="originality">6/6</td>
                                    </tr>
                                    
                                    <tr class="section-title">
                                        <td colspan="2" class="px-6 py-3 font-bold">QUESTIONS REGARDING STUDY METHODS AND ETHICS</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Is the methods section of the manuscript clear and what was done clearly and accurately described?</td>
                                        <td class="px-6 py-4 score-cell" id="clear_description">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Are the study materials, methods, instruments used, and measurements made clearly described?</td>
                                        <td class="px-6 py-4 score-cell" id="study_materials">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Are the research methods valid, reliable, reproducible, and meet requirements for best practice?</td>
                                        <td class="px-6 py-4 score-cell" id="research_method">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Are ethical standards followed in implementing the research and in writing the manuscript?</td>
                                        <td class="px-6 py-4 score-cell" id="ethical_standards">6/6</td>
                                    </tr>
                                    
                                    <tr class="section-title">
                                        <td colspan="2" class="px-6 py-3 font-bold">QUESTIONS REGARDING RESULTS, GRAPHICS, AND TABLES</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">What did the study find and has this been clearly described?</td>
                                        <td class="px-6 py-4 score-cell" id="study_find">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Are the results of the manuscript presented in a logical and coherent manner?</td>
                                        <td class="px-6 py-4 score-cell" id="manuscript_logical">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Do the graphics used (tables and figures) clearly complement the results?</td>
                                        <td class="px-6 py-4 score-cell" id="tables_clear">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Have the tables, graphics, figures, images followed highest specified standards?</td>
                                        <td class="px-6 py-4 score-cell" id="tables_standards">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Do the tables, graphics, figures, images add value or distract from the content of the manuscript?</td>
                                        <td class="px-6 py-4 score-cell" id="tables_distract">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Are there issues with titles, labels, statistical notation or image quality of tables, graphics, figures, images included in the manuscript?</td>
                                        <td class="px-6 py-4 score-cell" id="tables_issues">6/6</td>
                                    </tr>
                                    
                                    <tr class="section-title">
                                        <td colspan="2" class="px-6 py-3 font-bold">QUESTIONS REGARDING DISCUSSION</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Does the manuscript present the summary of the key findings?</td>
                                        <td class="px-6 py-4 score-cell" id="summary_keyfinds">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Does the manuscript highlight the strengths and limitations of the study?</td>
                                        <td class="px-6 py-4 score-cell" id="manuscript_strength">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Does the manuscript compare its findings to similar papers on the topic?</td>
                                        <td class="px-6 py-4 score-cell" id="compare_findings">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Does the manuscript discuss the meaning and implications of the findings?</td>
                                        <td class="px-6 py-4 score-cell" id="discuss_meaning">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Does the manuscript describe and discuss the overall story formed so far on the topic?</td>
                                        <td class="px-6 py-4 score-cell" id="describe_story">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Do the conclusions reflect the achievement of the study aims?</td>
                                        <td class="px-6 py-4 score-cell" id="reflect_achievement">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Does the manuscript discuss the gaps or inconsistencies on the topic and ways forward described?</td>
                                        <td class="px-6 py-4 score-cell" id="inconsistency">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal">Is the referencing accurate, adequate and balance in relation to the topic of the manuscript?</td>
                                        <td class="px-6 py-4 score-cell" id="referencing">6/6</td>
                                    </tr>
                                    
                                    <tr class="section-title">
                                        <td class="px-6 py-4 font-bold">TOTAL SCORE</td>
                                        <td class="px-6 py-4 font-bold score-cell" id="totalSpecificScore">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Overall Rating -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h3 class="text-xl font-semibold text-primary mb-2">OVERALL RATING OF THE MANUSCRIPT</h3>
                        <p class="text-gray-600 mb-4">Please score this section as objective as possible</p>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr class="table-header">
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">QUESTIONS</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">SCORES<br>1=Poor, 5=Excellent</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal"><span class="font-medium">NOVELTY:</span> Does the manuscript address an original and well-defined question? Do the findings of the manuscript advance current knowledge on the topic area?</td>
                                        <td class="px-6 py-4 score-cell" id="novelty">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal"><span class="font-medium">QUALITY:</span> Does the manuscript adhere to highest standard of writing and presentation of its findings? Are the manuscript sections appropriately written?</td>
                                        <td class="px-6 py-4 score-cell" id="quality">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal"><span class="font-medium">SCIENTIFIC ACCURACY:</span> Was the study design correct and sound? Do the methods employed follow expected standards in the study context? Are the data analyses choices and implementation of the highest technical standards within the scope of the topic area? Are the data and emanated results sufficiently robust to draw conclusions?</td>
                                        <td class="px-6 py-4 score-cell" id="scientific_accuracy">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal"><span class="font-medium">OVERALL MERIT:</span> Does the manuscript have an overall benefit to warrant publication in ASFIRJ?</td>
                                        <td class="px-6 py-4 score-cell" id="merit">6/6</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal"><span class="font-medium">ENGLISH LEVEL:</span> Is the English language appropriate and understandable?</td>
                                        <td class="px-6 py-4 score-cell" id="english">6/6</td>
                                    </tr>
                                    
                                    <tr class="section-title">
                                        <td class="px-6 py-4 font-bold">TOTAL SCORE</td>
                                        <td class="px-6 py-4 font-bold score-cell" id="totalOverallRating">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Overall Recommendation -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h3 class="text-xl font-semibold text-primary mb-4">OVERALL RECOMMENDATION</h3>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr class="table-header">
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">DECISION</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">EXPLANATION OF DECISION</th>
                                    </tr>
                                </thead>
                                <tbody id="overallRecommendationContainer" class="bg-white divide-y divide-gray-200">
                                    <!-- Content will be inserted by JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Confidential Comment -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h3 class="text-xl font-semibold text-primary mb-4">Confidential Comment to the Editor</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div name="letter_to_editor" id="confidentialComment" class="text-gray-700"></div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6" id="action_container">
                        <!-- Actions will be inserted here by JavaScript -->
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
                    <a href="" class="flex items-center px-4 py-3 text-white bg-primary rounded-lg">
                        <span class="reviewsCount mr-3 bg-white text-primary rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                        <i class="bi bi-clipboard-check mr-3"></i>
                        Review and Score
                    </a>
                    <a href="./submitted/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg">
                        <span class="submittedReviewsCount mr-3 bg-gray-200 text-gray-700 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
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
    <script type="module" src="../../../js/dashboards/viewReview.js?v=<?= time(); ?>"></script>
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