<section class="footer-section info-active bg-[#1a1a2e] text-gray-300 pt-16 pb-0">
    <div class="footer-top">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-12">
                <!-- Logo & Description -->
                <div class="sm-padding">
                    <div class="footer-widget">
                        <a class="logo block mb-4" href="https://asfirj.org/">
                            <img src="../assets/images/logoIcon/logo.png" alt="logo" class="h-16 w-auto object-contain" />
                        </a>
                        <p class="text-sm leading-relaxed text-gray-400">At ASFIRJ, we prioritize our publishers' expectations. With clear guidance, we ensure effective management and delivery. Join us in upholding excellence in research publishing.</p>
                    </div>
                </div>
                
                <!-- Author -->
                <div class="sm-padding">
                    <div class="footer-widget link-widget">
                        <h3 class="text-white text-lg font-semibold mb-4 relative pl-3 border-l-2 border-[#80078b]">Author</h3>
                        <ul class="widget-links list-none p-0 m-0">
                            <li class="flex items-center gap-2 mb-2">
                                <i class="fas fa-square-full text-[#80078b] text-[8px]"></i>
                                <a href="" class='menu-item text-gray-400 hover:text-white transition-colors duration-200 no-underline text-sm'>Print Request</a>
                            </li>
                        </ul>
                        <a href="" class="block mt-12 no-underline">
                            <h3 style="font-size: 25px" class="text-white font-semibold mt-12">ISSN: 3043-4262</h3>
                        </a>
                    </div>
                </div>
                
                <!-- Editor -->
                <div class="sm-padding">
                    <div class="footer-widget link-widget">
                        <h3 class="text-white text-lg font-semibold mb-4 relative pl-3 border-l-2 border-[#80078b]">Editor</h3>
                        <ul class="widget-links list-none p-0 m-0">
                            <li class="flex items-center gap-2 mb-2">
                                <i class="fas fa-square-full text-[#80078b] text-[8px]"></i>
                                <a href="../editors.html" class='menu-item text-gray-400 hover:text-white transition-colors duration-200 no-underline text-sm'>Editors</a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- About -->
                <div class="sm-padding">
                    <div class="footer-widget link-widget">
                        <h3 class="text-white text-lg font-semibold mb-4 relative pl-3 border-l-2 border-[#80078b]">About</h3>
                        <ul class="widget-links list-none p-0 m-0">
                            <li class="flex items-center gap-2 mb-2">
                                <i class="fas fa-square-full text-[#80078b] text-[8px]"></i>
                                <a href="../aboutus.html" class='menu-item text-gray-400 hover:text-white transition-colors duration-200 no-underline text-sm'>About Us</a>
                            </li>
                            <li class="flex items-center gap-2 mb-2">
                                <i class="fas fa-square-full text-[#80078b] text-[8px]"></i>
                                <a href="https://africansciencefrontiers.com/" class="text-gray-400 hover:text-white transition-colors duration-200 no-underline text-sm">African Science Frontiers Initiatives</a>
                            </li>
                            <li class="flex items-center gap-2 mb-2">
                                <i class="fas fa-square-full text-[#80078b] text-[8px]"></i>
                                <a href="https://asfischolar.org/" class="text-gray-400 hover:text-white transition-colors duration-200 no-underline text-sm">ASFIScholar</a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Useful Links -->
                <div class="sm-padding">
                    <div class="footer-widget link-widget">
                        <h3 class="text-white text-lg font-semibold mb-4 relative pl-3 border-l-2 border-[#80078b]">Useful Links</h3>
                        <ul class="widget-links list-none p-0 m-0">
                            <li class="flex items-center gap-2 mb-2">
                                <i class="fas fa-square-full text-[#80078b] text-[8px]"></i>
                                <a href="../events.html" class='menu-item text-gray-400 hover:text-white transition-colors duration-200 no-underline text-sm'>Events</a>
                            </li>
                            <li class="flex items-center gap-2 mb-2">
                                <i class="fas fa-square-full text-[#80078b] text-[8px]"></i>
                                <a href="../terms.html" class="text-gray-400 hover:text-white transition-colors duration-200 no-underline text-sm">Terms &amp; Conditions</a>
                            </li>
                            <li class="flex items-center gap-2 mb-2">
                                <i class="fas fa-square-full text-[#80078b] text-[8px]"></i>
                                <a href="../contact.html" class="text-gray-400 hover:text-white transition-colors duration-200 no-underline text-sm">Contact Support</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Newsletter Signup -->
                <div class="sm-padding">
                    <div class="footer-widget">
                        <h3 class="text-white text-lg font-semibold mb-4 relative pl-3 border-l-2 border-[#80078b]">Newsletter Signup</h3>
                        <p class="text-sm text-gray-400 mb-4">Signup today for hints, tips and the latest news and updates.</p>
                        <div class="subscribe-form">
                            <form class="subscribe-form newsLetterForm flex gap-2" id="newsLetterForm">
                                <input class="w-full flex-1 px-4 py-2 bg-[#2a2a4a] border border-[#3a3a5a] rounded-md text-white text-sm placeholder-gray-500 focus:outline-none focus:border-[#80078b] transition-colors duration-200" 
                                       type="email" 
                                       name="email" 
                                       placeholder="Email *" 
                                       required 
                                       id="subscribeEmail">
                                <button class="submit px-5 py-2 bg-[#80078b] text-white rounded-md hover:bg-[#6a0674] transition-colors duration-200 flex items-center gap-2 text-sm font-semibold">
                                    Subscribe <i class="fas fa-paper-plane"></i>
                                </button>
                            </form>
                            <script type="module" src="<?php echo $base_url?>/js/forms/newsLetter.js?v=<?= time(); ?>"></script>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="sm-padding">
                    <div class="footer-widget">
                        <h3 class="text-white text-lg font-semibold mb-4 relative pl-3 border-l-2 border-[#80078b]">Contact Information</h3>
                        <div class="space-y-3">
                            <div class="flex items-start gap-3">
                                <div class="footer-contact-menu__item-icon text-[#80078b] mt-1">
                                    <i class="las la-phone text-lg"></i>
                                </div>
                                <div class="footer-contact-menu__item-content">
                                    <p class="text-sm text-gray-400">+234(0)-701-436-3223</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="footer-contact-menu__item-icon text-[#80078b] mt-1">
                                    <i class="far fa-envelope-open text-lg"></i>
                                </div>
                                <div class="footer-contact-menu__item-content">
                                    <p class="text-sm text-gray-400">info@asfirj.org</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="footer-contact-menu__item-icon text-[#80078b] mt-1">
                                    <i class="fas fa-map-marked-alt text-lg"></i>
                                </div>
                                <div class="footer-contact-menu__item-content">
                                    <p class="text-sm text-gray-400">2b Gold Estate Banku off Lagos Ibadan Expressway, Wawa. Ogun State</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer Bottom -->
    <div class="footer-bottom border-t border-[#2a2a4a] py-6 mt-8">
        <div class="max-w-7xl mx-auto px-4">
            <div id="google_translate_element" class="mb-3"></div>
            <div class="copyright-wrap">
                <p class="text-sm text-gray-500 text-center">
                    &copy; <span id="currentYear"></span> 
                    <a href="https://asfirj.org/" class="text-[#80078b] hover:text-white transition-colors duration-200 no-underline">ASFI Research Journal</a> 
                    All Rights Reserved ||VO.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Scroll to Top Button -->
