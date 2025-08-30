import { parentDirectoryName, url } from "../constants.js";
import { GetCookie } from "../setCookie.js";
import { GetAccountData } from "./accountData.js";

const user = GetCookie("user");
const navbarContainer = document.getElementById("navbarContainer");

// --- helper to set and save navbar
function setNavbar(html, role) {
  navbarContainer.innerHTML = html;
  localStorage.setItem("navbarHTML", html);
  localStorage.setItem("navbarRole", role);
  
  // Initialize mobile menu after navbar is set
  initMobileMenu();
}

// Mobile menu initialization function
function initMobileMenu() {
  const mobileMenuButton = document.getElementById('mobileMenuButton');
  const closeMobileMenu = document.getElementById('closeMobileMenu');
  const mobileMenu = document.getElementById('mobileMenu');
  const hamburger = document.querySelector('.hamburger');
  
  // If elements don't exist, return early
  if (!mobileMenuButton || !mobileMenu) return;
  
  // Toggle mobile menu
  function toggleMobileMenu() {
    mobileMenu.classList.toggle('open');
    if (hamburger) hamburger.classList.toggle('open');
    document.body.style.overflow = mobileMenu.classList.contains('open') ? 'hidden' : '';
  }
  
  // Remove existing event listeners to prevent duplicates
  mobileMenuButton.replaceWith(mobileMenuButton.cloneNode(true));
  if (closeMobileMenu) closeMobileMenu.replaceWith(closeMobileMenu.cloneNode(true));
  
  // Get fresh references after cloning
  const newMobileMenuButton = document.getElementById('mobileMenuButton');
  const newCloseMobileMenu = document.getElementById('closeMobileMenu');
  
  // Add event listeners
  newMobileMenuButton.addEventListener('click', toggleMobileMenu);
  if (newCloseMobileMenu) newCloseMobileMenu.addEventListener('click', toggleMobileMenu);
  
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
}

