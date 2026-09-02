<?php
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$directoryName = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "": dirname($_SERVER['REQUEST_URI'])."";
$base_url = $scheme . '://' . $_SERVER['HTTP_HOST'] . $directoryName ;

?>

<!-- Top Navigation - relative -->
<div class="top-nav-custom text-white py-2  top-0 z-50" style="background-color: #250242;">
    <div class="container max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <a href="https://asfirj.org/" class="flex items-center">
                    <img 
                        src="https://asfirj.org/assets/images/logoIcon/logo.png" 
                        alt="ASFI Research Journal" 
                        class="h-8 filter grayscale brightness-0 invert"
                    />
                </a>
            </div>
            
            <button 
                id="topMobileToggle"
                class="md:hidden text-white text-xl focus:outline-none"
            >
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="hidden md:flex items-center space-x-6">
                <button id="searchToggle" class="hover:text-[#ffbf00] transition-colors p-1" title="Search publications">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                    </svg>
                </button>
                <a href="https://asfirj.org/issues" class="hover:text-[#ffbf00] transition-colors text-sm">Explore ASFIRJ</a>
                <a href="https://asfirj.org/authors.html#ob" class="hover:text-[#ffbf00] transition-colors text-sm">Get Published</a>
                <a href="https://asfischolar.org/" target="_blank" rel="noopener noreferrer" class="hover:text-[#ffbf00] transition-colors text-sm">ASFIScholar</a>
                <a href="https://africansciencefrontiers.com/about.php" target="_blank" rel="noopener noreferrer" class="hover:text-[#ffbf00] transition-colors text-sm">About ASFI</a>
                <a href="https://asfirj.org/events.html" class="hover:text-[#ffbf00] transition-colors text-sm">Events</a>
                <a href="<?php echo $base_url; ?>/contact.php" class="hover:text-[#ffbf00] transition-colors text-sm">Contact</a>
                <a href="https://portal.asfirj.org/portal/login" class="hover:text-[#ffbf00] transition-colors text-sm">Login</a>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="topMobileMenu" class="md:hidden mt-4 hidden">
            <div class="flex flex-col space-y-3">
                <a href="https://asfirj.org/issues" class="hover:text-[#ffbf00] transition-colors py-1 text-sm">Explore ASFIRJ</a>
                <a href="https://asfirj.org/authors.html#ob" class="hover:text-[#ffbf00] transition-colors py-1 text-sm">Get Published</a>
                <a href="https://asfischolar.org/" target="_blank" rel="noopener noreferrer" class="hover:text-[#ffbf00] transition-colors py-1 text-sm">ASFIScholar</a>
                <a href="https://africansciencefrontiers.com/about.php" target="_blank" rel="noopener noreferrer" class="hover:text-[#ffbf00] transition-colors py-1 text-sm">About ASFI</a>
                <a href="https://asfirj.org/events.html" class="hover:text-[#ffbf00] transition-colors py-1 text-sm">Events</a>
                <a href="<?php echo $base_url; ?>/contact.php" class="hover:text-[#ffbf00] transition-colors py-1 text-sm">Contact</a>
                <a href="https://portal.asfirj.org/portal/login" class="hover:text-[#ffbf00] transition-colors py-1 text-sm">Login</a>
            </div>
        </div>
    </div>
</div>

