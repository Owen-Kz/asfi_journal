<?php
// Include necessary files
include '../backend/db.php';
include '../backend/authorsSearchSlider.php';

// Collect filters
$filters = [
    'search' => isset($_GET['k']) ? trim($_GET['k']) : null,
    'author' => isset($_GET['author']) ? trim($_GET['author']) : null,
    'type' => isset($_GET['type']) ? trim($_GET['type']) : null
];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Include the supplements renderer component
include '../backend/partials/renderSupplements.php';
?>

<?php include '../components/header.php'; ?>
<?php include '../components/top-navbar.php'; ?>
<?php include '../components/page-header-supplements.php'; ?>

<main id="supplements">
    <?php include '../components/filter-section.php'; ?>
    <script src="https://cdn.tailwindcss.com"></script>
    

    <div class="issueslay" style="display: flex; gap: 30px; padding: 40px;">
        <section class="bd-bottom padding">
            <div id="articleListContainer" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php
                // Render supplements with filters (is_publication = 'no' for supplements)
                renderSupplements($con, $page, $filters);
                ?>
            </div>
        </section>
        
        
    </div>
</main>

<?php include '../components/footer.php'; ?>

<script>
// Toggle format links function
window.toggleFormatLinks = function(button) {
    const formatLinks = button.nextElementSibling;
    if (formatLinks.style.display === 'none' || formatLinks.style.display === '') {
        formatLinks.style.display = 'block';
        button.textContent = 'Hide Options ▲';
    } else {
        formatLinks.style.display = 'none';
        button.textContent = 'Show Options ▼';
    }
};

// Initialize format links to be hidden
document.querySelectorAll('.format-links').forEach(links => {
    links.style.display = 'none';
});

// Year filter
document.getElementById('yearFilter')?.addEventListener('change', function() {
    const year = this.value;
    const currentUrl = new URL(window.location.href);
    
    if (year) {
        currentUrl.searchParams.set('year', year);
    } else {
        currentUrl.searchParams.delete('year');
    }
    
    window.location.href = currentUrl.toString();
});
</script>

<!-- ═══════════════════════════════════════════════════════════
     SHARE MODAL — built entirely with inline styles so it is
     100% immune to Tailwind's  display:none !important  and to
     Bootstrap / any other CSS on the page.
     The modal div is injected directly on <body> so it can never
     be clipped by an  overflow:hidden  ancestor.
