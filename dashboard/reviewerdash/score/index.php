<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviewer - Dashboard</title>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        /* Custom styles for the loader and other elements */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        
        .loader-p {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #310357;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .overlayX {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.95);
            display: none;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            z-index: 10000;
        }
        
        .spinn {
            width: 60px;
            height: 60px;
            border: 6px solid #f3f3f3;
            border-top: 6px solid #310357;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }
        
        .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: #310357;
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            z-index: 99;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .section-title {
            background-color: #f3e8ff;
        }
        
        .scores {
            text-align: center;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            border: 1px solid #e5e7eb;
            padding: 8px;
            text-align: left;
        }
        
        th {
            background-color: #f9fafb;
        }
        
        .submit-nav a li {
            transition: all 0.3s ease;
        }
        
        .submit-nav a li:hover {
            background-color: #4c1d95;
        }
        
        .notice_notify {
            background-color: #fef2f2;
            border-left: 4px solid #ef4444;
        }
        
        /* Form step styling */
        .form-step {
            display: none;
        }
        
        .form-step-active {
            display: block;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Progress bar styling */
        .progress-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
        }
        
        .progress-bar::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            height: 4px;
            width: 100%;
            background-color: #e5e7eb;
            z-index: 1;
        }
        
        .progress-bar::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            height: 4px;
            width: var(--progress-width, 0%);
            background-color: #310357;
            z-index: 1;
            transition: width 0.5s ease;
        }
        
        .progress-step {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            position: relative;
            z-index: 2;
            transition: background-color 0.3s ease;
        }
        
        .progress-step-active {
            background-color: #310357;
            color: white;
        }
        
        .progress-step-completed {
            background-color: #10b981;
            color: white;
        }
        
        .step-label {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            margin-top: 8px;
            font-size: 0.75rem;
            white-space: nowrap;
            color: #6b7280;
        }
        
        .progress-step-active .step-label {
            color: #310357;
            font-weight: 600;
        }
        
        .progress-step-completed .step-label {
            color: #10b981;
        }
        
        /* Navigation buttons */
        .btn-nav {
            padding: 0.75rem 1.5rem;
            background-color: #310357;
            color: white;
            border: none;
            border-radius: 0.375rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .btn-nav:hover {
            background-color: #4c1d95;
        }
        
        .btn-nav:disabled {
            background-color: #9ca3af;
            cursor: not-allowed;
        }
        
        .btn-nav-outline {
            background-color: transparent;
            border: 2px solid #310357;
            color: #310357;
        }
        
        .btn-nav-outline:hover {
            background-color: #f3e8ff;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .dashboard-header__inner {
                flex-direction: column;
            }
            
            table {
                font-size: 12px;
            }
            
            th, td {
                padding: 4px;
            }
            
            .progress-step {
                width: 30px;
                height: 30px;
                font-size: 0.875rem;
            }
            
            .step-label {
                font-size: 0.7rem;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Preloader -->
    <div class="preloader">
        <div class="loader-p"></div>
    </div>
    
    <!-- Upload Overlay -->
    <div class="overlayX">    
        <div class="spinn"></div>
        <div class="font-bold text-black">Uploading Documents...please wait...</div>
    </div>

    <a class="scroll-top"><i class="fas fa-angle-double-up"></i></a>

    <!-- Header -->
    <?php include_once("../../partials/navbar.php"); ?>

    <!-- Main Content -->
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar -->
        <aside class="bg-white w-full md:w-64 min-h-screen shadow-md">
            <div class="p-6">
                <div class="text-center mb-8 mt-4">
                    <h2 class="text-sm font-bold text-dark">Reviewer Dashboard</h2>
                </div>
                
                <ul class="submit-nav space-y-2">
                    <li>
                        <a href="../" class="flex items-center px-4 py-3 bg-accent text-white rounded-lg">
                            <span class="reviewsCount bg-white text-accent rounded-full w-6 h-6 flex items-center justify-center mr-2">0</span>
                            <span>Review and Score</span>
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/reviewerdash/submitted/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <span class="submittedReviewsCount bg-gray-200 text-gray-700 rounded-full w-6 h-6 flex items-center justify-center mr-2">0</span>
                            <span>Reviews Submitted</span>
                        </a>
                    </li>
                    <li>
                        <a href="../../../portal/logout/" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 p-4 md:p-6 overflow-auto">
            <!-- Notice Section -->
            <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
                <div class="notice_notify px-6 py-4 flex justify-between items-center flex-wrap">
                    <h5 class="text-red-800 font-bold text-lg">THE REVIEWER'S REPORT <i class='fas fa-edit text-red-600'></i></h5>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 text-sm mb-0">
                        Please outline your review report in the following structure.
                    </p>
                </div>
            </div>

            <!-- Messages -->
            <div class="message mb-6 hidden" id="message_container">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4">
                    <p>Your review has been submitted successfully!</p>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="progress-bar" id="progressBar">
                    <div class="progress-step progress-step-active" data-step="1">
                        1
                        <span class="step-label">Summary</span>
                    </div>
                    <div class="progress-step" data-step="2">
                        2
                        <span class="step-label">Comments</span>
                    </div>
                    <div class="progress-step" data-step="3">
                        3
                        <span class="step-label">Scoring 1</span>
                    </div>
                    <div class="progress-step" data-step="4">
                        4
                        <span class="step-label">Scoring 2</span>
                    </div>
                    <div class="progress-step" data-step="5">
                        5
                        <span class="step-label">Recommendation</span>
                    </div>
                    <div class="progress-step" data-step="6">
                        6
                        <span class="step-label">Confidential</span>
                    </div>
                </div>
            </div>

            <!-- Review Form -->
            <form id="reviewForm" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6 mb-6">
                <input type="hidden" name="article_id" value="12345" id="article_id" required>
                <input type="hidden" name="reviewed_by" value="reviewer@example.com" id="reviewed_by" required>
                
                <!-- Step 1: Summary -->
                <div class="form-step form-step-active" id="step-1">
                    <h3 class="text-sm font-bold text-accent mb-4">Step 1: Summary Comments</h3>
                    
                    <!-- One Paragraph Summary -->
                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-accent mb-2">One paragraph summary:</h3>
                        <p class="text-dark mb-4">In one paragraph, please summarize the content of the manuscript, highlighting the key findings and strengths of the study.</p>
                        <textarea name="paragraph_summary" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent" cols="5" rows="5"></textarea>
                        <div class="mt-2 flex items-center">
                            <span class="text-gray-600 mr-2">or</span>
                            <input type="file" name="paragraph_summary_file" class="ml-2">
                        </div>
                    </div>
                    
                    <div class="flex justify-end mt-8">
                        <button type="button" class="btn-nav" onclick="nextStep(2)">Next <i class="fas fa-arrow-right ml-2"></i></button>
                    </div>
                </div>
                
                <!-- Step 2: Comments -->
                <div class="form-step" id="step-2">
                    <h3 class="text-sm font-bold text-accent mb-4">Step 2: Detailed Comments</h3>
                    
                    <!-- General Comments -->
                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-accent mb-2">General Comments:</h3>
                        <p class="text-dark mb-4">Please provide general comments and criticisms that highlight the scientific content of the manuscript, including relevance of the topic to the field; appropriateness of the approaches and study design used to address the topic; validity and reliability of employed methods, including measurement instruments; areas of weakness; the appropriateness of references used; any ethical issues; etc. Please make your comments sufficiently specific to enable the authors to respond and address the concerns appropriately. Please number your comments (either with 1,2,3….. or A,B,C….) so that the authors can reference the numbering in their responses.</p>
                        <textarea name="general_comment" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent" cols="5" rows="5"></textarea>
                        <div class="mt-2 flex items-center">
                            <span class="text-gray-600 mr-2">or</span>
                            <input type="file" name="general_comment_file" class="ml-2">
                        </div>
                    </div>

                    <!-- Specific Comments -->
                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-accent mb-2">Specific comments:</h3>
                        <p class="text-dark mb-4">In addition to the general comments, please provide specific comments to the authors throughout the manuscript that touch on specific deviations and inaccuracies related to the scientific content of the manuscript, as well as areas of weakness. These specific comments should primarily focus on the scientific content, but at the same time highlight issues of spelling, formatting, and language problems. Please number your comments (either with 1,2,3….. or A,B,C….) so that the authors can reference the numbering in their responses.</p>
                        <textarea name="specific_comment" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent" cols="5" rows="5"></textarea>
                        <div class="mt-2 flex items-center">
                            <span class="text-gray-600 mr-2">or</span>
                            <input type="file" name="specific_comment_file" class="ml-2">
                        </div>
                    </div>
                    
                    <div class="flex justify-between mt-8">
                        <button type="button" class="btn-nav btn-nav-outline" onclick="prevStep(1)"><i class="fas fa-arrow-left mr-2"></i> Previous</button>
                        <button type="button" class="btn-nav" onclick="nextStep(3)">Next <i class="fas fa-arrow-right ml-2"></i></button>
                    </div>
                </div>
                
                <!-- Step 3: Scoring Table 1 -->
                <div class="form-step" id="step-3">
                    <h3 class="text-sm font-bold text-accent mb-4">Step 3: Manuscript Scoring (Part 1)</h3>
                    
                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-accent mb-2">SCORING SPECIFIC SECTION OF THE MANUSCRIPT</h3>
                        <p class="text-dark mb-4">Please score this section as objective as possible</p>

                        <div class="overflow-x-auto">
                            <!-- Your first scoring table content goes here -->
                            <table class="min-w-full border border-gray-300 mb-4">
                                <thead>
                                    <tr class="section-title">
                                        <th colspan="29" rowspan="2" class="p-3 border border-gray-300">QUESTIONS</th>
                                        <th colspan="29" class="p-3 border border-gray-300 text-center">SCORES<br>1=Poor, 5=Excellent</th>
                                    </tr>
                                    <tr>
                                        <th class="p-2 border border-gray-300 text-center">1</th>
                                        <th class="p-2 border border-gray-300 text-center">2</th>
                                        <th class="p-2 border border-gray-300 text-center">3</th>
                                        <th class="p-2 border border-gray-300 text-center">4</th>
                                        <th class="p-2 border border-gray-300 text-center">5</th>
                                        <th class="p-2 border border-gray-300 text-center">Not Applicable</th>
                                    </tr>
                                </thead>
                               <tbody class="first-table">
                                <tr class="section-title">
                                    <td colspan="54" class="p-3 font-bold bg-purple-50">QUESTIONS REGARDING TITLE AND ABSTRACT</td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Does the title accurately reflect the subject of the manuscript?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="title_accuracy" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="title_accuracy" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="title_accuracy" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="title_accuracy" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="title_accuracy" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="title_accuracy" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Does the abstract clearly summarize the content of the manuscript?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="abstract_summarize" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="abstract_summarize" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="abstract_summarize" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="abstract_summarize" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="abstract_summarize" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="abstract_summarize" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr class="section-title">
                                    <td colspan="54" class="p-3 font-bold bg-purple-50">QUESTIONS REGARDING INTRODUCTION</td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Does the manuscript present what is already known and unknown (gaps) on the topic in the introduction section?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="man_present" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="man_present" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="man_present" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="man_present" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="man_present" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="man_present" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Does the manuscript give an accurate summary of key recent research on the topic in the introduction section?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="accurate_summary" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="accurate_summary" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="accurate_summary" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="accurate_summary" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="accurate_summary" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="accurate_summary" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Is the purpose (aim or objective) of the paper, its originality and novelty clear as indicated in the introduction section?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="paper_purpose" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="paper_purpose" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="paper_purpose" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="paper_purpose" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="paper_purpose" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="paper_purpose" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr class="section-title">
                                    <td colspan="54" class="p-3 font-bold bg-purple-50">QUESTIONS REGARDING STUDY METHODS AND ETHICS</td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Is the methods section of the manuscript clear and what was done clearly and accurately described?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="clear_manuscript" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="clear_manuscript" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="clear_manuscript" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="clear_manuscript" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="clear_manuscript" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="clear_manuscript" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Are the study materials, methods, instruments used, and measurements made clearly described?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="clear_materials" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="clear_materials" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="clear_materials" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="clear_materials" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="clear_materials" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="clear_materials" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Are the research methods valid, reliable, reproducible, and meet requirements for best practice?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="best_practice" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="best_practice" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="best_practice" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="best_practice" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="best_practice" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="best_practice" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Are ethical standards followed in implementing the research and in writing the manuscript?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="ethical_standards" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="ethical_standards" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="ethical_standards" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="ethical_standards" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="ethical_standards" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="ethical_standards" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr class="section-title">
                                    <td colspan="54" class="p-3 font-bold bg-purple-50">QUESTIONS REGARDING RESULTS, GRAPHICS, AND TABLES</td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">What did the study find and has this been clearly described?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="study_find" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="study_find" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="study_find" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="study_find" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="study_find" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="study_find" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Are the results of the manuscript presented in a logical and coherent manner?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="result_present" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="result_present" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="result_present" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="result_present" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="result_present" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="result_present" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Do the graphics used (tables and figures) clearly complement the results?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="complemet_result" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="complemet_result" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="complemet_result" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="complemet_result" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="complemet_result" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="complemet_result" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Have the tables, graphics, figures, images followed highest specified standards?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="specified_standard" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="specified_standard" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="specified_standard" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="specified_standard" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="specified_standard" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="specified_standard" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Do the tables, graphics, figures, images add value or distract from the content of the manuscript?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="distract_content" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="distract_content" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="distract_content" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="distract_content" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="distract_content" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="distract_content" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Are there issues with titles, labels, statistical notation or image quality of tables, graphics, figures, images included in the manuscript?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="man_issues" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="man_issues" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="man_issues" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="man_issues" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="man_issues" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="man_issues" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr class="section-title">
                                    <td colspan="54" class="p-3 font-bold bg-purple-50">QUESTIONS REGARDING DISCUSSION</td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Does the manuscript present the summary of the key findings?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="key_findings" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="key_findings" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="key_findings" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="key_findings" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="key_findings" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="key_findings" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Does the manuscript highlight the strengths and limitations of the study?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="study_strenghts" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="study_strenghts" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="study_strenghts" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="study_strenghts" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="study_strenghts" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="study_strenghts" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Does the manuscript compare its findings to similar papers on the topic?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="compare_manu" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="compare_manu" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="compare_manu" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="compare_manu" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="compare_manu" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="compare_manu" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Does the manuscript discuss the meaning and implications of the findings?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="discuss_manu" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="discuss_manu" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="discuss_manu" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="discuss_manu" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="discuss_manu" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="discuss_manu" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Does the manuscript describe and discuss the overall story formed so far on the topic?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="describe_manu" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="describe_manu" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="describe_manu" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="describe_manu" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="describe_manu" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="describe_manu" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Do the conclusions reflect the achievement of the study aims?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="study_achievement" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="study_achievement" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="study_achievement" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="study_achievement" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="study_achievement" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="study_achievement" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Does the manuscript discuss the gaps or inconsistencies on the topic and ways forward described?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="topic_gaps" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="topic_gaps" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="topic_gaps" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="topic_gaps" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="topic_gaps" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="topic_gaps" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300">Is the referencing accurate, adequate and balance in relation to the topic of the manuscript?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="topic_accuracy" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="topic_accuracy" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="topic_accuracy" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="topic_accuracy" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="topic_accuracy" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="topic_accuracy" value="0" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr class="section-title">
                                    <td colspan="54" class="p-3 font-bold bg-purple-100">
                                        <b>TOTAL SCORE</b> 
                                        <span id="total-score1" class="ml-80 font-bold">0</span>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="flex justify-between mt-8">
                        <button type="button" class="btn-nav btn-nav-outline" onclick="prevStep(2)"><i class="fas fa-arrow-left mr-2"></i> Previous</button>
                        <button type="button" class="btn-nav" onclick="nextStep(4)">Next <i class="fas fa-arrow-right ml-2"></i></button>
                    </div>
                </div>
                
                <!-- Step 4: Scoring Table 2 -->
                <div class="form-step" id="step-4">
                    <h3 class="text-sm font-bold text-accent mb-4">Step 4: Manuscript Scoring (Part 2)</h3>
                    
                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-accent mb-2">OVERALL RATING OF THE MANUSCRIPT</h3>
                        <p class="text-dark mb-4">Please score this section as objective as possible</p>

                        <div class="overflow-x-auto">
                            <!-- Your second scoring table content goes here -->
                            <table class="min-w-full border border-gray-300 mb-4">
                                <thead>
                                    <tr class="section-title">
                                        <th colspan="29" rowspan="2" class="p-3 border border-gray-300">QUESTIONS</th>
                                        <th colspan="29" class="p-3 border border-gray-300 text-center">SCORES<br>1=Poor, 5=Excellent</th>
                                    </tr>
                                    <tr>
                                        <th class="p-2 border border-gray-300 text-center">1</th>
                                        <th class="p-2 border border-gray-300 text-center">2</th>
                                        <th class="p-2 border border-gray-300 text-center">3</th>
                                        <th class="p-2 border border-gray-300 text-center">4</th>
                                        <th class="p-2 border border-gray-300 text-center">5</th>
                                    </tr>
                                </thead>
                                  <tbody class="second-table">
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300"><b>NOVELTY:</b> Does the manuscript address an original and well-defined question? Do the findings of the manuscript advance current knowledge on the topic area?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="novelty" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="novelty" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="novelty" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="novelty" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="novelty" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300"><b>QUALITY:</b> Does the manuscript adhere to highest standard of writing and presentation of its findings? Are the manuscript sections appropriately written?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="quality" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="quality" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="quality" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="quality" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="quality" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300"><b>SCIENTIFIC ACCURACY:</b> Was the study design correct and sound? Do the methods employed follow expected standards in the study context? Are the data analyses choices and implementation of the highest technical standards within the scope of the topic area? Are the data and emanated results sufficiently robust to draw conclusions?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="scientific_accuracy" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="scientific_accuracy" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="scientific_accuracy" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="scientific_accuracy" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="scientific_accuracy" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300"><b>OVERALL MERIT:</b> Does the manuscript have an overall benefit to warrant publication in ASFIRJ?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="overall_merit" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="overall_merit" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="overall_merit" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="overall_merit" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="overall_merit" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr>
                                    <td colspan="29" class="p-3 border border-gray-300"><b>ENGLISH LEVEL:</b> Is the English language appropriate and understandable?</td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="english_level" value="1" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="english_level" value="2" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="english_level" value="3" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="english_level" value="4" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                    <td class="scores p-2 border border-gray-300"><input type="radio" name="english_level" value="5" class="h-4 w-4 text-accent focus:ring-accent input"></td>
                                </tr>
                                <tr class="section-title">
                                    <td colspan="54" class="p-3 font-bold bg-purple-100">
                                        <b>TOTAL SCORE</b> 
                                        <span id="total-score2" class="ml-80 font-bold">0</span>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="flex justify-between mt-8">
                        <button type="button" class="btn-nav btn-nav-outline" onclick="prevStep(3)"><i class="fas fa-arrow-left mr-2"></i> Previous</button>
                        <button type="button" class="btn-nav" onclick="nextStep(5)">Next <i class="fas fa-arrow-right ml-2"></i></button>
                    </div>
                </div>
                
                <!-- Step 5: Recommendation -->
                <div class="form-step" id="step-5">
                    <h3 class="text-sm font-bold text-accent mb-4">Step 5: Recommendation</h3>
                    
                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-accent mb-2">OVERALL RECOMMENDATION</h3>
                        <p class="text-dark mb-4">Your overall recommendation should come in either of the four underlisted decision paths.</p>

                        <div class="overflow-x-auto">
                            <!-- Your recommendation table content goes here -->
                            <table class="min-w-full border border-gray-300 mb-4">
                                <thead>
                                    <tr class="section-title">
                                        <th class="p-3 border border-gray-300">DECISION</th>
                                        <th class="p-3 border border-gray-300">PLEASE TICK YOUR DECISION</th>
                                        <th class="p-3 border border-gray-300">EXPLANATION OF DECISION</th>
                                    </tr>
                                </thead>
                         <tbody>
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 border border-gray-300 font-medium">Accept As It Is</td>
                                    <td class="p-3 border border-gray-300 text-center">
                                        <input type="radio" name="recommendation" value="Accept As It Is" class="h-4 w-4 text-accent focus:ring-accent input">
                                    </td>
                                    <td class="p-3 border border-gray-300"><b>The manuscript can be accepted without any further changes.</b></td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 border border-gray-300 font-medium">Accept Following Minor Revisions</td>
                                    <td class="p-3 border border-gray-300 text-center">
                                        <input type="radio" name="recommendation" value="Accept Following Minor Revisions" class="h-4 w-4 text-accent focus:ring-accent input">
                                    </td>
                                    <td class="p-3 border border-gray-300"><b>The paper can be accepted after satisfactory minor revisions on the basis of the comments raised by the reviewers and the editor.</b></td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 border border-gray-300 font-medium">Reconsider Following Major Revisions</td>
                                    <td class="p-3 border border-gray-300 text-center">
                                        <input type="radio" name="recommendation" value="Reconsider Following Major Revisions" class="h-4 w-4 text-accent focus:ring-accent input">
                                    </td>
                                    <td class="p-3 border border-gray-300"><b>The manuscript can be accepted after satisfactory major revisions on the basis of the comments raised by the reviewers and the editor.</b></td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 border border-gray-300 font-medium">Reject</td>
                                    <td class="p-3 border border-gray-300 text-center">
                                        <input type="radio" name="recommendation" value="Reject" class="h-4 w-4 text-accent focus:ring-accent input">
                                    </td>
                                    <td class="p-3 border border-gray-300"><b>The manuscript is considered to contain serious flaws and does offer any original contribution to the topic area.</b></td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="flex justify-between mt-8">
                        <button type="button" class="btn-nav btn-nav-outline" onclick="prevStep(4)"><i class="fas fa-arrow-left mr-2"></i> Previous</button>
                        <button type="button" class="btn-nav" onclick="nextStep(6)">Next <i class="fas fa-arrow-right ml-2"></i></button>
                    </div>
                </div>
                
                <!-- Step 6: Confidential Comments -->
                <div class="form-step" id="step-6">
                    <h3 class="text-sm font-bold text-accent mb-4">Step 6: Confidential Comments</h3>
                    
                    <!-- Confidential Comments -->
                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-accent mb-2">Confidential Comment to the Editor (Optional):</h3>
                        <textarea name="letter_to_editor" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent" cols="5" rows="5"></textarea>
                    </div>

                    <!-- Form Submission -->
                    <div class="flex items-center justify-between mt-8">
                        <input type="hidden" name="review_status">
                        <input type="submit" id="submitForm" hidden>
                        
                        <button type="button" class="btn-nav btn-nav-outline" onclick="prevStep(5)"><i class="fas fa-arrow-left mr-2"></i> Previous</button>
                        <button type="button" name="review_stat" class="btn-nav" onclick="setStatus('review_submitted')">
                            Submit Review
                        </button>
                    </div>
                </div>
            </form>
        </main>
    </div>

        <script>
        // Simulate preloader
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.querySelector('.preloader').style.display = 'none';
            }, 1000);
            
            // Scroll to top functionality
            document.querySelector('.scroll-top').addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
            
            // Calculate total scores
            const firstTableInputs = document.querySelectorAll('.first-table .scores input');
            const secondTableInputs = document.querySelectorAll('.second-table .scores input');
            const totalScore1 = document.getElementById('total-score1');
            const totalScore2 = document.getElementById('total-score2');

            function calculateTotalScore(inputs, totalScoreElement) {
                let total = 0;
                inputs.forEach(input => {
                    if (input.checked) {
                        total += parseInt(input.value, 10);
                    }
                });
                totalScoreElement.textContent = total;
            }

            firstTableInputs.forEach(input => {
                input.addEventListener('change', () => calculateTotalScore(firstTableInputs, totalScore1));
            });

            secondTableInputs.forEach(input => {
                input.addEventListener('change', () => calculateTotalScore(secondTableInputs, totalScore2));
            });
            
            // Form submission with loader
            const reviewForm = document.getElementById('reviewForm');
            // const overlayX = document.querySelector('.overlayX');
            
      
            
            // Initialize multi-step form
            initMultiStepForm();
        });

        // Multi-step form functionality
        function initMultiStepForm() {
            // Set progress bar width based on current step
            updateProgressBar(1);
        }
        
        let currentStep = 1;
        const totalSteps = 6;
        
        function nextStep(step) {
            // Validate current step if needed
            if (!validateStep(currentStep)) {
                return;
            }
            
            // Hide current step
            document.getElementById(`step-${currentStep}`).classList.remove('form-step-active');
            
            // Show next step
            document.getElementById(`step-${step}`).classList.add('form-step-active');
            
            // Update current step
            currentStep = step;
            
            // Update progress bar
            updateProgressBar(step);
            
            // Scroll to top of form
            document.getElementById('progressBar').scrollIntoView({ behavior: 'smooth' });
        }
        
        function prevStep(step) {
            // Hide current step
            document.getElementById(`step-${currentStep}`).classList.remove('form-step-active');
            
            // Show previous step
            document.getElementById(`step-${step}`).classList.add('form-step-active');
            
            // Update current step
            currentStep = step;
            
            // Update progress bar
            updateProgressBar(step);
            
            // Scroll to top of form
            document.getElementById('progressBar').scrollIntoView({ behavior: 'smooth' });
        }
        
        function updateProgressBar(step) {
            // Calculate progress percentage
            const progressPercentage = ((step - 1) / (totalSteps - 1)) * 100;
            
            // Update progress bar width
            document.documentElement.style.setProperty('--progress-width', `${progressPercentage}%`);
            
            // Update step indicators
            const steps = document.querySelectorAll('.progress-step');
            steps.forEach((stepElement, index) => {
                const stepNumber = parseInt(stepElement.getAttribute('data-step'));
                
                if (stepNumber < step) {
                    stepElement.classList.add('progress-step-completed');
                    stepElement.classList.remove('progress-step-active');
                } else if (stepNumber === step) {
                    stepElement.classList.add('progress-step-active');
                    stepElement.classList.remove('progress-step-completed');
                } else {
                    stepElement.classList.remove('progress-step-active', 'progress-step-completed');
                }
            });
        }
        
        function validateStep(step) {
            // Add validation logic for each step if needed
            // Return true if valid, false if not
            return true;
        }

        const reviewStatus = document.querySelector('input[name="review_status"]');
        const submitForm = document.getElementById('submitForm');

        function setStatus(status) {
            reviewStatus.value = status;
            
       
            
            // Submit the form after a brief delay to show the overlay
            setTimeout(function() {
                submitForm.click();
            }, 500);
        }
        
        // Google Translate Element
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,es,fr,de,zh-CN,ar,ru',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>

  
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const firstTableInputs = document.querySelectorAll('.first-table .input');
        const secondTableInputs = document.querySelectorAll('.second-table .input');
        const totalScore1 = document.getElementById('total-score1');
        const totalScore2 = document.getElementById('total-score2');

        function calculateTotalScore(inputs, totalScoreElement) {
            let total = 0;
            inputs.forEach(input => {
                if (input.checked) {
                    total += parseInt(input.value, 10);
                }
            });
            totalScoreElement.textContent = total;
        }

        firstTableInputs.forEach(input => {
            input.addEventListener('change', () => calculateTotalScore(firstTableInputs, totalScore1));
        });

        secondTableInputs.forEach(input => {
            input.addEventListener('change', () => calculateTotalScore(secondTableInputs, totalScore2));
        });
    });
</script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script type="module" src="../../../js/forms/submitReview.js?v=<?= time(); ?>"></script>
<script type="module" src="../../../js/dashboards/countItems.js?v=<?= time(); ?>"></script>
    <script type="module" src="../../../js/dashboards/author.js?v=<?= time(); ?>"></script>

</body>
</html>