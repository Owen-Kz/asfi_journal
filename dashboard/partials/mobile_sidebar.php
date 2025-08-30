<div id="mobileSidebar" class="fixed inset-0 z-40 transform translate-x-full transition-transform duration-300 md:hidden">
    <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>
    <div class="relative flex flex-col w-full max-w-xs bg-white h-full">
        <div class="p-4 border-b">
            <div class="text-center">
                <h2 class="text-1xl font-bold text-gray-800 flex items-center justify-center">
                    <i class="bi bi-journal-text mr-2 text-primary"></i> Authors Dashboard
                </h2>
            </div>
            <button id="closeMobileMenu" class="absolute top-4 right-4 text-gray-500">
                <i class="las la-times text-1xl"></i>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto py-2 px-2">
            <ul class="space-y-3" id="mobile-dashboard-menu">
                <li>
                    <a href="../manuscripts" class="flex items-center py-2 px-2 text-gray-700 hover:bg-purple-50 rounded-lg mobile-menu-item" data-path="manuscripts">
                        <span class="newSubmissionsCount mr-3 bg-gray-200 text-gray-700 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                        <i class="bi bi-folder-fill mr-3"></i>
                        Submitted Manuscripts
                    </a>
                </li>
                <li>
                    <a href="../coauth/" class="flex items-center py-2 px-2 text-gray-700 hover:bg-purple-50 rounded-lg mobile-menu-item" data-path="coauth">
                        <span class="coAuhtoredCount mr-3 bg-gray-200 text-gray-700 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                        <i class="bi bi-people-fill mr-3"></i>
                        Co-Authored Manuscripts
                    </a>
                </li>
                <li>
                    <a href="../submit/" class="flex items-center py-2 px-2 text-gray-700 hover:bg-purple-50 rounded-lg mobile-menu-item" data-path="submit">
                        <span class="w-6 h-6 flex items-center justify-center mr-3">
                            <i class="bi bi-plus-circle-fill text-green-500"></i>
                        </span>
                        <i class="bi bi-file-earmark-plus mr-3"></i>
                        Submit New Manuscript
                    </a>
                </li>
                <li>
                    <a href="../inreview/" class="flex items-center py-2 px-2 text-gray-700 hover:bg-purple-50 rounded-lg mobile-menu-item" data-path="inreview">
                        <span class="inReviewCount mr-3 bg-gray-200 text-gray-700 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                        <i class="bi bi-clipboard-check mr-3"></i>
                        Manuscripts With Decisions
                    </a>
                </li>
                <li class="pt-4 mt-4 border-t border-gray-100">
                    <a href="../../../portal/logout/" class="flex items-center py-2 px-2 text-gray-700 hover:bg-red-50 rounded-lg">
                        <span class="w-6 h-6 flex items-center justify-center mr-3">
                            <i class="bi bi-box-arrow-right text-red-500"></i>
                        </span>
                        <i class="bi bi-box-arrow-right mr-3"></i>
                        Logout
                    </a>
                </li>
            </ul>
            
            <!-- Quick Stats for Mobile -->
            <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                    <i class="bi bi-graph-up mr-2"></i> Quick Stats
                </h3>
                <div class="space-y-2">
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-600">Submitted</span>
                        <span class="font-medium newSubmissionsCount">0</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-600">In Review</span>
                        <span class="font-medium inReviewCount">0</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-600">Co-Authored</span>
                        <span class="font-medium coAuhtoredCount">0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to set active menu item based on current URL
    function setActiveMenuItem() {
        // Get current URL path
        const currentPath = window.location.pathname;
        
        // Extract the last part of the path
        const pathParts = currentPath.split('/').filter(part => part !== '');
        const lastPathSegment = pathParts[pathParts.length - 1];
        
        // Get all menu items (both desktop and mobile)
        const menuItems = document.querySelectorAll('.menu-item, .mobile-menu-item');
        
        // Remove active class from all items first
        menuItems.forEach(item => {
            item.classList.remove('active-menu-item');
            item.classList.remove('text-white');
            item.classList.remove('bg-gradient-to-r');
            item.classList.remove('from-accent');
            item.classList.remove('to-purple-800');
            item.classList.remove('shadow-sm');
            
            // Reset badge colors for all items
            const badge = item.querySelector('.newSubmissionsCount, .coAuhtoredCount, .inReviewCount');
            if (badge) {
                badge.classList.remove('bg-white');
                badge.classList.remove('text-accent');
                badge.classList.add('bg-gray-200');
                badge.classList.add('text-gray-700');
            }
        });
        
        // Find and activate the matching menu item
        let activeFound = false;
        
        menuItems.forEach(item => {
            const itemPath = item.getAttribute('data-path');
            const href = item.getAttribute('href');
            
            // Check if this item's path matches the current URL
            if (itemPath === lastPathSegment || 
                (lastPathSegment === undefined && itemPath === "") || 
                currentPath.includes(itemPath)) {
                
                // Add active class
                item.classList.add('active-menu-item');
                item.classList.add('text-white');
                item.classList.add('bg-gradient-to-r');
                item.classList.add('from-accent');
                item.classList.add('to-purple-800');
                item.classList.add('shadow-sm');
                
                // Update badge colors for active item
                const badge = item.querySelector('.newSubmissionsCount, .coAuhtoredCount, .inReviewCount');
                if (badge) {
                    badge.classList.remove('bg-gray-200');
                    badge.classList.remove('text-gray-700');
                    badge.classList.add('bg-white');
                    badge.classList.add('text-accent');
                }
                
                activeFound = true;
            }
        });
        
        // If no active item found and we're at the root, activate the first item
        if (!activeFound && (lastPathSegment === undefined || lastPathSegment === '')) {
            const firstItem = document.querySelector('.menu-item, .mobile-menu-item');
            if (firstItem) {
                firstItem.classList.add('active-menu-item');
                firstItem.classList.add('text-white');
                firstItem.classList.add('bg-gradient-to-r');
                firstItem.classList.add('from-accent');
                firstItem.classList.add('to-purple-800');
                firstItem.classList.add('shadow-sm');
                
                const badge = firstItem.querySelector('.newSubmissionsCount, .coAuhtoredCount, .inReviewCount');
                if (badge) {
                    badge.classList.remove('bg-gray-200');
                    badge.classList.remove('text-gray-700');
                    badge.classList.add('bg-white');
                    badge.classList.add('text-accent');
                }
            }
        }
    }
    
    // Set active menu item on page load
    setActiveMenuItem();
});
</script>