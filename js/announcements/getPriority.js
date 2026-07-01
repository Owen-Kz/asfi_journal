{/* <div id="announcement-container" class="space-y-4">
    <!-- Announcements will be loaded here dynamically -->
</div> */}

{/* <script> */}
const FormatDescription = (description) =>{
    if(description.includes(`<img src="data:ima`) || description.includes(`<img src="http`) || description.includes(`<img src="/`) || description.includes(`<img src="`)){

        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = description;
        const imgElement = tempDiv.querySelector('img');
    
        const textContent = tempDiv.textContent.length > 120 ? tempDiv.textContent.substring(0, 120) : tempDiv.textContent;
        const finalContent = imgElement ? imgElement.outerHTML + textContent : textContent;
        return finalContent;
    }
   else{
        return  description.length > 120 ? description.substring(0, 120) + '...' : description
    }
}
document.addEventListener('DOMContentLoaded', function() {
    const announcementContainer = document.getElementById('announcement-container');
    
    if (announcementContainer) {
        // Show loading state
        announcementContainer.innerHTML = `
            <div class="text-center py-8">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-[#80078b] border-t-transparent"></div>
                <p class="text-gray-500 mt-2 text-sm">Loading announcements...</p>
            </div>
        `;
        
        fetch('http://localhost/ASFIRJ/asfi_journal/backend/announcement/retrieve.php?priority=1')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => { 
                if (data && data.length > 0) {
                    announcementContainer.innerHTML = '';
                    data.forEach(announcement => {
                        // Truncate description
                        const desc = announcement.data || '';
                        // const truncatedDesc = desc.length > 120 ? desc.substring(0, 120) + '...' : desc;
                        const truncatedDesc = FormatDescription(desc);
                        
                        const announcementElement = document.createElement('div');
                        announcementElement.className = 'bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden border border-gray-100 hover:border-[#80078b]/20';
                        announcementElement.innerHTML = `
                            <a href="/announcement?x=${announcement.slug || announcement.id}" class="block p-5 no-underline">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 mt-1">
                                        <div class="w-2 h-2 rounded-full bg-[#80078b]"></div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-base font-semibold text-[#80078b] group-hover:text-[#5a1f4e] transition-colors duration-200 line-clamp-2">
                                            ${announcement.title || 'Announcement'}
                                        </h3>
                                        <p class="text-sm text-gray-600 mt-2 line-clamp-3 leading-relaxed">
                                            ${truncatedDesc}
                                        </p>
                                        <div class="mt-3 flex items-center gap-2 text-sm font-medium text-[#80078b] hover:text-[#5a1f4e] transition-colors duration-200">
                                            <span>Read more</span>
                                            <i class="fas fa-arrow-right text-xs transition-transform duration-200 group-hover:translate-x-1"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        `;
                        announcementContainer.appendChild(announcementElement);
                    });
                } else {
                    announcementContainer.innerHTML = `
                        <div class="text-center py-8 bg-gray-50 rounded-lg">
                            <i class="fas fa-bell-slash text-3xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500 text-sm">No priority announcements available at the moment.</p>
                            <p class="text-gray-400 text-xs mt-1">Check back later for updates.</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error fetching priority announcements:', error);
                announcementContainer.innerHTML = `
                    <div class="text-center py-8 bg-red-50 rounded-lg border border-red-100">
                        <i class="fas fa-exclamation-circle text-3xl text-red-400 mb-3"></i>
                        <p class="text-red-600 text-sm">Unable to load announcements</p>
                        <p class="text-red-400 text-xs mt-1">Please refresh the page or try again later.</p>
                    </div>
                `;
            });
    } else {
        console.log("Announcement container not found");
    }
});

// </script>