if (user) {
  // 1. Try to use cached navbar first
  const cachedNavbar = localStorage.getItem("navbarHTML");
  if (cachedNavbar) {
    navbarContainer.innerHTML = cachedNavbar;
    // Initialize mobile menu for cached navbar
    setTimeout(initMobileMenu, 0);
  }

  // 2. Always refresh user info in the background
  (async () => {
    const userInfo = await GetAccountData(user);
    const isAuthor = userInfo.account_status;
    const is_reviewer = userInfo.is_reviewer;
    const is_editor = userInfo.is_editor;
    const userfullname = `${userInfo.prefix} ${userInfo.firstname} ${userInfo.lastname} ${userInfo.othername}`;

    const userfullname_container = document.querySelectorAll(".user_fullnameContainer");
    userfullname_container.forEach(container => {
      container.innerText = userfullname;
    });

    // determine active states
    const reviewerdashPattern = /^\/dashboard\/reviewerdash\/.*$/;
    const authordashPattern = /^\/dashboard\/authordash\/.*$/;
    const maildashPattern = /^\/dashboard\/mail\/.*$/;

    let homeActive, authorActive, reviewerActive, inboxActive;
    if (
      url.pathname === `${parentDirectoryName}/dashboard/authordash/` ||
      url.pathname === `/dashboard/authordash/`
    ) {
      homeActive = "nav-active text-white";
      authorActive = "text-gray-300 hover:text-white";
      reviewerActive = "text-gray-300 hover:text-white";
      inboxActive = "text-gray-300 hover:text-white";
    } else if (authordashPattern.test(url.pathname)) {
      homeActive = "text-gray-300 hover:text-white";
      authorActive = "nav-active text-white";
      reviewerActive = "text-gray-300 hover:text-white";
      inboxActive = "text-gray-300 hover:text-white";
    } else if (reviewerdashPattern.test(url.pathname)) {
      homeActive = "text-gray-300 hover:text-white";
      authorActive = "text-gray-300 hover:text-white";
      reviewerActive = "nav-active text-white";
      inboxActive = "text-gray-300 hover:text-white";
    } else if (maildashPattern.test(url.pathname)) {
      homeActive = "text-gray-300 hover:text-white";
      authorActive = "text-gray-300 hover:text-white";
      reviewerActive = "text-gray-300 hover:text-white";
      inboxActive = "nav-active text-white";
    }

    // navbars
    const authorNavbar = `
      <div class="container mx-auto px-4 py-2">
        <div class="flex space-x-6">
          <a href="${parentDirectoryName}/dashboard/authordash" class="${homeActive} px-3 py-2 rounded-md text-sm font-medium transition-colors">
            <i class='las la-home mr-1'></i>Home
          </a>
          <a href="${parentDirectoryName}/dashboard/authordash/manuscripts" class="${authorActive} px-3 py-2 rounded-md text-sm font-medium transition-colors">
            <i class='las la-pen mr-1'></i> Author
          </a>
          <a href="${parentDirectoryName}/dashboard/mail/inbox" class="${inboxActive} px-3 py-2 rounded-md text-sm font-medium transition-colors">
            <i class='fa fa-envelope mr-1'></i> Inbox
          </a>
          <a href="${parentDirectoryName}/portal/settings" class="hover:text-purple-200 transition">
            <i class='fa fa-user mr-1'></i> Account Details
          </a>
        </div>
      </div>`;

    const reviewerNavbar = `
      <div class="container mx-auto px-4 py-2">
        <div class="flex space-x-6">
          <a href="${parentDirectoryName}/dashboard/authordash" class="${homeActive} px-3 py-2 rounded-md text-sm font-medium transition-colors">
            <i class='las la-home mr-1'></i>Home
          </a>
          <a href="${parentDirectoryName}/dashboard/authordash/manuscripts" class="${authorActive} px-3 py-2 rounded-md text-sm font-medium transition-colors">
            <i class='las la-pen mr-1'></i> Author
          </a>
          <a href="${parentDirectoryName}/dashboard/reviewerdash" class="${reviewerActive} px-3 py-2 rounded-md text-sm font-medium transition-colors">
            <i class='las la-bell mr-1'></i> Review
          </a>
          <a href="${parentDirectoryName}/dashboard/mail/inbox" class="${inboxActive} px-3 py-2 rounded-md text-sm font-medium transition-colors">
            <i class='fa fa-envelope mr-1'></i> Inbox
          </a>
          <a href="${parentDirectoryName}/portal/settings" class="hover:text-purple-200 transition">
            <i class='fa fa-user mr-1'></i> Settings
          </a>
        </div>
      </div>`;

    const editorNavbar = `
      <div class="container mx-auto px-4 py-2">
        <div class="flex space-x-6">
          <a href="${parentDirectoryName}/dashboard/authordash" class="hover:text-purple-200 transition">
            <i class='las la-home mr-1'></i>Home
          </a>
          <a href="${parentDirectoryName}/dashboard/authordash/manuscripts" class="hover:text-purple-200 transition">
            <i class='las la-pen mr-1'></i> Author
          </a>
          <a href="${parentDirectoryName}/dashboard/reviewerdash" class="hover:text-purple-200 transition">
            <i class='las la-bell mr-1'></i> Review
          </a>
          <a href="https://process.asfirj.org/editors/dashboard?e=${user}" target=_blank class="hover:text-purple-200 transition">
            <i class='las la-edit mr-1'></i> Editorial Assignments
          </a>
          <a href="${parentDirectoryName}/dashboard/mail/inbox" class="hover:text-purple-200 transition">
            <i class='fa fa-envelope mr-1'></i> Inbox
          </a>
          <a href="${parentDirectoryName}/portal/settings" class="hover:text-purple-200 transition">
            <i class='fa fa-user mr-1'></i> Settings
          </a>
        </div>
      </div>`;

    // 3. Build and update navbar based on role
    if (isAuthor === "verified" && is_reviewer !== "yes" && is_editor !== "yes") {
      setNavbar(authorNavbar, "author");
    } else if (isAuthor === "verified" && is_reviewer === "yes" && is_editor !== "yes") {
      setNavbar(reviewerNavbar, "reviewer");
    } else if (isAuthor === "verified" && is_editor === "yes") {
      setNavbar(editorNavbar, "editor");
    }

    // Update user initials
    const initials = (userInfo.firstname[0] + userInfo.lastname[0]).toUpperCase();
    const userInitials = document.getElementById('userInitials');
    const mobileUserInitials = document.getElementById('mobileUserInitials');
    
    if (userInitials) userInitials.innerText = initials;
    if (mobileUserInitials) mobileUserInitials.innerText = initials;
    
    // Update email
    const userEmail = document.getElementById('userEmail');
    if (userEmail) userEmail.innerText = userInfo.email;
    
    // Update mobile navigation based on user role
    updateMobileNavigation(userInfo);
  })();
} else {
  window.location.href = parentDirectoryName + "/dashboard";
}

function updateMobileNavigation(userInfo) {
  const mobileNavLinks = document.getElementById('mobileNavLinks');
  if (!mobileNavLinks) return;
  
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
      <a href="https://process.asfirj.org/editors/dashboard?e=${user}" target="_blank" class="block py-3 px-4 rounded-lg hover:bg-purple-800 transition">
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
  
  // Re-initialize mobile menu to set up event listeners for new links
  initMobileMenu();
}