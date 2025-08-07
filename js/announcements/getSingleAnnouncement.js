const announcementContainer = document.getElementById("announcement-main")
const slug = new URLSearchParams(window.location.search).get("x");

if(!slug) {
    announcementContainer.innerHTML = "<p>No announcement selected.</p>";
    throw new Error("No slug provided in the URL.");
}
if (announcementContainer) {
    fetch("https://asfirj.org/backend/announcement/retrieveSingle.php?xid=" + slug)
        .then(response => response.json())
        .then(data => {
            if (data) {
                console.log(data);
                announcementContainer.innerHTML = `
                			
				<div class="row titleBar">
					<div class="wow fadeInLeft text-center" data-wow-delay="200ms">
						<div class="section-heading">
							<h2>${data.title}</h2>
						</div>
					</div>
				</div>

				<div class="row">
					

					<div class="wow fadeInLeft" data-wow-delay="200ms" style="text-align: start; padding:10px;">
						<div class='content'>
                    ${data.data}
                    </div>
                    </div>
                 
                `;
            } else {
                announcementContainer.innerHTML = "<p>Announcement not found.</p>";
            }
        })
        .catch(error => {
            console.error("Error fetching announcement:", error);
            announcementContainer.innerHTML = "<p>Error loading announcement.</p>";
        });
}