<!-- Journal Banner -->
<div 
    class="text-white py-8" 
    style="
        background-image: url('<?php echo $base_url; ?>/images/journal-banner.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    "
>
    <div class="container max-w-7xl mx-auto px-4">
        <div class="text-center w-[max-content] bg-[#8703a1ff] px-8 py-4 rounded">
            <h1 class="text-2xl lg:text-3xl md:text-4xl font-medium text-white">ASFI Research Journal</h1>
        </div>
    </div>
</div>

<!-- Main Navigation -->
<nav class="bg-white shadow-sm sticky top-0 z-40">
    <div class="container max-w-7xl mx-auto px-2 xl:px-4">
        <div class="flex justify-between items-center py-3 gap-2">
            <!-- Mobile menu button -->
            <div class="lg:hidden flex-shrink-0">
                <button 
                    type="button" 
                    class="text-gray-700 hover:text-[#80078b] focus:outline-none focus:text-[#80078b] text-xl"
                    id="mainMobileToggle"
                >
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center gap-3 xl:gap-4 2xl:gap-6 flex-1 flex-wrap justify-start">
                <a href="<?php echo $base_url; ?>/" class="main-nav-link text-gray-700 hover:text-[#80078b] font-medium transition-colors whitespace-nowrap">Home</a>
                
                <!-- About Dropdown -->
                <div class="relative group">
                    <a href="<?php echo $base_url; ?>/aboutus.php" class="main-nav-link text-gray-700 hover:text-[#80078b] font-medium transition-colors flex items-center whitespace-nowrap">
                        About <i class="fas fa-chevron-down ml-1 text-[10px]"></i>
                    </a>
                    <div class="absolute top-full left-0 bg-white min-w-[220px] shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-1 border border-gray-100">
                        <a href="<?php echo $base_url; ?>/aboutus.php#ASFI" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">African Science Frontiers Initiatives</a>
                        <a href="<?php echo $base_url; ?>/aboutus.php#aims" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">ASFIRJ's AIMS & SCOPE</a>
                        <a href="<?php echo $base_url; ?>/aboutus.php#values" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">ASFIRJ Values</a>
                        <a href="<?php echo $base_url; ?>/aboutus.php#prompt" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Prompt Decisions and Rapid Publication</a>
                        <a href="<?php echo $base_url; ?>/aboutus.php#why-section" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Why Publish in ASFIRJ?</a>
                        <a href="<?php echo $base_url; ?>/aboutus.php#open-access" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Open Access and Author Licensing</a>
                        <a href="<?php echo $base_url; ?>/aboutus.php#fees" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b]">Article Publication Fee</a>
                    </div>
                </div>
                
                <!-- Browse Issues Dropdown -->
                <div class="relative group">
                    <a href="<?php echo $base_url; ?>/issues" class="main-nav-link text-gray-700 hover:text-[#80078b] font-medium transition-colors flex items-center whitespace-nowrap">
                        Browse Issues <i class="fas fa-chevron-down ml-1 text-[10px]"></i>
                    </a>
                    <div class="absolute top-full left-0 bg-white min-w-[200px] shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-1 border border-gray-100">
                        <a href="<?php echo $base_url; ?>/issues" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Issues</a>
                        <a href="<?php echo $base_url; ?>/supplements" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b]">Supplements</a>
                    </div>
                </div>
                
                <a href="<?php echo $base_url; ?>/editors.php" class="main-nav-link text-gray-700 hover:text-[#80078b] font-medium transition-colors whitespace-nowrap">Meet The Editors</a>
                
                <!-- Authors / Reviewers Dropdown -->
                <div class="relative group">
                    <a href="#" class="main-nav-link text-gray-700 hover:text-[#80078b] font-medium transition-colors flex items-center whitespace-nowrap">
                        Authors / Reviewers <i class="fas fa-chevron-down ml-1 text-[10px]"></i>
                    </a>
                    <div class="absolute top-full left-0 bg-white min-w-[200px] shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-1 border border-gray-100">
                        <a href="<?php echo $base_url; ?>/authors.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">For Authors</a>
                        <a href="<?php echo $base_url; ?>/reviewers.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b]">For Reviewers</a>
                    </div>
                </div>
                <!-- Ethics and Malpractice Statement Dropdown -->
                <div class="relative group">
                    <a href="<?php echo $base_url; ?>/ethics.php" class="main-nav-link text-gray-700 hover:text-[#80078b] font-medium transition-colors flex items-center whitespace-nowrap">
                        Ethics and Malpractice Statement <i class="fas fa-chevron-down ml-1 text-[10px]"></i>
                    </a>
                    <div class="absolute top-full left-1/2 -translate-x-1/2 xl:left-0 xl:translate-x-0 bg-white min-w-[340px] shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-1 border border-gray-100 max-h-[70vh] overflow-y-auto">
                        <a href="<?php echo $base_url; ?>/ethics.php#commitment" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Our commitment to publication ethics</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#publisher" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Responsibilities of the Publisher</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#editor" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Responsibilities of the Editor-in-Chief and Editorial Team</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#authors" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Responsibilities of Authors</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#authorship" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Authorship and contributorship</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#originality" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Originality, plagiarism and duplicate publication</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#fabrication" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Fabrication, falsification and research misconduct</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#peer-review-ethics" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Peer-review ethics</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#conflicts" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Conflicts of interest</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#ethical-approval" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Ethical approval and research involving humans or animals</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#informed-consent" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Informed consent and patient/participant privacy</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#data-integrity" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Data integrity, transparency and reproducibility</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#ai" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Use of artificial intelligence and AI-assisted technologies</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#citation" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Citation ethics</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#editorial-independence" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Editorial independence</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#complaints" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Complaints and appeals</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#allegations" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Allegations of publication misconduct</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#corrections" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Corrections, retractions and expressions of concern</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#post-publication" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Post-publication concerns</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#whistleblowers" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Protection of whistleblowers and complainants</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#confidentiality" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Editorial and peer-review confidentiality</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#peer-review-malpractice" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Malpractice involving the peer-review process</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#editorial-misconduct" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Editorial misconduct</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#research-integrity" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b] border-b border-gray-100">Research integrity beyond publication</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#continuous-improvement" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#80078b]">Commitment to continuous improvement</a>
                    </div>
                </div>
                <a href="<?php echo $base_url; ?>/special-issues" class="main-nav-link text-gray-700 hover:text-[#80078b] font-medium transition-colors whitespace-nowrap">Special Issues</a>
                
                <a href="<?php echo $base_url; ?>/theses.php" class="main-nav-link text-gray-700 hover:text-[#80078b] font-medium transition-colors whitespace-nowrap">ASFIRJ Theses</a>
            </div>
            
            <!-- Submit Manuscript Button -->
            <a href="/portal" class="bg-[#80078b] text-white px-3 xl:px-4 py-2 rounded-md font-medium hover:bg-[#6a0674] transition-colors whitespace-nowrap flex-shrink-0 text-xs xl:text-sm">
                Submit Manuscript
            </a>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mainMobileMenu" class="lg:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t">
                <a href="<?php echo $base_url; ?>/" class="block px-3 py-2 text-gray-700 hover:text-[#80078b] font-medium text-sm">Home</a>
                
                <!-- Mobile About Dropdown -->
                <div class="relative">
                    <button 
                        class="w-full text-left px-3 py-2 text-gray-700 hover:text-[#80078b] font-medium flex justify-between items-center text-sm mobile-dropdown-toggle"
                        data-dropdown="about"
                    >
                        About <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div class="pl-4 mobile-dropdown-content hidden" data-dropdown="about">
                        <a href="<?php echo $base_url; ?>/aboutus.php#ASFI" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">African Science Frontiers Initiatives</a>
                        <a href="<?php echo $base_url; ?>/aboutus.php#aims" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">ASFIRJ's AIMS & SCOPE</a>
                        <a href="<?php echo $base_url; ?>/aboutus.php#values" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">ASFIRJ Values</a>
                        <a href="<?php echo $base_url; ?>/aboutus.php#prompt" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Prompt Decisions and Rapid Publication</a>
                        <a href="<?php echo $base_url; ?>/aboutus.php#why-section" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Why Publish in ASFIRJ?</a>
                        <a href="<?php echo $base_url; ?>/aboutus.php#open-access" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Open Access and Author Licensing</a>
                        <a href="<?php echo $base_url; ?>/aboutus.php#fees" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Article Publication Fee</a>
                    </div>
                </div>
                
                <!-- Mobile Browse Issues Dropdown -->
                <div class="relative">
                    <button 
                        class="w-full text-left px-3 py-2 text-gray-700 hover:text-[#80078b] font-medium flex justify-between items-center text-sm mobile-dropdown-toggle"
                        data-dropdown="issues"
                    >
                        Browse Issues <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div class="pl-4 mobile-dropdown-content hidden" data-dropdown="issues">
                        <a href="<?php echo $base_url; ?>/issues" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Issues</a>
                        <a href="<?php echo $base_url; ?>/supplements" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Supplements</a>
                    </div>
                </div>
                
                <a href="<?php echo $base_url; ?>/editors.php" class="block px-3 py-2 text-gray-700 hover:text-[#80078b] font-medium text-sm">Meet The Editors</a>
                
                <!-- Mobile Authors/Reviewers Dropdown -->
                <div class="relative">
                    <button 
                        class="w-full text-left px-3 py-2 text-gray-700 hover:text-[#80078b] font-medium flex justify-between items-center text-sm mobile-dropdown-toggle"
                        data-dropdown="authors"
                    >
                        Authors / Reviewers <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div class="pl-4 mobile-dropdown-content hidden" data-dropdown="authors">
                        <a href="<?php echo $base_url; ?>/authors.php" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">For Authors</a>
                        <a href="<?php echo $base_url; ?>/reviewers.php" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">For Reviewers</a>
                    </div>
                </div>

                <!-- Mobile Ethics and Malpractice Statement Dropdown -->
                <div class="relative">
                    <button 
                        class="w-full text-left px-3 py-2 text-gray-700 hover:text-[#80078b] font-medium flex justify-between items-center text-sm mobile-dropdown-toggle"
                        data-dropdown="ethics"
                    >
                        Ethics and Malpractice Statement <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div class="pl-4 mobile-dropdown-content hidden max-h-[50vh] overflow-y-auto" data-dropdown="ethics">
                        <a href="<?php echo $base_url; ?>/ethics.php" class="block px-3 py-2 text-sm font-semibold text-[#80078b] hover:text-[#6a0674]">View Full Statement</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#commitment" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Our commitment to publication ethics</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#publisher" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Responsibilities of the Publisher</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#editor" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Responsibilities of the Editor-in-Chief</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#authors" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Responsibilities of Authors</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#authorship" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Authorship and contributorship</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#originality" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Originality, plagiarism and duplicate publication</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#fabrication" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Fabrication and research misconduct</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#peer-review-ethics" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Peer-review ethics</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#conflicts" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Conflicts of interest</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#ethical-approval" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Ethical approval</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#informed-consent" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Informed consent and privacy</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#data-integrity" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Data integrity and reproducibility</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#ai" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Use of AI and AI-assisted technologies</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#citation" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Citation ethics</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#editorial-independence" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Editorial independence</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#complaints" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Complaints and appeals</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#allegations" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Allegations of misconduct</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#corrections" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Corrections, retractions and expressions</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#post-publication" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Post-publication concerns</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#whistleblowers" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Protection of whistleblowers</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#confidentiality" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Editorial and peer-review confidentiality</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#peer-review-malpractice" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Malpractice in peer review</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#editorial-misconduct" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Editorial misconduct</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#research-integrity" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Research integrity beyond publication</a>
                        <a href="<?php echo $base_url; ?>/ethics.php#continuous-improvement" class="block px-3 py-2 text-sm text-gray-600 hover:text-[#80078b]">Commitment to continuous improvement</a>
                    </div>
                </div>

                <a href="<?php echo $base_url; ?>/special-issues" class="block px-3 py-2 text-gray-700 hover:text-[#80078b] font-medium text-sm">Special Issues</a>
                <a href="<?php echo $base_url; ?>/theses.php" class="block px-3 py-2 text-gray-700 hover:text-[#80078b] font-medium text-sm">ASFIRJ Theses</a>
            </div>
        </div>
    </div>
