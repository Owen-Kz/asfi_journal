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
    <title>ASFI Research Journal - Login</title>
    <meta name="description" content="Secure and reliable investment project">
    <meta name="author" content="Weperch LLC">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="title" Content="ASFI Research Journal - Reviewers">

    <meta name="description" content="ASFI Research Journal is an international journal, accepting contributions from all countries of the world. ASFIRJ publishes original papers, expert reviews, systematic reviews and meta-analyses, position papers, guidelines, protocols, data, editorials, news and commentaries, research letters.">
    <meta name="keywords" content="research,journal,africa,scholars,asfi, asfiresearchjournal, asfischolar">
    <link rel="shortcut icon" href="../../assets/images/logoIcon/favicon.png" type="image/x-icon">

    <link rel="apple-touch-icon" href="../../assets/images/logoIcon/logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="ASFI Research Journal - Reviewers">
    
    <meta itemprop="name" content="ASFI Research Journal - Reviewers">
    <meta itemprop="description" content="ASFI Research Journal is an international journal, accepting contributions from all countries of the world. ASFIRJ publishes original papers, expert reviews, systematic reviews and meta-analyses, position papers, guidelines, protocols, data, editorials, news and commentaries, research letters.">
    <meta itemprop="image" content="assets/images/seo/65be1258275121706955352.png">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="ASFI Research Journal">
    <meta property="og:description" content="ASFI Research Journal is an international journal, accepting contributions from all countries of the world. ASFIRJ publishes original papers, expert reviews, systematic reviews and meta-analyses, position papers, guidelines, protocols, data, editorials, news and commentaries, research letters.">
    <meta property="og:image" content="assets/images/seo/65be1258275121706955352.png"/>
    <meta property="og:image:type" content="png"/>
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
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
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
        
        .sidebar-link:hover, .sidebar-link.active {
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
            top: 48px; /* Height of the top nav */
            z-index: 999;
            background-color: white;
        }
        
        /* Dropdown styles */
        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
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
        
        /* Preloader styles */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.5);
            z-index: 9999;
            display: none;
        }

        .loader {
            border: 16px solid #f3f3f3;
            border-top: 16px solid #8a1e78ff;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            margin: auto;
            margin-top: 20%;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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

        /* reCAPTCHA styling */
        .g-recaptcha {
            margin: 15px 0;
            display: inline-block;
        }

        .g-recaptcha > div {
            margin: 0 auto;
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

        // reCAPTCHA state management for login
        let loginRecaptchaVerified = false;
        let loginRecaptchaWidgetId = null;
        let isLoginFormSubmitting = false;

        // reCAPTCHA callback function
        function onRecaptchaLoad() {
            // Render reCAPTCHA widget
            loginRecaptchaWidgetId = grecaptcha.render('recaptcha-container-login', {
                'sitekey': '<?php echo RECAPTCHA_SITE_KEY; ?>',
                'callback': onRecaptchaSuccess,
                'expired-callback': onRecaptchaExpired,
                'error-callback': onRecaptchaError,
                'size': 'normal'
            });
            
            // Initialize button state
            updateLoginButtonState();
        }

        // reCAPTCHA success callback
        function onRecaptchaSuccess(response) {
            loginRecaptchaVerified = true;
            updateLoginButtonState();
        }

        // reCAPTCHA expired callback
        function onRecaptchaExpired() {
            loginRecaptchaVerified = false;
            updateLoginButtonState();
            showToast('reCAPTCHA verification expired. Please complete it again.', 'warning');
        }

        // reCAPTCHA error callback
        function onRecaptchaError() {
            loginRecaptchaVerified = false;
            updateLoginButtonState();
            showToast('reCAPTCHA verification failed. Please try again.', 'error');
        }

        // Update login button state based on reCAPTCHA
        function updateLoginButtonState() {
            const loginButton = document.getElementById('loginButton');
            if (!loginButton) return;
            
            if (loginRecaptchaVerified && !isLoginFormSubmitting) {
                loginButton.disabled = false;
                loginButton.classList.remove('btn-disabled');
            } else {
                loginButton.disabled = true;
                loginButton.classList.add('btn-disabled');
            }
        }

        // Reset reCAPTCHA function for login
        function resetLoginRecaptcha() {
            if (loginRecaptchaWidgetId !== null) {
                grecaptcha.reset(loginRecaptchaWidgetId);
                loginRecaptchaVerified = false;
                updateLoginButtonState();
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

        // Set login form submitting state
        function setLoginFormSubmitting(submitting) {
            isLoginFormSubmitting = submitting;
            updateLoginButtonState();
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

            // Initialize button state
            updateLoginButtonState();
        });
    </script>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Preloader -->
    <div id="preloader" class="preloader hidden">
        <div class="loader"></div>
    </div>

    <!-- Error/Success Popups -->
    <div id="errorPopup" class="fixed top-4 right-4 bg-red-500 text-white p-4 rounded-lg shadow-lg z-50 hidden fade-in" style="z-index: 9999;">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <span id="errorMessage"></span>
        </div>
    </div>
    
    <div id="successPopup" class="fixed top-4 right-4 bg-green-500 text-white p-4 rounded-lg shadow-lg z-50 hidden fade-in" style="z-index: 9999;">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span id="successMessage"></span>
        </div>
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
                    <a href="https://asfirj.org/portal/signup/" class="sidebar-link">
                        <i class="fas fa-user-plus mr-2"></i> Sign Up
                    </a>
                    <a href="#" class="sidebar-link active">
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

        <!-- Login Form -->
        <div class="flex-1 p-4 md:p-8">
            <div class="max-w-2xl mx-auto">
                <!-- Mobile Navigation Tabs -->
                <div class="lg:hidden mb-6">
                    <div class="bg-white rounded-lg shadow-sm p-1 flex">
                        <a href="https://asfirj.org/portal/signup/" class="flex-1 text-center py-2 px-4 rounded-md text-gray-600 font-medium hover:bg-gray-50">
                            Sign Up
                        </a>
                        <a href="#" class="flex-1 text-center py-2 px-4 rounded-md bg-asfi-blue text-white font-medium">
                            Sign In
                        </a>
                    </div>
                </div>

                <!-- Login Form -->
                <div class="bg-white rounded-xl card-shadow overflow-hidden fade-in">
                    <div class="p-4 md:p-8">
                        <h3 class="text-2xl font-bold text-center text-asfi-dark mb-6">Sign In to Your Account</h3>
                        
                        <form id="loginForm" class="space-y-6" novalidate>
                            <div id="message_container" class="message"></div>
                            
                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input type="email" name="email" id="email" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-asfi-blue focus:border-asfi-blue transition-colors" 
                                    placeholder="Enter your email" required>
                            </div>
                            
                            <!-- Password Field -->
                            <div class="password-container">
                                <label for="pass" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input type="password" name="pass" id="pass" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-asfi-blue focus:border-asfi-blue transition-colors pr-10" 
                                    placeholder="Enter your password" required>
                                <button type="button" class="toggle-password" data-target="pass">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                            <!-- reCAPTCHA Widget -->
                            <div class="mt-6">
                                <div id="recaptcha-container-login"></div>
                                <p class="text-xs text-gray-500 mt-1">Please complete the reCAPTCHA verification to continue.</p>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="pt-4">
                                <button type="submit" id="loginButton"
                                    class="w-full bg-asfi-blue text-white py-3 px-4 rounded-md font-medium hover:bg-purple-800 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-asfi-blue btn-disabled"
                                    disabled>
                                    Sign In
                                </button>
                                
                                <div class="text-center mt-4 space-y-2">
                                    <p class="text-gray-600">
                                        Don't have an account? 
                                        <a href="https://asfirj.org/portal/signup/" class="text-asfi-blue font-medium hover:underline">Click here to create one</a>
                                    </p>
                                    <p class="text-gray-600">
                                        Forgotten Password? 
                                        <a href="https://asfirj.org/portal/resetPassword/" class="text-asfi-blue font-medium hover:underline">Click here to retrieve</a>
                                    </p>
                                </div>
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
    <button id="scroll-top" class="fixed bottom-6 right-6 bg-asfi-blue text-white p-3 rounded-full shadow-lg hover:bg-purple-800 transition-colors hidden">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- External Scripts -->
    <link rel="stylesheet" href="../../assets/global/css/iziToast.min.css?v=<?= time(); ?>">
    <script src="../../assets/global/js/iziToast.min.js?v=<?= time(); ?>"></script>
    <script type="module" src="../../js/forms/loginUser.js?v=<?= time(); ?>"></script>
</body>
</html>