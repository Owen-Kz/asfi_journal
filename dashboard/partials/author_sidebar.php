<aside class="w-64 bg-white shadow-lg hidden md:block border-r border-gray-100">
    <div class="p-6">
        <div class="text-center mb-8">
            <h2 class="text-1xl font-bold text-gray-800 flex items-center justify-center">
                <i class="bi bi-journal-text mr-2 text-primary"></i> Authors Dashboard
            </h2>
            <p class="text-xs text-gray-500 mt-1">Manage your research submissions</p>
        </div>
        
        <ul class="space-y-2" id="dashboard-menu">
            <li>
                <a href="../manuscripts" class="flex items-center py-2 px-2 text-gray-700 hover:bg-purple-50 rounded-lg menu-item" data-path="manuscripts">
                    <i class="bi bi-folder-fill mr-3"></i>
                    Submitted Manuscripts
                    <span class="newSubmissionsCount ml-3 bg-gray-200 text-gray-700 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                </a>
            </li>
            <li>
                <a href="../coauth/" class="flex items-center py-2 px-2 text-gray-700 hover:bg-purple-50 rounded-lg menu-item" data-path="coauth">
                    <i class="bi bi-people-fill mr-3"></i>
                    Co-Authored Manuscripts
                    <span class="coAuhtoredCount ml-3 bg-gray-200 text-gray-700 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                </a>
            </li>
            <li>
                <a href="../submit/" class="flex items-center py-2 px-2 text-gray-700 hover:bg-purple-50 rounded-lg menu-item" data-path="submit">
                    <i class="bi bi-file-earmark-plus mr-3"></i>
                    Submit New Manuscript
                </a>
            </li>
            <li>
                <a href="../inreview/" class="flex items-center py-2 px-2 text-gray-700 hover:bg-purple-50 rounded-lg menu-item" data-path="inreview">
                    <i class="bi bi-clipboard-check mr-3"></i>
                    Manuscripts With Decisions
                    <span class="inReviewCount ml-3 bg-gray-200 text-gray-700 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">0</span>
                </a>
            </li>
            <li class="pt-4 mt-4 border-t border-gray-100">
                <a href="../../../portal/logout/" class="flex items-center py-2 px-2 text-gray-700 hover:bg-red-50 rounded-lg">
                    <span class="w-6 h-6 flex items-center justify-center mr-3">
                        <i class="bi bi-box-arrow-right text-red-500"></i>
                    </span>
                    Logout
                </a>
            </li>
        </ul>
        
        <!-- Quick Stats -->
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
</aside>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to set active menu item based on current URL
    function setActiveMenuItem() {
        // Get current URL path
        const currentPath = window.location.pathname;
        
        // Extract the last part of the path
        const pathParts = currentPath.split('/').filter(part => part !== '');
        const lastPathSegment = pathParts[pathParts.length - 1];
        
        // Get all menu items
        const menuItems = document.querySelectorAll('.menu-item');
        
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
            const firstItem = document.querySelector('.menu-item');
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

<style>
.menu-item {
    transition: all 0.3s ease;
}

.menu-item:hover {
    background-color: #f3e8ff;
}

.active-menu-item {
    background: linear-gradient(to right, #320359, #4c1d95);
    color: white;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
</style>