</nav>

<style>
/* Search Modal */
#search-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.6);
    z-index: 9999;
    display: none;
    align-items: flex-start;
    justify-content: center;
    padding-top: 80px;
}
#search-overlay.open { display: flex; }
#search-modal {
    background: #fff;
    border-radius: 16px;
    width: 100%;
    max-width: 560px;
    padding: 24px;
    box-shadow: 0 24px 48px rgba(0,0,0,.2);
}
#search-modal input {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 16px;
    outline: none;
    transition: border-color .2s;
}
#search-modal input:focus { border-color: #80078b; }
#search-modal input::placeholder { color: #9ca3af; }
#search-modal .search-close {
    position: absolute;
    top: 16px;
    right: 16px;
    background: #f3f4f6;
    border: none;
    border-radius: 50%;
    width: 36px;
    height: 36px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6b7280;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search modal
    var searchOverlay = document.createElement('div');
    searchOverlay.id = 'search-overlay';
    searchOverlay.innerHTML = 
        '<div id="search-modal" style="position:relative">' +
            '<button class="search-close" id="searchModalClose">&times;</button>' +
            '<h3 style="font-size:18px;font-weight:700;color:#111827;margin:0 0 4px">Search Publications</h3>' +
            '<p style="font-size:13px;color:#6b7280;margin:0 0 16px">Search by title, author, or keywords</p>' +
            '<form id="searchForm" action="' + window.location.origin + '/search" method="GET">' +
                '<input type="text" name="k" placeholder="Search articles, authors, topics..." autocomplete="off" />' +
                '<div style="display:flex;gap:8px;margin-top:12px">' +
                    '<button type="submit" style="flex:1;padding:10px;background:#80078b;color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer">Search</button>' +
                    '<button type="button" id="searchModalCancel" style="padding:10px 20px;background:#f3f4f6;color:#374151;border:none;border-radius:10px;font-size:14px;cursor:pointer">Cancel</button>' +
                '</div>' +
            '</form>' +
        '</div>';
    document.body.appendChild(searchOverlay);

    var searchToggle = document.getElementById('searchToggle');
    var searchModalClose = document.getElementById('searchModalClose');
    var searchModalCancel = document.getElementById('searchModalCancel');
    var searchForm = document.getElementById('searchForm');
    var searchInput = searchForm ? searchForm.querySelector('input') : null;

    function openSearch() {
        searchOverlay.classList.add('open');
        if (searchInput) setTimeout(function() { searchInput.focus(); }, 100);
        document.body.style.overflow = 'hidden';
    }
    function closeSearch() {
        searchOverlay.classList.remove('open');
        document.body.style.overflow = '';
    }

    if (searchToggle) searchToggle.addEventListener('click', openSearch);
    if (searchModalClose) searchModalClose.addEventListener('click', closeSearch);
    if (searchModalCancel) searchModalCancel.addEventListener('click', closeSearch);
    searchOverlay.addEventListener('click', function(e) {
        if (e.target === searchOverlay) closeSearch();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeSearch();
    });
});
</script>