════════════════════════════════════════════════════════════════ -->
<style>
  /* Only non-Tailwind rules needed for the modal */
  #asfirj-share-modal {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.65);
    z-index: 2147483647;   /* Maximum possible z-index */
    display: none;         /* toggled via JS style.display only */
    align-items: center;
    justify-content: center;
    padding: 16px;
    box-sizing: border-box;
  }
  #asfirj-share-modal.open { display: flex; }

  #asfirj-share-inner {
    background: #fff;
    border-radius: 14px;
    width: 100%;
    max-width: 440px;
    padding: 28px 24px 24px;
    position: relative;
    box-shadow: 0 24px 48px rgba(0,0,0,.18);
    box-sizing: border-box;
  }

  #asfirj-share-close {
    position: absolute;
    top: 14px; right: 14px;
    background: #f3f4f6;
    border: none;
    border-radius: 50%;
    width: 32px; height: 32px;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    color: #6b7280;
    font-size: 18px;
    line-height: 1;
    transition: background .15s;
  }
  #asfirj-share-close:hover { background: #e5e7eb; }

  #asfirj-share-modal h3 {
    font-size: 18px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 6px;
  }
  #asfirj-share-modal p {
    font-size: 13px;
    color: #6b7280;
    margin: 0 0 18px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .asfirj-share-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-bottom: 16px;
  }
  .asfirj-share-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 14px;
    border: none;
    border-radius: 9px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    color: #fff;
    transition: opacity .15s, transform .1s;
  }
  .asfirj-share-btn:hover  { opacity: .88; }
  .asfirj-share-btn:active { transform: scale(.97); }
  .asfirj-share-btn.full   { grid-column: span 2; }

  .asfirj-share-btn.twitter  { background: #1d9bf0; }
  .asfirj-share-btn.facebook { background: #1877f2; }
  .asfirj-share-btn.linkedin { background: #0a66c2; }
  .asfirj-share-btn.whatsapp { background: #25d366; }
  .asfirj-share-btn.email    { background: #7b306c; }
  .asfirj-share-btn.copy     { background: #374151; }

  #asfirj-share-link-row {
    display: flex;
    gap: 8px;
    align-items: center;
    margin-top: 4px;
  }
  #asfirj-share-link-input {
    flex: 1;
    padding: 8px 10px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 13px;
    background: #f9fafb;
    color: #374151;
    outline: none;
  }
  #asfirj-copy-link-btn {
    padding: 8px 14px;
    background: #7b306c;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    white-space: nowrap;
    transition: opacity .15s;
  }
  #asfirj-copy-link-btn:hover { opacity: .88; }

  #asfirj-toast {
    position: fixed;
    bottom: 28px;
    left: 50%;
    transform: translateX(-50%);
    background: #111827;
    color: #fff;
    padding: 10px 22px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    z-index: 2147483647;
    pointer-events: none;
    opacity: 0;
    transition: opacity .25s;
  }
  #asfirj-toast.show { opacity: 1; }
</style>

<script>
(function () {
  /* ── Build modal DOM once ─────────────────────────────────── */
  var modal = document.createElement('div');
  modal.id = 'asfirj-share-modal';
  modal.setAttribute('role', 'dialog');
  modal.setAttribute('aria-modal', 'true');
  modal.innerHTML =
    '<div id="asfirj-share-inner">' +
      '<button id="asfirj-share-close" aria-label="Close">&times;</button>' +
      '<h3>Share Article</h3>' +
      '<p id="asfirj-share-subtitle"></p>' +
      '<div class="asfirj-share-grid">' +
        '<button class="asfirj-share-btn twitter"  data-platform="twitter">' +
          '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>' +
          'Twitter' +
        '</button>' +
        '<button class="asfirj-share-btn facebook" data-platform="facebook">' +
          '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>' +
          'Facebook' +
        '</button>' +
        '<button class="asfirj-share-btn linkedin" data-platform="linkedin">' +
          '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451c.979 0 1.771-.773 1.771-1.729V1.729C24 .774 23.205 0 22.225 0z"/></svg>' +
          'LinkedIn' +
        '</button>' +
        '<button class="asfirj-share-btn whatsapp" data-platform="whatsapp">' +
          '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.277-.582c.948.552 2.046.846 3.054.846 3.18 0 5.767-2.586 5.768-5.766.001-3.18-2.585-5.767-5.768-5.767zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.068-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.938-.708-1.791 0-.852.448-1.27.608-1.444.159-.174.347-.218.463-.218h.324c.116 0 .3-.015.463.348.163.362.52 1.259.566 1.349.047.09.075.193.018.31-.058.118-.099.189-.189.302-.089.113-.187.26-.269.35-.089.1-.182.208-.078.407.104.199.464.766.996 1.24.685.61 1.262.796 1.44.886.178.09.283.074.386-.045.104-.119.448-.524.567-.704.119-.18.239-.151.401-.09.162.06 1.034.488 1.212.576.178.088.296.13.34.204.045.075.045.433-.099.838z"/></svg>' +
          'WhatsApp' +
        '</button>' +
        '<button class="asfirj-share-btn email" data-platform="email">' +
          '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>' +
          'Email' +
        '</button>' +
        '<button class="asfirj-share-btn copy" data-platform="copy">' +
          '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>' +
          'Copy Link' +
        '</button>' +
      '</div>' +
      '<div id="asfirj-share-link-row">' +
        '<input id="asfirj-share-link-input" type="text" readonly />' +
        '<button id="asfirj-copy-link-btn">Copy</button>' +
      '</div>' +
    '</div>';

  /* Toast element */
  var toast = document.createElement('div');
  toast.id = 'asfirj-toast';

  /* Append both to body immediately (not waiting for DOMContentLoaded
     so they are always in the DOM when the user clicks) */
  document.addEventListener('DOMContentLoaded', function () {
    document.body.appendChild(modal);
    document.body.appendChild(toast);
    bindEvents();
  });

  /* ── State ───────────────────────────────────────────────── */
  var articleUrl   = '';
  var articleTitle = '';

  /* ── Open / Close ────────────────────────────────────────── */
  function openModal(id, title) {
    articleUrl   = window.location.origin + '/content?sid=' + encodeURIComponent(id);
    articleTitle = title;

    document.getElementById('asfirj-share-subtitle').textContent = title;
    document.getElementById('asfirj-share-link-input').value = articleUrl;

    /* Use style.display directly — completely bypasses Tailwind hidden / Bootstrap */
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    modal.style.display = 'none';
    document.body.style.overflow = '';
  }

  /* ── Share platforms ─────────────────────────────────────── */
  function share(platform) {
    var url = '';
    switch (platform) {
      case 'twitter':
        url = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(articleTitle) + '&url=' + encodeURIComponent(articleUrl);
        break;
      case 'facebook':
        url = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(articleUrl);
        break;
      case 'linkedin':
        url = 'https://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(articleUrl) + '&title=' + encodeURIComponent(articleTitle);
        break;
      case 'whatsapp':
        url = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(articleTitle + ' ' + articleUrl);
        break;
      case 'email':
        url = 'mailto:?subject=' + encodeURIComponent(articleTitle) + '&body=' + encodeURIComponent('Check out this article:\n\n' + articleUrl);
        break;
      case 'copy':
        copyToClipboard(articleUrl);
        closeModal();
        return;
    }
    if (url) { window.open(url, '_blank', 'noopener,noreferrer,width=600,height=450'); closeModal(); }
  }

  /* ── Clipboard helper ────────────────────────────────────── */
  function copyToClipboard(text) {
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(text).then(function () { showToast('Link copied!'); }).catch(fallbackCopy.bind(null, text));
    } else {
      fallbackCopy(text);
    }
  }
  function fallbackCopy(text) {
    var ta = document.createElement('textarea');
    ta.value = text;
    ta.style.cssText = 'position:fixed;opacity:0;top:0;left:0';
    document.body.appendChild(ta);
    ta.focus(); ta.select();
    try { document.execCommand('copy'); showToast('Link copied!'); } catch(e) { showToast('Copy failed — please copy manually.'); }
    document.body.removeChild(ta);
  }

  /* ── Toast ───────────────────────────────────────────────── */
  function showToast(msg) {
    toast.textContent = msg;
    toast.classList.add('show');
    setTimeout(function () { toast.classList.remove('show'); }, 2500);
  }

  /* ── Event bindings ──────────────────────────────────────── */
  function bindEvents() {
    /* Open: delegated click on any .shareButton anywhere on page */
    document.body.addEventListener('click', function (e) {
      var btn = e.target.closest('.shareButton');
      if (btn) {
        e.preventDefault();
        e.stopPropagation();
        openModal(
          btn.getAttribute('data-id'),
          btn.getAttribute('data-title')
        );
        return;
      }

      /* Platform buttons inside modal */
      var platformBtn = e.target.closest('[data-platform]');
      if (platformBtn && modal.contains(platformBtn)) {
        share(platformBtn.getAttribute('data-platform'));
        return;
      }

      /* Backdrop click closes */
      if (e.target === modal) { closeModal(); }
    });

    /* Close button */
    document.getElementById('asfirj-share-close').addEventListener('click', closeModal);

    /* Copy button in link row */
    document.getElementById('asfirj-copy-link-btn').addEventListener('click', function () {
      copyToClipboard(document.getElementById('asfirj-share-link-input').value);
    });

    /* Escape key */
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeModal();
    });
  }
})();
</script>