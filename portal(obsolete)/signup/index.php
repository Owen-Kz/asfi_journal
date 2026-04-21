<?php
// If this is a PHP file, add this at the very top
include_once ('../../partials/load_env.php'); // Adjust path as needed
$siteKey = $_ENV['RECAPTCHA_SITE_KEY'] ?? getenv('RECAPTCHA_SITE_KEY');
$captchaSecret = $_ENV['RECAPTCHA_SECRET_KEY'] ?? getenv('RECAPTCHA_SECRET_KEY');

// Add reCAPTCHA keys
define('RECAPTCHA_SITE_KEY', $siteKey);
define('RECAPTCHA_SECRET_KEY', $captchaSecret);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASFI Research Journal - Register</title>
    <meta name="description" content="Secure and reliable investment project">
    <meta name="author" content="Weperch LLC">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="title" Content="ASFI Research Journal - Reviewers">

    <meta name="description"
        content="ASFI Research Journal is an international journal, accepting contributions from all countries of the world. ASFIRJ publishes original papers, expert reviews, systematic reviews and meta-analyses, position papers, guidelines, protocols, data, editorials, news and commentaries, research letters.">
    <meta name="keywords" content="research,journal,africa,scholars,asfi, asfiresearchjournal, asfischolar">
    <link rel="shortcut icon" href="../../assets/images/logoIcon/favicon.png" type="image/x-icon">

    <link rel="apple-touch-icon" href="../../assets/images/logoIcon/logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="ASFI Research Journal - Reviewers">

    <meta itemprop="name" content="ASFI Research Journal - Reviewers">
    <meta itemprop="description"
        content="ASFI Research Journal is an international journal, accepting contributions from all countries of the world. ASFIRJ publishes original papers, expert reviews, systematic reviews and meta-analyses, position papers, guidelines, protocols, data, editorials, news and commentaries, research letters.">
    <meta itemprop="image" content="assets/images/seo/65be1258275121706955352.png">

    <meta property="og:type" content="website">
    <meta property="og:title" content="ASFI Research Journal">
    <meta property="og:description"
        content="ASFI Research Journal is an international journal, accepting contributions from all countries of the world. ASFIRJ publishes original papers, expert reviews, systematic reviews and meta-analyses, position papers, guidelines, protocols, data, editorials, news and commentaries, research letters.">
    <meta property="og:image" content="assets/images/seo/65be1258275121706955352.png" />
    <meta property="og:image:type" content="png" />
    <meta property="og:image:width" content="1180" />
    <meta property="og:image:height" content="600" />
    <meta property="og:url" content="reviewers.html">

    <meta name="twitter:card" content="summary_large_image">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Add reCAPTCHA script with callback -->
    <script src="https://www.google.com/recaptcha/api.js?onload=onRecaptchaLoad&render=explicit" async defer></script>

    <style>
        /* Custom styles for password toggle */
        .password-container {
            position: relative;
        }

        /* reCAPTCHA styling */
        .g-recaptcha {
            margin: 15px 0;
            display: inline-block;
        }

        .g-recaptcha > div {
            margin: 0 auto;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6b7280;
            z-index: 10;
        }

        /* Custom animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        /* Custom gradient */
        .gradient-bg {
            background: linear-gradient(135deg, #250242 0%, #3730a3 100%);
        }

        .card-shadow {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Sidebar styles */
        .sidebar {
            background: linear-gradient(to bottom, #250242, #550f4fff);
            min-height: 100vh;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-link {
            display: block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            border-left: 4px solid transparent;
            transition: all 0.3s;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: #f59e0b;
        }

        .sidebar-section {
            margin-bottom: 20px;
        }

        .sidebar-title {
            padding: 10px 20px;
            color: #df93fdff;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Top nav color */
        .top-nav-custom {
            background-color: #250242;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        /* Main navigation sticky */
        .main-nav-sticky {
            position: sticky;
            top: 48px;
            /* Height of the top nav */
            z-index: 999;
            background-color: white;
        }

        /* Dropdown styles */
        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            border-radius: 4px;
            padding: 8px 0;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a {
            display: block;
            padding: 8px 16px;
            color: #333;
            text-decoration: none;
        }

        .dropdown-menu a:hover {
            background-color: #f5f5f5;
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Button disabled state */
        .btn-disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-disabled:hover {
            background-color: #8a1e78ff !important;
        }

        /* Loader animation */
        .button-loader {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-right: 8px;
            vertical-align: middle;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Form validation styles */
        .form-error {
            border-color: #ef4444 !important;
        }

        .form-success {
            border-color: #10b981 !important;
        }

        .alert-danger {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px;
            border-radius: 6px;
            margin: 10px 0;
        }

        .alert-success {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
            padding: 12px;
            border-radius: 6px;
            margin: 10px 0;
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#c50ee9ff',
                            600: '#b602c7ff',
                            700: '#8703a1ff',
                        },
                        asfi: {
                            blue: '#8a1e78ff',
                            purple: '#250242',
                            gold: '#f59e0b',
                            dark: '#1e293b',
                            light: '#f8fafc'
                        }
                    }
                }
            }
        }

        // reCAPTCHA state management
        let recaptchaVerified = false;
        let recaptchaWidgetId = null;
        let isFormSubmitting = false;

        // reCAPTCHA callback function
        function onRecaptchaLoad() {
            // Render reCAPTCHA widget
            recaptchaWidgetId = grecaptcha.render('recaptcha-container', {
                'sitekey': '<?php echo RECAPTCHA_SITE_KEY; ?>',
                'callback': onRecaptchaSuccess,
                'expired-callback': onRecaptchaExpired,
                'error-callback': onRecaptchaError,
                'size': 'normal'
            });
            
            // Initialize button state
            updateSubmitButtonState();
        }

        // reCAPTCHA success callback
        function onRecaptchaSuccess(response) {
            recaptchaVerified = true;
            updateSubmitButtonState();
        }

        // reCAPTCHA expired callback
        function onRecaptchaExpired() {
            recaptchaVerified = false;
            updateSubmitButtonState();
            showToast('reCAPTCHA verification expired. Please complete it again.', 'warning');
        }

        // reCAPTCHA error callback
        function onRecaptchaError() {
            recaptchaVerified = false;
            updateSubmitButtonState();
            showToast('reCAPTCHA verification failed. Please try again.', 'error');
        }

        // Update submit button state based on reCAPTCHA
        function updateSubmitButtonState() {
            const submitButton = document.getElementById('submitButton');
            if (!submitButton) return;
            
            if (recaptchaVerified && !isFormSubmitting) {
                submitButton.disabled = false;
                submitButton.classList.remove('btn-disabled');
            } else {
                submitButton.disabled = true;
                submitButton.classList.add('btn-disabled');
            }
        }

        // Reset reCAPTCHA function
        function resetRecaptcha() {
            if (recaptchaWidgetId !== null) {
                grecaptcha.reset(recaptchaWidgetId);
                recaptchaVerified = false;
                updateSubmitButtonState();
            }
        }

        // Toast notification function
        function showToast(message, type = 'info') {
            if (typeof iziToast !== 'undefined') {
                const config = {
                    message: message,
                    position: 'topRight',
                    timeout: 5000
                };
                
                switch(type) {
                    case 'success':
                        iziToast.success(config);
                        break;
                    case 'error':
                        iziToast.error(config);
                        break;
                    case 'warning':
                        iziToast.warning(config);
                        break;
                    default:
                        iziToast.info(config);
                }
            } else {
                // Fallback to simple alert
                alert(message);
            }
        }

        // Set form submitting state
        function setFormSubmitting(submitting) {
            isFormSubmitting = submitting;
            updateSubmitButtonState();
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Set current year in footer
            const currentYearElement = document.getElementById('currentYear');
            if (currentYearElement) {
                currentYearElement.textContent = new Date().getFullYear();
            }

            // Mobile menu toggle
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function () {
                    const mobileMenu = document.getElementById('mobileMenu');
                    if (mobileMenu) {
                        mobileMenu.classList.toggle('hidden');
                    }
                });
            }

            // Password toggle functionality
            const toggleButtons = document.querySelectorAll('.toggle-password');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-target');
                    const passwordInput = document.getElementById(targetId);
                    const icon = this.querySelector('i');

                    if (passwordInput) {
                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            icon.classList.remove('fa-eye');
                            icon.classList.add('fa-eye-slash');
                        } else {
                            passwordInput.type = 'password';
                            icon.classList.remove('fa-eye-slash');
                            icon.classList.add('fa-eye');
                        }
                    }
                });
            });

            // Scroll to top button
            const scrollButton = document.getElementById('scroll-top');
            if (scrollButton) {
                window.addEventListener('scroll', function () {
                    if (window.pageYOffset > 300) {
                        scrollButton.classList.remove('hidden');
                    } else {
                        scrollButton.classList.add('hidden');
                    }
                });

                scrollButton.addEventListener('click', function () {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }

            // Dropdown functionality for mobile
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('click', function (e) {
                    if (window.innerWidth < 1024) { // Only for mobile
                        e.preventDefault();
                        const menu = this.querySelector('.dropdown-menu');
                        if (menu) {
                            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
                        }
                    }
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown') && window.innerWidth < 1024) {
                    const dropdownMenus = document.querySelectorAll('.dropdown-menu');
                    dropdownMenus.forEach(menu => {
                        menu.style.display = 'none';
                    });
                }
            });

            // Form validation on input
            const passwordInput = document.getElementById('password');
            const password2Input = document.getElementById('password2');
            const messageContainer = document.getElementById('message_container');

            function validatePasswords() {
                if (!passwordInput || !password2Input || !messageContainer) return;
                
                const password = passwordInput.value;
                const password2 = password2Input.value;
                
                if (!password) {
                    messageContainer.innerHTML = `<div class="alert-danger">Password cannot be empty</div>`;
                } else if (password.length < 8) {
                    messageContainer.innerHTML = `<div class="alert-danger">Password must be at least 8 characters long</div>`;
                } else if (password !== password2) {
                    messageContainer.innerHTML = `<div class="alert-danger">Passwords do not match</div>`;
                } else {
                    messageContainer.innerHTML = ``;
                }
            }

            if (passwordInput && password2Input) {
                passwordInput.addEventListener('input', validatePasswords);
                password2Input.addEventListener('input', validatePasswords);
            }

            // Initialize button state
            updateSubmitButtonState();
        });
    </script>
