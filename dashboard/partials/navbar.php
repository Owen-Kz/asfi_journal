
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#310357',
                        'primary-dark': '#250346',
                    }
                }
            }
        }
    </script>
    <style>
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #4c1d95;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }
        
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        
        .mobile-menu.open {
            transform: translateX(0);
        }
        
        .hamburger-line {
            transition: all 0.3s ease;
        }
        
        .hamburger.open .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }
        
        .hamburger.open .hamburger-line:nth-child(2) {
            opacity: 0;
        }
        
        .hamburger.open .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }
        
        .nav-active {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>

    <header class="bg-primary text-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <img src="https://asfirj.org/assets/images/logoIcon/logo.png" alt="site-logo" class="h-10 filter grayscale brightness-0 invert">
                        <!-- <span class="ml-2 font-bold text-lg hidden sm:block">ASFIRJ</span> -->
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    <ul  id="navbarContainer" class="flex space-x-6">
                    
                    </ul>

                    <div class="flex items-center space-x-4 ml-4 pl-4 border-l border-purple-500">
                        <div class="user-avatar">
                            <span id="userInitials"></span>
                        </div>
                        <div>
                            <span class="fw-bold user_fullnameContainer"></span>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobileMenuButton" class="hamburger focus:outline-none">
                        <div class="hamburger-line w-6 h-0.5 bg-white mb-1.5"></div>
                        <div class="hamburger-line w-6 h-0.5 bg-white mb-1.5"></div>
                        <div class="hamburger-line w-6 h-0.5 bg-white"></div>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Navigation Menu -->
        <div id="mobileMenu" class="mobile-menu fixed inset-0 bg-primary z-40 md:hidden">
            <div class="flex justify-between items-center p-4 border-b border-purple-500">
                <a href="/" class="flex items-center">
                    <img src="https://asfirj.org/assets/images/logoIcon/logo.png" alt="site-logo" class="h-10 filter grayscale brightness-0 invert">
                    <span class="ml-2 font-bold text-lg">ASFIRJ</span>
                </a>
                <button id="closeMobileMenu" class="text-white text-2xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="p-4">
                <div class="flex items-center space-x-4 mb-6 p-2 bg-purple-800 rounded-lg">
                    <div class="user-avatar">
                        <span id="mobileUserInitials"></span>
                    </div>
                    <div>
                        <div class="font-bold user_fullnameContainer"></div>
                        <div class="text-sm text-purple-300" id="userEmail"></div>
                    </div>
                </div>
                
                <nav class="space-y-2" id="mobileNavLinks">
                    <a href="/dashboard/authordash/" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="fas fa-home mr-3"></i> Home
                    </a>
                    <a href="/dashboard/authordash/" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                    </a>
                    <a href="#" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="fas fa-file-upload mr-3"></i> Submissions
                    </a>
                    <a href="#" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="fas fa-clipboard-check mr-3"></i> Reviews
                    </a>
                    <a href="#" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="fas fa-question-circle mr-3"></i> Help
                    </a>
                    <a href="#" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="fas fa-cog mr-3"></i> Settings
                    </a>
                    <a href="/portal/logout/" class="block py-3 px-4 rounded-lg hover:bg-red-700 transition mt-4">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Secondary Navigation Bar -->
    <nav class="bg-primary-dark text-white sticky top-[76px] z-40 w-full shadow-md">
        <!-- Content will be populated by JavaScript -->
    </nav>

   