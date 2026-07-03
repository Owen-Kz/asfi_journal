var getBioModal = document.getElementById("editorModal");
var getBioContent = getBioModal ? getBioModal.querySelector(".modal-content") : null;
var getBioQuill = null;

function fetchEditorBio(fullname) {
    var bioContainer = document.getElementById("bio-container");
    if (!bioContainer) return;

    fetch("./backend/editorsSections/getBio.php?name=" + encodeURIComponent(fullname), { method: "GET" })
        .then(function (res) { return res.json(); })
        .then(function (data) {
            if (data.status !== "success" || !data.editor || !data.editor[0]) {
                bioContainer.innerHTML = '<p style="color: #6b7280; font-style: italic;">No biography available.</p>';
                return;
            }
            var editor = data.editor[0];

            if (!editor.bio || editor.bio === "null" || editor.bio === "") {
                bioContainer.innerHTML = '<p style="color: #6b7280; font-style: italic;">No biography available.</p>';
                return;
            }

            try {
                var quillContent = JSON.parse(editor.bio);
                if (Array.isArray(quillContent)) {
                    if (getBioQuill) {
                        getBioQuill.setContents(quillContent);
                    } else {
                        getBioQuill = new Quill(bioContainer, {
                            theme: "snow",
                            modules: { toolbar: false },
                            readOnly: true,
                        });
                        getBioQuill.setContents(quillContent);
                    }
                    return;
                }
            } catch (_) {}

            // Fallback: render as HTML
            var bioDiv = document.createElement("div");
            bioDiv.className = "ql-editor";
            bioDiv.style.padding = "0";
            bioDiv.innerHTML = editor.bio;
            bioContainer.appendChild(bioDiv);
        })
        .catch(function (err) {
            console.error("Failed to fetch editor bio:", err);
            bioContainer.innerHTML = '<p style="color: #ef4444;">Failed to load biography.</p>';
        });
}

function openModal(prefix, fullname, country, photo, email, discipline, isOldEditor) {
    if (!getBioModal || !getBioContent) return;

    prefix = decodeURIComponent(prefix || '');
    fullname = decodeURIComponent(fullname || '');
    country = decodeURIComponent(country || '');
    photo = decodeURIComponent(photo || '');
    email = decodeURIComponent(email || '');
    discipline = decodeURIComponent(discipline || '');
    isOldEditor = decodeURIComponent(isOldEditor || 'no');

    var photoUrl = (isOldEditor === 'yes' ? './useruploads/editors/' : 'https://process.asfirj.org/useruploads/editors/') + photo.replace(/'/g, "\\'");

    getBioContent.innerHTML =
        '<button class="close-btn" onclick="closeModal()">&times;</button>' +
        '<div style="display:flex; gap:24px; align-items:flex-start; margin-bottom:24px;">' +
            '<div style="width:100px; height:100px; border-radius:50%; overflow:hidden; flex-shrink:0; background-image:url(\'' + photoUrl + '\'); background-size:cover; background-position:center; background-color:#e5e7eb;"></div>' +
            '<div style="flex:1;">' +
                '<h3 style="margin:0 0 8px 0; font-size:22px; font-weight:700; color:#1f2937;">' + prefix + ' ' + fullname + '</h3>' +
                '<p style="margin:0 0 4px 0; font-size:16px; font-weight:500; color:#6B2FA0;">' + discipline + '</p>' +
                (country ? '<p style="margin:0 0 4px 0; font-size:14px; color:#6b7280;"><i class="fa fa-globe" style="width:16px; margin-right:6px; color:#9ca3af;"></i>' + country + '</p>' : '') +
                (email ? '<p style="margin:0; font-size:14px; color:#6b7280;"><i class="fa fa-envelope" style="width:16px; margin-right:6px; color:#9ca3af;"></i>' + email + '</p>' : '') +
            '</div>' +
        '</div>' +
        '<div style="border-top:1px solid #e5e7eb; padding-top:16px;">' +
            '<h4 style="font-size:16px; font-weight:600; color:#1f2937; margin:0 0 12px 0;">Biography</h4>' +
            '<div id="bio-container"></div>' +
        '</div>';

    getBioQuill = null;
    getBioModal.classList.add("show");
    fetchEditorBio(fullname);
}

function closeModal() {
    if (getBioModal) getBioModal.classList.remove("show");
    getBioQuill = null;
}

if (getBioModal) {
    window.onclick = function (event) {
        if (event.target == getBioModal) closeModal();
    };
}
