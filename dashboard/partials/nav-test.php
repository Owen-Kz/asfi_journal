<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASFIRJ Portal</title>
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
</head>
<body>
    <header class="bg-primary text-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <img src="https://asfirj.org/assets/images/logoIcon/logo.png" alt="site-logo" class="h-10 filter grayscale brightness-0 invert">
                        <span class="ml-2 font-bold text-lg hidden sm:block">ASFIRJ</span>
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#" class="hover:text-purple-200 transition">Home</a>
                    <a href="#" class="hover:text-purple-200 transition">Dashboard</a>
                    <a href="#" class="hover:text-purple-200 transition">Submissions</a>
                    <a href="#" class="hover:text-purple-200 transition">Reviews</a>
                    <a href="#" class="hover:text-purple-200 transition">Help</a>
                    
                    <div class="flex items-center space-x-4 ml-4 pl-4 border-l border-purple-500">
                        <div class="user-avatar">
                            <span id="userInitials">JD</span>
                        </div>
                        <div>
                            <span class="fw-bold user_fullnameContainer">John Doe</span>
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
                        <span id="mobileUserInitials">JD</span>
                    </div>
                    <div>
                        <div class="font-bold user_fullnameContainer">John Doe</div>
                        <div class="text-sm text-purple-300" id="userEmail">john.doe@example.com</div>
                    </div>
                </div>
                
                <nav class="space-y-2" id="mobileNavLinks">
                    <a href="#" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="fas fa-home mr-3"></i> Home
                    </a>
                    <a href="#" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
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
                    <a href="#" class="block py-3 px-4 rounded-lg hover:bg-red-700 transition mt-4">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Secondary Navigation Bar -->
    <nav id="navbarContainer" class="bg-primary-dark text-white sticky top-[76px] z-40 w-full shadow-md">
        <!-- Content will be populated by JavaScript -->
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobileMenuButton');
            const closeMobileMenu = document.getElementById('closeMobileMenu');
            const mobileMenu = document.getElementById('mobileMenu');
            const hamburger = document.querySelector('.hamburger');
            
            // Toggle mobile menu
            function toggleMobileMenu() {
                mobileMenu.classList.toggle('open');
                hamburger.classList.toggle('open');
                document.body.style.overflow = mobileMenu.classList.contains('open') ? 'hidden' : '';
            }
            
            // Event listeners
            mobileMenuButton.addEventListener('click', toggleMobileMenu);
            closeMobileMenu.addEventListener('click', toggleMobileMenu);
            
            // Close menu when clicking on a link
            const mobileMenuLinks = mobileMenu.querySelectorAll('a');
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', toggleMobileMenu);
            });
            
            // Close menu when clicking outside
            mobileMenu.addEventListener('click', function(e) {
                if (e.target === mobileMenu) {
                    toggleMobileMenu();
                }
            });
        });

        // Simulating the JavaScript data processing (this would be in your external JS file)
        function initializeNavbar() {
            // This is a simulation of your data processing
            // In reality, this would come from your external JS file
            
            // Mock user data (replace with actual data from your JS)
        
       
            
            // Update user initials
            const initials = (userInfo.firstname[0] + userInfo.lastname[0]).toUpperCase();
            document.getElementById('userInitials').innerText = initials;
            document.getElementById('mobileUserInitials').innerText = initials;
            
            // Update email
            document.getElementById('userEmail').innerText = userInfo.email;
            
            // Determine active states based on current URL (simplified)
            // In reality, you would use the logic from your JS file
            const currentPath = window.location.pathname;
            let homeActive = "text-gray-300 hover:text-white";
            let authorActive = "text-gray-300 hover:text-white";
            let reviewerActive = "text-gray-300 hover:text-white";
            let inboxActive = "text-gray-300 hover:text-white";
            
            // Simplified active state detection
            if (currentPath.includes("authordash") && !currentPath.includes("manuscripts")) {
                homeActive = "nav-active text-white";
            } else if (currentPath.includes("manuscripts")) {
                authorActive = "nav-active text-white";
            } else if (currentPath.includes("reviewerdash")) {
                reviewerActive = "nav-active text-white";
            } else if (currentPath.includes("mail")) {
                inboxActive = "nav-active text-white";
            }
            
            // Determine navbar based on user role
            let navbarHTML = '';
     

            // Update mobile navigation based on user role
            updateMobileNavigation(userInfo);
        }

        function updateMobileNavigation(userInfo) {
            const mobileNavLinks = document.getElementById('mobileNavLinks');
            const parentDirectoryName = ''; // Set this appropriately
            
            let mobileNavHTML = '';
            
            if (userInfo.account_status === "verified" && userInfo.is_reviewer !== "yes" && userInfo.is_editor !== "yes") {
                // Author mobile nav
                mobileNavHTML = `
                    <a href="${parentDirectoryName}/dashboard/authordash" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="las la-home mr-3"></i> Home
                    </a>
                    <a href="${parentDirectoryName}/dashboard/authordash/manuscripts" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="las la-pen mr-3"></i> Author
                    </a>
                    <a href="${parentDirectoryName}/dashboard/mail/inbox" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="fa fa-envelope mr-3"></i> Inbox
                    </a>
                    <a href="${parentDirectoryName}/portal/settings" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="fa fa-user mr-3"></i> Account Details
                    </a>
                    <a href="#" class="block py-3 px-4 rounded-lg hover:bg-red-700 transition mt-4">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </a>`;
            } else if (userInfo.account_status === "verified" && userInfo.is_reviewer === "yes" && userInfo.is_editor !== "yes") {
                // Reviewer mobile nav
                mobileNavHTML = `
                    <a href="${parentDirectoryName}/dashboard/authordash" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="las la-home mr-3"></i> Home
                    </a>
                    <a href="${parentDirectoryName}/dashboard/authordash/manuscripts" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="las la-pen mr-3"></i> Author
                    </a>
                    <a href="${parentDirectoryName}/dashboard/reviewerdash" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="las la-bell mr-3"></i> Review
                    </a>
                    <a href="${parentDirectoryName}/dashboard/mail/inbox" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="fa fa-envelope mr-3"></i> Inbox
                    </a>
                    <a href="${parentDirectoryName}/portal/settings" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="fa fa-user mr-3"></i> Settings
                    </a>
                    <a href="#" class="block py-3 px-4 rounded-lg hover:bg-red-700 transition mt-4">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </a>`;
            } else if (userInfo.account_status === "verified" && userInfo.is_editor === "yes") {
                // Editor mobile nav
                mobileNavHTML = `
                    <a href="${parentDirectoryName}/dashboard/authordash" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="las la-home mr-3"></i> Home
                    </a>
                    <a href="${parentDirectoryName}/dashboard/authordash/manuscripts" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="las la-pen mr-3"></i> Author
                    </a>
                    <a href="${parentDirectoryName}/dashboard/reviewerdash" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="las la-bell mr-3"></i> Review
                    </a>
                    <a href="https://process.asfirj.org/editors/dashboard?e=user_id" target="_blank" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="las la-edit mr-3"></i> Editorial Assignments
                    </a>
                    <a href="${parentDirectoryName}/dashboard/mail/inbox" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="fa fa-envelope mr-3"></i> Inbox
                    </a>
                    <a href="${parentDirectoryName}/portal/settings" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
                        <i class="fa fa-user mr-3"></i> Settings
                    </a>
                    <a href="#" class="block py-3 px-4 rounded-lg hover:bg-red-700 transition mt-4">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </a>`;
            }
            
            mobileNavLinks.innerHTML = mobileNavHTML;
        }

        // Initialize the navbar when the page loads
        initializeNavbar();
    </script>
</body>
</html>