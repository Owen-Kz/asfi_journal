
    <!-- Top Navigation - Now Sticky -->
    <div class="top-nav-custom text-white py-2">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="https://asfirj.org/" class="flex items-center">
                        <img src="https://asfirj.org/assets/images/logoIcon/logo.png" alt="ASFI Research Journal" class="h-8 filter grayscale brightness-0 invert">
                    </a>
                </div>
                
                <button id="mobileMenuToggle" class="md:hidden text-white">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                
                <div id="topLinks" class="hidden md:flex space-x-6">
                    <a href="https://asfirj.org/issues" class="hover:text-asfi-gold transition-colors">Explore ASFIRJ</a>
                    <a href="https://asfirj.org/authors.html#ob" class="hover:text-asfi-gold transition-colors">Get Published</a>
                    <a href="https://asfischolar.org/" target="_blank" class="hover:text-asfi-gold transition-colors">ASFIScholar</a>
                    <a href="https://africansciencefrontiers.com/about.php" target="_blank" class="hover:text-asfi-gold transition-colors">About ASFI</a>
                    <a href="https://asfirj.org/events.html" class="hover:text-asfi-gold transition-colors">Events</a>
                    <a href="https://asfirj.org/portal/login/" class="hover:text-asfi-gold transition-colors">Login</a>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobileMenu" class="md:hidden mt-4 hidden">
                <div class="flex flex-col space-y-3">
                    <a href="https://asfirj.org/issues" class="hover:text-asfi-gold transition-colors py-1">Explore ASFIRJ</a>
                    <a href="https://asfirj.org/authors.html#ob" class="hover:text-asfi-gold transition-colors py-1">Get Published</a>
                    <a href="https://asfischolar.org/" target="_blank" class="hover:text-asfi-gold transition-colors py-1">ASFIScholar</a>
                    <a href="https://africansciencefrontiers.com/about.php" target="_blank" class="hover:text-asfi-gold transition-colors py-1">About ASFI</a>
                    <a href="https://asfirj.org/events.html" class="hover:text-asfi-gold transition-colors py-1">Events</a>
                    <a href="https://asfirj.org/portal/login/" class="hover:text-asfi-gold transition-colors py-1">Login</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Journal Banner -->
    <div class="gradient-bg text-white py-8" style="background-image: url('https://imgs.search.brave.com/cUyDB5RbxDT6km2QpechP4jC8DWbOKLTT2KB1I0yDoU/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvMTUz/NTAwMTcxL3Bob3Rv/L2pvdXJuYWwtd2l0/aC1wZW4tb24tdG9w/LW9mLWEtbGFwdG9w/LmpwZz9zPTYxMng2/MTImdz0wJms9MjAm/Yz1BdmZSSlhsaF9f/b0J6ZGhqSDNPZkR6/STRWOUpkYUhaU1BU/Z2w3YXRzU3N3PQ'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="container mx-auto p-4 bg-primary-700 text-center">
            <h1 class="text-3xl md:text-4xl font-bold">ASFI Research Journal</h1>
            <p class="mt-2 text-lg opacity-90">International Journal for Scholarly Research</p>
        </div>
    </div>

    <!-- Main Navigation - Now Sticky -->
    <!-- Main Navigation - Now Sticky -->
    <nav class="main-nav-sticky bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Mobile menu button -->
                <div class="lg:hidden">
                    <button type="button" class="text-asfi-dark hover:text-asfi-blue focus:outline-none focus:text-asfi-blue" id="mobile-menu-button">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex lg:space-x-8">
                    <a href="https://asfirj.org/" class="text-asfi-dark hover:text-asfi-blue font-medium transition-colors">Home</a>
                    
                    <div class="relative group">
                        <a href="https://asfirj.org/aboutus.html" class="text-asfi-dark hover:text-asfi-blue font-medium transition-colors flex items-center">
                            About <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a href="https://asfirj.org/aboutus.html#ASFI">African Science Frontiers Initiatives</a>
                            <a href="https://asfirj.org/aboutus.html#aims">ASFIRJ's AIMS & SCOPE</a>
                            <a href="https://asfirj.org/aboutus.html#values">ASFIRJ Values</a>
                            <a href="https://asfirj.org/aboutus.html#prompt">Prompt Decisions and Rapid Publication</a>
                            <a href="https://asfirj.org/aboutus.html#why-section">Why Publish in ASFIRJ?</a>
                            <a href="https://asfirj.org/aboutus.html#open-access">Open Access and Author Licensing</a>
                            <a href="https://asfirj.org/aboutus.html#fees">Article Publication Fee</a>
                        </div>
                    </div>
                    
                    <div class="relative group dropdown">
                        <a href="#" class="text-asfi-dark hover:text-asfi-blue font-medium transition-colors flex items-center">
                            Browse Issues <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a href="https://asfirj.org/issues">Issues</a>
                            <a href="https://asfirj.org/supplements">Supplements</a>
                        </div>
                    </div>
                    
                    <a href="https://asfirj.org/editors.html" class="text-asfi-dark hover:text-asfi-blue font-medium transition-colors">Meet The Editors</a>
                    
                    <div class="relative group dropdown">
                        <a href="#" class="text-asfi-dark hover:text-asfi-blue font-medium transition-colors flex items-center">
                            Authors / Reviewers <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a href="https://asfirj.org/authors.html">For Authors</a>
                            <a href="https://asfirj.org/reviewers.html">For Reviewers</a>
                        </div>
                    </div>
                    
                    <a href="https://asfirj.org/contact.html" class="text-asfi-dark hover:text-asfi-blue font-medium transition-colors">Contact Us</a>
                </div>
                
                <!-- Submit Manuscript Button -->
                <a href="/portal" class="bg-asfi-blue text-white px-4 py-2 rounded-md font-medium hover:bg-blue-800 transition-colors whitespace-nowrap">
                    Submit Manuscript
                </a>
            </div>

            <!-- Mobile Navigation Menu -->
            <div class="lg:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t">
                    <a href="https://asfirj.org/" class="block px-3 py-2 text-asfi-dark hover:text-asfi-blue font-medium">Home</a>
                    
                    <!-- Mobile About Dropdown -->
                    <div class="relative">
                        <button class="mobile-dropdown-btn w-full text-left px-3 py-2 text-asfi-dark hover:text-asfi-blue font-medium flex justify-between items-center">
                            About <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div class="mobile-dropdown-content hidden pl-4">
                            <a href="https://asfirj.org/aboutus.html#ASFI" class="block px-3 py-2 text-sm text-asfi-dark hover:text-asfi-blue">African Science Frontiers Initiatives</a>
                            <a href="https://asfirj.org/aboutus.html#aims" class="block px-3 py-2 text-sm text-asfi-dark hover:text-asfi-blue">ASFIRJ's AIMS & SCOPE</a>
                            <a href="https://asfirj.org/aboutus.html#values" class="block px-3 py-2 text-sm text-asfi-dark hover:text-asfi-blue">ASFIRJ Values</a>
                            <a href="https://asfirj.org/aboutus.html#prompt" class="block px-3 py-2 text-sm text-asfi-dark hover:text-asfi-blue">Prompt Decisions and Rapid Publication</a>
                            <a href="https://asfirj.org/aboutus.html#why-section" class="block px-3 py-2 text-sm text-asfi-dark hover:text-asfi-blue">Why Publish in ASFIRJ?</a>
                            <a href="https://asfirj.org/aboutus.html#open-access" class="block px-3 py-2 text-sm text-asfi-dark hover:text-asfi-blue">Open Access and Author Licensing</a>
                            <a href="https://asfirj.org/aboutus.html#fees" class="block px-3 py-2 text-sm text-asfi-dark hover:text-asfi-blue">Article Publication Fee</a>
                        </div>
                    </div>
                    
                    <!-- Mobile Browse Issues Dropdown -->
                    <div class="relative">
                        <button class="mobile-dropdown-btn w-full text-left px-3 py-2 text-asfi-dark hover:text-asfi-blue font-medium flex justify-between items-center">
                            Browse Issues <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div class="mobile-dropdown-content hidden pl-4">
                            <a href="https://asfirj.org/issues" class="block px-3 py-2 text-sm text-asfi-dark hover:text-asfi-blue">Issues</a>
                            <a href="https://asfirj.org/supplements" class="block px-3 py-2 text-sm text-asfi-dark hover:text-asfi-blue">Supplements</a>
                        </div>
                    </div>
                    
                    <a href="https://asfirj.org/editors.html" class="block px-3 py-2 text-asfi-dark hover:text-asfi-blue font-medium">Meet The Editors</a>
                    
                    <!-- Mobile Authors/Reviewers Dropdown -->
                    <div class="relative">
                        <button class="mobile-dropdown-btn w-full text-left px-3 py-2 text-asfi-dark hover:text-asfi-blue font-medium flex justify-between items-center">
                            Authors / Reviewers <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div class="mobile-dropdown-content hidden pl-4">
                            <a href="https://asfirj.org/authors.html" class="block px-3 py-2 text-sm text-asfi-dark hover:text-asfi-blue">For Authors</a>
                            <a href="https://asfirj.org/reviewers.html" class="block px-3 py-2 text-sm text-asfi-dark hover:text-asfi-blue">For Reviewers</a>
                        </div>
                    </div>
                    
                    <a href="https://asfirj.org/contact.html" class="block px-3 py-2 text-asfi-dark hover:text-asfi-blue font-medium">Contact Us</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Add this CSS for mobile responsiveness -->
    <style>
        /* Ensure dropdowns work on mobile */
        @media (max-width: 1023px) {
            .dropdown-menu {
                display: none;
            }
            
            .mobile-dropdown-content {
                transition: all 0.3s ease;
            }
            
            .mobile-dropdown-content.active {
                display: block;
            }
            
            #mobile-menu {
                transition: all 0.3s ease;
            }
            
            #mobile-menu.active {
                display: block;
            }
        }

        /* Desktop dropdown styles */
        @media (min-width: 1024px) {
            .dropdown-menu {
                position: absolute;
                top: 100%;
                left: 0;
                background: white;
                min-width: 200px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                border-radius: 4px;
                opacity: 0;
                visibility: hidden;
                transform: translateY(-10px);
                transition: all 0.3s ease;
                z-index: 1000;
            }

            .group:hover .dropdown-menu {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }

            .dropdown-menu a {
                display: block;
                padding: 12px 16px;
                color: #333;
                text-decoration: none;
                border-bottom: 1px solid #f0f0f0;
                transition: background-color 0.2s;
            }

            .dropdown-menu a:hover {
                background-color: #f8f9fa;
                color: #2cabe3;
            }

            .dropdown-menu a:last-child {
                border-bottom: none;
            }
        }
    </style>

    <!-- Add this JavaScript for mobile menu functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileDropdownButtons = document.querySelectorAll('.mobile-dropdown-btn');

            // Toggle mobile menu
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('active');
                mobileMenu.classList.toggle('hidden');
            });

            // Toggle mobile dropdowns
            mobileDropdownButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const dropdownContent = this.nextElementSibling;
                    dropdownContent.classList.toggle('active');
                    dropdownContent.classList.toggle('hidden');
                    
                    // Rotate chevron icon
                    const icon = this.querySelector('i');
                    icon.classList.toggle('fa-chevron-down');
                    icon.classList.toggle('fa-chevron-up');
                });
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!event.target.closest('#mobile-menu') && !event.target.closest('#mobile-menu-button')) {
                    mobileMenu.classList.remove('active');
                    mobileMenu.classList.add('hidden');
                    
                    // Close all mobile dropdowns
                    document.querySelectorAll('.mobile-dropdown-content').forEach(dropdown => {
                        dropdown.classList.remove('active');
                        dropdown.classList.add('hidden');
                    });
                    
                    // Reset all chevron icons
                    document.querySelectorAll('.mobile-dropdown-btn i').forEach(icon => {
                        icon.classList.add('fa-chevron-down');
                        icon.classList.remove('fa-chevron-up');
                    });
                }
            });
        });
    </script>