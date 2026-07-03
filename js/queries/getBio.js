var getBioModal = document.getElementById("editorModal");
var getBioContent = getBioModal ? getBioModal.querySelector(".modal-content") : null;
var getBioQuill = null;

function fetchEditorBio(fullname) {
    fetch("./backend/editorsSections/getBio.php?name=" + encodeURIComponent(fullname), { method: "GET" })
        .then(function (res) { return res.json(); })
        .then(function (data) {
            if (data.status !== "success" || !data.editor || !data.editor[0]) return;
            var editor = data.editor[0];
            var quillContent = JSON.parse(editor.bio);
            if (!getBioContent) return;

            if (getBioQuill) {
                getBioQuill.setContents(quillContent);
            } else {
                var tempDiv = document.createElement("div");
                getBioQuill = new Quill(tempDiv, {
                    theme: "snow",
                    modules: { toolbar: false },
                    readOnly: true,
                });
                getBioQuill.setContents(quillContent);
                getBioContent.appendChild(tempDiv);
            }
        })
        .catch(function (err) {
            console.error("Failed to fetch editor bio:", err);
        });
}

function openModal(prefix, fullname, country, photo) {
    if (!getBioModal || !getBioContent) return;

    getBioContent.innerHTML =
        '<span class="close" onclick="closeModal()">&times;</span>' +
        '<div class="avatar" style="background-image: url(\'./useruploads/editors/' + photo + '\')"></div>' +
        '<div class="editor-info">' +
            '<h4>' + prefix + ' ' + fullname + '</h4>' +
        '</div>';

    getBioQuill = null;
    getBioModal.classList.add("show");
    fetchEditorBio(fullname);
}

function closeModal() {
    if (getBioModal) getBioModal.classList.remove("show");
}

if (getBioModal) {
    window.onclick = function (event) {
        if (event.target == getBioModal) closeModal();
    };
}