<style>
/* Hover effects for desktop dropdowns */
.relative.group:hover .group-hover\:opacity-100 {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* Mobile dropdown styles */
.mobile-dropdown-toggle .fa-chevron-down {
    transition: transform 0.3s ease;
}

.mobile-dropdown-toggle.active .fa-chevron-down {
    transform: rotate(180deg);
}

/* Sticky header shadow on scroll */
nav.bg-white {
    transition: box-shadow 0.3s ease;
}

nav.bg-white.scrolled {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

/* Mobile menu animations */
#mainMobileMenu {
    transition: all 0.3s ease;
}

/* Desktop nav responsive fluid sizing */
.main-nav-link {
    font-size: clamp(10.5px, 0.85vw, 14px);
    line-height: 1.2;
}
@media (min-width: 1024px) and (max-width: 1150px) {
    .main-nav-link { font-size: 11px; }
}
@media (min-width: 1151px) and (max-width: 1280px) {
    .main-nav-link { font-size: 12px; }
}
@media (min-width: 1281px) and (max-width: 1439px) {
    .main-nav-link { font-size: 13px; }
}
@media (min-width: 1440px) {
    .main-nav-link { font-size: 14px; }
}

/* Banner responsive */
@media (max-width: 768px) {
    .top-nav-custom .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Top Navbar Mobile Toggle
    const topToggle = document.getElementById('topMobileToggle');
    const topMenu = document.getElementById('topMobileMenu');
    
    if (topToggle && topMenu) {
        topToggle.addEventListener('click', function() {
            topMenu.classList.toggle('hidden');
            const icon = this.querySelector('i');
            if (icon) {
                icon.classList.toggle('fa-bars');
                icon.classList.toggle('fa-times');
            }
        });
    }
    
    // Main Mobile Menu Toggle
    const mainToggle = document.getElementById('mainMobileToggle');
    const mainMenu = document.getElementById('mainMobileMenu');
    
    if (mainToggle && mainMenu) {
        mainToggle.addEventListener('click', function() {
            mainMenu.classList.toggle('hidden');
            const icon = this.querySelector('i');
            if (icon) {
                icon.classList.toggle('fa-bars');
                icon.classList.toggle('fa-times');
            }
        });
    }
    
    // Mobile Dropdown Toggles
    const dropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');
    
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const dropdownId = this.getAttribute('data-dropdown');
            const content = document.querySelector(`.mobile-dropdown-content[data-dropdown="${dropdownId}"]`);
            
            if (content) {
                content.classList.toggle('hidden');
                this.classList.toggle('active');
            }
        });
    });
    
    // Close mobile menus when clicking outside
    document.addEventListener('click', function(e) {
        const topNav = document.querySelector('.top-nav-custom');
        const mainNav = document.querySelector('nav.bg-white');
        
        // Close top menu
        if (topNav && !topNav.contains(e.target)) {
            if (topMenu && !topMenu.classList.contains('hidden')) {
                topMenu.classList.add('hidden');
                const icon = topToggle?.querySelector('i');
                if (icon) {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        }
        
        // Close main menu
        if (mainNav && !mainNav.contains(e.target)) {
            if (mainMenu && !mainMenu.classList.contains('hidden')) {
                mainMenu.classList.add('hidden');
                const icon = mainToggle?.querySelector('i');
                if (icon) {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        }
    });
    
    // Add scroll shadow effect
    const nav = document.querySelector('nav.bg-white');
    if (nav) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });
    }
});
</script>