</head>

<body class="bg-gray-50 font-sans">
    <!-- Preloader -->
    <div id="preloader" class="fixed inset-0 bg-white z-50 flex items-center justify-center hidden">
        <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4 border-t-asfi-blue animate-spin"></div>
    </div>

    <!-- Header -->
    <?php include '../partials/header.php'; ?>

    <!-- Main Content -->
    <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar w-64 hidden lg:block">
            <div class="p-6">
                <h2 class="text-xl font-bold text-white mb-6">Submission Portal</h2>

                <div class="sidebar-section">
                    <div class="sidebar-title">Account</div>
                    <a href="#" class="sidebar-link active">
                        <i class="fas fa-user-plus mr-2"></i> Sign Up
                    </a>
                    <a href="../login/" class="sidebar-link">
                        <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                    </a>
                </div>

                <div class="sidebar-section">
                    <div class="sidebar-title">Resources</div>
                    <a href="https://asfirj.org/authors.html" class="sidebar-link" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-user-edit mr-2"></i> Author Guidelines
                    </a>
                    <a href="https://asfirj.org/reviewers.html" class="sidebar-link" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-clipboard-check mr-2"></i> Reviewer Guidelines
                    </a>
                    <a href="https://asfirj.org/issues" class="sidebar-link" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-book-open mr-2"></i> Browse Issues
                    </a>
                </div>

                <div class="sidebar-section">
                    <div class="sidebar-title">Support</div>
                    <a href="https://asfirj.org/contact.html" class="sidebar-link" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-envelope mr-2"></i> Contact Us
                    </a>
                    <a href="https://asfirj.org/faq.html" class="sidebar-link" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-question-circle mr-2"></i> FAQ
                    </a>
                </div>
            </div>
        </div>

        <!-- Registration Form -->
        <div class="flex-1 p-4 md:p-8">
            <div class="max-w-4xl mx-auto">
                <!-- Mobile Navigation Tabs -->
                <div class="lg:hidden mb-6">
                    <div class="bg-white rounded-lg shadow-sm p-1 flex">
                        <a href="#" class="flex-1 text-center py-2 px-4 rounded-md bg-asfi-blue text-white font-medium">
                            Sign Up
                        </a>
                        <a href="../login/" class="flex-1 text-center py-2 px-4 rounded-md text-gray-600 font-medium hover:bg-gray-50">
                            Sign In
                        </a>
                    </div>
                </div>

                <!-- Registration Form -->
                <div class="bg-white rounded-xl card-shadow overflow-hidden fade-in">
                    <div class="p-4 md:p-8">
                        <h3 class="text-2xl font-bold text-center text-asfi-dark mb-6">Create Your Account</h3>

                        <form id="registerForm" class="space-y-6" novalidate>

                            <!-- Prefix and Name Row -->
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 md:gap-6">
                                <div class="md:col-span-1">
                                    <label for="prefix" class="block text-sm font-medium text-gray-700 mb-1">Prefix</label>
                                    <select name="prefix" id="prefix"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-asfi-blue focus:border-asfi-blue transition-colors"
                                        required>
                                        <option value="">Select Prefix</option>
                                        <option value="Prof.">Prof.</option>
                                        <option value="Dr.">Dr.</option>
                                        <option value="Mr.">Mr.</option>
                                        <option value="Mrs.">Mrs.</option>
                                        <option value="Miss">Miss</option>
                                    </select>
                                </div>

                                <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
                                    <div>
                                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                        <input type="text" name="first_name" id="first_name"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-asfi-blue focus:border-asfi-blue transition-colors"
                                            placeholder="First Name" required minlength="2">
                                    </div>

                                    <div>
                                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                        <input type="text" name="last_name" id="last_name"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-asfi-blue focus:border-asfi-blue transition-colors"
                                            placeholder="Last Name" required minlength="2">
                                    </div>

                                    <div>
                                        <label for="other_name" class="block text-sm font-medium text-gray-700 mb-1">Other Name</label>
                                        <input type="text" name="other_name" id="other_name"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-asfi-blue focus:border-asfi-blue transition-colors"
                                            placeholder="Other Name (Optional)">
                                    </div>
                                </div>
                            </div>

                            <!-- Email and ORCID -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                    <input type="email" name="email" id="email"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-asfi-blue focus:border-asfi-blue transition-colors"
                                        placeholder="Email Address" required>
                                </div>

                                <div>
                                    <label for="orcid" class="block text-sm font-medium text-gray-700 mb-1">ORCID ID (Optional)</label>
                                    <input type="text" name="orcid" id="orcid"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-asfi-blue focus:border-asfi-blue transition-colors"
                                        placeholder="ORCID ID">
                                </div>
                            </div>

                            <!-- Affiliation Details -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
                                <div>
                                    <label for="affiliation" class="block text-sm font-medium text-gray-700 mb-1">Affiliation</label>
                                    <input type="text" name="affiliation" id="affiliation"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-asfi-blue focus:border-asfi-blue transition-colors"
                                        placeholder="Institution/Organization" required>
                                </div>

                                <div>
                                    <label for="affiliation_country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                    <input type="text" name="affiliation_country" id="affiliation_country"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-asfi-blue focus:border-asfi-blue transition-colors"
                                        placeholder="Country" required>
                                </div>

                                <div>
                                    <label for="affiliation_city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                    <input type="text" name="affiliation_city" id="affiliation_city"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-asfi-blue focus:border-asfi-blue transition-colors"
                                        placeholder="City" required>
                                </div>
                            </div>

                            <!-- Discipline -->
                            <div>
                                <label for="discipline" class="block text-sm font-medium text-gray-700 mb-1">Primary Discipline</label>
                                <select name="discipline" id="discipline"
                                    class="discipline w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-asfi-blue focus:border-asfi-blue transition-colors"
                                    required>
                                    <option value="">Select a Discipline</option>
                                    <option value="Agricultural sciences">Agricultural sciences</option>
                                    <option value="Allied Health Sciences">Allied Health Sciences</option>
                                    <option value="Anthropology">Anthropology</option>
                                    <option value="Arts">Arts</option>
                                    <option value="Biology">Biology</option>
                                    <option value="Chemistry">Chemistry</option>
                                    <option value="Climate Change">Climate Change</option>
                                    <option value="Computer and Information Sciences">Computer and Information Sciences</option>
                                    <option value="Earth Sciences">Earth Sciences</option>
                                    <option value="Engineering and Technology">Engineering and Technology</option>
                                    <option value="Environmental Sciences">Environmental Sciences</option>
                                    <option value="Epidemiology">Epidemiology</option>
                                    <option value="Humanities">Humanities</option>
                                    <option value="Leadership and Management">Leadership and Management</option>
                                    <option value="Life Sciences">Life Sciences</option>
                                    <option value="Materials Science">Materials Science</option>
                                    <option value="Mathematics">Mathematics</option>
                                    <option value="Medicine">Medicine</option>
                                    <option value="Physics and Astronomy">Physics and Astronomy</option>
                                    <option value="Politics">Politics</option>
                                    <option value="Public & Global Health">Public & Global Health</option>
                                    <option value="Social and Behavioral Sciences">Social and Behavioral Sciences</option>
                                    <option value="Statistics">Statistics</option>
                                    <option value="Theology">Theology</option>
                                    <option value="Other">Other (please specify)</option>
                                </select>
                                <div id="disciplineContainer" class="mt-2"></div>
                            </div>

                            <!-- Review Availability -->
                            <div>
                                <p class="block text-sm font-medium text-gray-700 mb-2">Are you available to review for ASFIRJ? (optional)</p>
                                <div class="flex space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="review" value="yes" class="text-asfi-blue focus:ring-asfi-blue">
                                        <span class="ml-2">Yes</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="review" value="no" class="text-asfi-blue focus:ring-asfi-blue" checked>
                                        <span class="ml-2">No</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Password Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                <div class="password-container relative">
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Create Password</label>
                                    <input type="password" name="password" id="password"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-asfi-blue focus:border-asfi-blue transition-colors pr-10"
                                        placeholder="Password (min. 8 characters)" required minlength="8">
                                    <button type="button"
                                        class="toggle-password absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-gray-700"
                                        data-target="password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>

                                <div class="password-container relative">
                                    <label for="password2" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                                    <input type="password" name="password2" id="password2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-asfi-blue focus:border-asfi-blue transition-colors pr-10"
                                        placeholder="Confirm Password" required minlength="8">
                                    <button type="button"
                                        class="toggle-password absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-gray-700"
                                        data-target="password2">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Password Requirements -->
                            <div class="text-xs text-gray-500">
                                <p>Password must contain:</p>
                                <ul class="list-disc pl-5 mt-1 space-y-1">
                                    <li>At least 8 characters</li>
                                    <li>At least one uppercase letter</li>
                                    <li>At least one lowercase letter</li>
                                    <li>At least one number</li>
                                </ul>
                            </div>

                            <div id="message_container" class="right-4 z-50 text-red-500 fade-in message"></div>

                            <!-- reCAPTCHA Widget -->
                            <div class="mt-6">
                                <div id="recaptcha-container"></div>
                                <p class="text-xs text-gray-500 mt-1">Please complete the reCAPTCHA verification to continue.</p>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-4">
                                <button type="submit" id="submitButton"
                                    class="w-full bg-asfi-blue text-white py-3 px-4 rounded-md font-medium hover:bg-blue-800 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-asfi-blue signin-btn btn-disabled"
                                    disabled>
                                    Create Account
                                </button>

                                <p class="text-center mt-4 text-gray-600">
                                    Already have an account?
                                    <a href="../login/" class="text-asfi-blue font-medium hover:underline">Sign In here</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../partials/footer.php'; ?>

    <!-- Back to Top Button -->
    <button id="scroll-top"
        class="fixed bottom-6 right-6 bg-asfi-blue text-white p-3 rounded-full shadow-lg hover:bg-blue-800 transition-colors hidden">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- External Scripts -->
    <link rel="stylesheet" href="../../assets/global/css/iziToast.min.css?v=<?= time(); ?>">
    <script src="../../assets/global/js/iziToast.min.js?v=<?= time(); ?>"></script>
    <script type="module" src="../../js/forms/createAccount.js?v=<?= time(); ?>"></script>
</body>

</html>