<div id="scrollup" class="fixed bottom-8 right-8 z-50">
    <button id="scroll-top" class="scroll-to-top w-12 h-12 bg-[#80078b] text-white rounded-full hover:bg-[#6a0674] hover:scale-110 transition-all duration-200 shadow-lg flex items-center justify-center border-none cursor-pointer">
        <i class="fas fa-chevron-up"></i>
    </button>
</div>

<style>
/* Additional footer styles that can't be easily done with Tailwind */
.footer-section .footer-widget a {
    transition: color 0.2s ease;
}

/* Style the Google Translate element */
.footer-bottom .goog-te-gadget {
    color: #9ca3af !important;
    font-family: inherit !important;
}

.footer-bottom .goog-te-gadget a {
    color: #80078b !important;
}

.footer-bottom .goog-te-gadget .goog-te-combo {
    background: #2a2a4a !important;
    color: #fff !important;
    border: 1px solid #3a3a5a !important;
    padding: 6px 12px !important;
    border-radius: 6px !important;
    font-size: 14px !important;
}

/* Scroll to top button visibility */
.scroll-to-top {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.scroll-to-top.visible {
    opacity: 1;
    transform: translateY(0);
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .footer-section .grid {
        gap: 2rem !important;
    }
    
    .footer-section .footer-widget h3 {
        font-size: 1.1rem !important;
    }
    
    .footer-section .subscribe-form {
        flex-direction: column;
    }
    
    .footer-section .subscribe-form .flex {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .footer-section .subscribe-form input,
    .footer-section .subscribe-form button {
        width: 100% !important;
    }
}
</style>

<script>
/* Scroll to top button visibility on scroll */
window.addEventListener('scroll', function() {
    const scrollBtn = document.getElementById('scroll-top');
    if (window.scrollY > 300) {
        scrollBtn.classList.add('visible');
    } else {
        scrollBtn.classList.remove('visible');
    }
});

// Scroll to top functionality
document.getElementById('scroll-top')?.addEventListener('click', function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Set current year
document.getElementById('currentYear').textContent = new Date().getFullYear();
</script>

<!-- Scripts -->
<!-- <script src="../front/public/js/vendor/jquery-1.12.4.min.js?v=<?= time(); ?>"></script>
<script src="../front/public/js/vendor/popper.min.js?v=<?= time(); ?>"></script>
<script src="../front/public/js/vendor/bootstrap.min.js?v=<?= time(); ?>"></script>
<script src="../front/public/js/vendor/waypoints.min.js?v=<?= time(); ?>"></script>
<script src="../front/public/js/vendor/slick.min.js?v=<?= time(); ?>"></script>
<script src="../front/public/js/vendor/jquery.ajaxchimp.min.js?v=<?= time(); ?>"></script>
<script src="../front/public/js/vendor/odometer.min.js?v=<?= time(); ?>"></script>
<script src="../front/public/js/vendor/jquery.isotope.v3.0.2.js?v=<?= time(); ?>"></script>
<script src="../front/public/js/vendor/imagesloaded.pkgd.min.js?v=<?= time(); ?>"></script>
<script src="../front/public/js/vendor/venobox.min.js?v=<?= time(); ?>"></script>
<script src="../front/public/js/vendor/jquery.hoverdir.js?v=<?= time(); ?>"></script>
<script src="../front/public/js/vendor/splitting.min.js?v=<?= time(); ?>"></script>
<script src="../front/public/js/vendor/wow.min.js?v=<?= time(); ?>"></script>
<script src="../js/announcements/getPriority.js?v=23"></script>
<script src="../js/shareModal.js?v=<?= time(); ?>"></script> -->