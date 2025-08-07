const announcementContainer = document.getElementById('announcement-container');
    if (announcementContainer) {
        fetch('/backend/announcement/retrieve.php?priority=1')
            .then(response => response.json())
            .then(data => { 
                if (data && data.length > 0) {
                    announcementContainer.innerHTML = '';
                    data.forEach(announcement => {
                        const announcementElement = document.createElement('div');
                        announcementElement.className = 'announcement';
                        announcementElement.innerHTML = ` <a href="/announcement?x=${announcement.slug}" class="block group max-w-xl mx-auto bg-white-200 p-5 rounded-xl shadow-sm hover:shadow-sm transition">
  <h3 class="text-lg font-semibold text-purple-700 group-hover:underline">${announcement.title}</h3>
  <p class="text-gray-600 mt-2 line-clamp-3">
    ${announcement.data.trim().length > 100 ? announcement.data.trim().substring(0, 100) + '...' : announcement.data.trim()}
  </p>
  <div class="mt-4 text-md text-purple-500 group-hover:underline">Read more →</div>
</a>
                        `;
                        announcementContainer.appendChild(announcementElement);
                    });
                } else {
                    announcementContainer.innerHTML = '<p>No priority announcements available.</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching priority announcements:', error);
                announcementContainer.innerHTML = '<p>Error loading announcements.</p>';
            });
    }