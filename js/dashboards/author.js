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
}

if (user) {
  // 1. Try to use cached navbar first
  const cachedNavbar = localStorage.getItem("navbarHTML");
  if (cachedNavbar) {
    navbarContainer.innerHTML = cachedNavbar;
  }

  // 2. Always refresh user info in the background
  (async () => {
    const userInfo = await GetAccountData(user);
    const isAuthor = userInfo.account_status;
    const is_reviewer = userInfo.is_reviewer;
    const is_editor = userInfo.is_editor;
        const userfullname = `${userInfo.prefix} ${userInfo.firstname} ${userInfo.lastname} ${userInfo.othername}`

    const userfullname_container = document.querySelectorAll(".user_fullnameContainer")
    userfullname_container.forEach(container =>{
        container.innerText = userfullname
    })

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
          <a href="${parentDirectoryName}/portal/settings" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
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
          <a href="${parentDirectoryName}/portal/settings" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
            <i class='fa fa-user mr-1'></i> Settings
          </a>
        </div>
      </div>`;

    const editorNavbar = `
      <div class="container mx-auto px-4 py-2">
        <div class="flex space-x-6">
          <a href="${parentDirectoryName}/dashboard/authordash" class="nav-active text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
            <i class='las la-home mr-1'></i>Home
          </a>
          <a href="${parentDirectoryName}/dashboard/authordash/manuscripts" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
            <i class='las la-pen mr-1'></i> Author
          </a>
          <a href="${parentDirectoryName}/dashboard/reviewerdash" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
            <i class='las la-bell mr-1'></i> Review
          </a>
          <a href="https://process.asfirj.org/editors/dashboard?e=${user}" target=_blank class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
            <i class='las la-edit mr-1'></i> Editorial Assignments
          </a>
          <a href="${parentDirectoryName}/dashboard/mail/inbox" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
            <i class='fa fa-envelope mr-1'></i> Inbox
          </a>
          <a href="${parentDirectoryName}/portal/settings" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
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
  })();
} else {
  window.location.href = parentDirectoryName + "/dashboard";
}
