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

// Include the career corner renderer component
include '../backend/partials/renderCareerCorner.php'; 
?>

<?php include '../components/header.php'; ?>
<?php include '../components/top-navbar.php'; ?>
<script src="https://cdn.tailwindcss.com"></script>

<style>
    .page-header {
        background: linear-gradient(135deg, #5a1f4e 0%, #7b306c 55%, #9b4c8a 100%);
        position: relative;
        overflow: hidden;
    }
    .page-header .overlay {
        padding: 80px 0;
        position: relative;
        z-index: 2;
    }
    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.05"><path fill="white" d="M20,50 L30,40 L40,50 L30,60 Z M60,30 L70,20 L80,30 L70,40 Z M70,70 L80,60 L90,70 L80,80 Z"/></svg>') repeat;
        pointer-events: none;
    }
    .page-header h2 {
        font-size: 42px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 15px;
        position: relative;
        display: inline-block;
    }
    .page-header h2:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: #ffbf00;
        border-radius: 3px;
    }
    .page-header p {
        font-size: 16px;
        color: rgba(255,255,255,0.85);
        margin-top: 20px;
    }
    .short-nav {
        margin-bottom: 20px;
    }
    .short-nav a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        font-size: 14px;
        transition: color 0.2s;
    }
    .short-nav a:hover {
        color: #ffbf00;
    }
    .short-nav span {
        color: rgba(255,255,255,0.5);
        margin: 0 8px;
        font-size: 12px;
    }
    
    /* Career Corner Intro Section */
    .career-intro {
        background: linear-gradient(135deg, #f8f5fc 0%, #fff 100%);
        border-bottom: 1px solid #e9ecef;
    }
    .intro-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border-left: 4px solid #ffbf00;
    }
    .intro-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #80078b, #5a1f4e);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }
    .intro-icon i {
        font-size: 28px;
        color: #ffbf00;
    }
    .intro-card h3 {
        font-size: 22px;
        font-weight: 700;
        color: #80078b;
        margin-bottom: 12px;
    }
    .intro-card p {
        font-size: 15px;
        color: #666;
        line-height: 1.6;
    }
    
    /* Quick Tips Section */
    .quick-tips {
        background: #fff;
    }
    .tip-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid #e9ecef;
    }
    .tip-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-color: #ffbf00;
    }
    .tip-icon {
        width: 50px;
        height: 50px;
        background: rgba(128,7,139,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
    }
    .tip-icon i {
        font-size: 24px;
        color: #80078b;
    }
    .tip-card h4 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    .tip-card p {
        font-size: 13px;
        color: #666;
        line-height: 1.5;
    }
    
    /* Featured Article Section */
    .featured-article {
        background: linear-gradient(135deg, #80078b 0%, #5a1f4e 100%);
        border-radius: 20px;
        overflow: hidden;
    }
    .featured-content {
        padding: 40px;
        color: white;
    }
    .featured-badge {
        display: inline-block;
        background: #ffbf00;
        color: #80078b;
        font-size: 12px;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 20px;
        margin-bottom: 15px;
    }
    .featured-content h3 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 15px;
    }
    .featured-content p {
        font-size: 15px;
        line-height: 1.6;
        margin-bottom: 20px;
        opacity: 0.9;
    }
    .featured-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: white;
        color: #80078b;
        padding: 10px 24px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    .featured-btn:hover {
        transform: translateX(5px);
        background: #ffbf00;
        color: #80078b;
    }
    .featured-image {
        height: 100%;
        min-height: 250px;
        background-size: cover;
        background-position: center;
        position: relative;
    }
    .featured-image::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, rgba(128,7,139,0.9) 0%, transparent 100%);
    }
    
    @media (max-width: 768px) {
        .page-header h2 {
            font-size: 28px;
        }
        .featured-content {
            padding: 30px;
        }
        .featured-content h3 {
            font-size: 22px;
        }
    }
</style>

<!-- Page Header -->
<section class="page-header">
    <div class="overlay">
        <div class="container">
            <div class="page-content text-center">
                <div class="short-nav">
                    <a href="https://asfirj.org/">Home</a>
                    <span>>>></span>
                    <a href="">Career Corner</a>
                </div>
                <h2>Prof. Nwaru's Career Corner</h2>
                <p class="w-20 xl:w-50 m-auto">Prof. Nwaru shares actionable insights, proven strategies, and practical advice to help you navigate your academic journey, master research skills, and build a thriving scientific career in Africa and beyond.</p>
            </div>
        </div>
    </div>
</section>

<!-- Quick Tips Section -->
<section class="quick-tips py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style="color: #80078b; font-size: 28px; font-weight: 700;">Quick Career Tips</h2>
            <div class="gold-line" style="width: 60px; height: 3px; background: #ffbf00; margin: 10px auto;"></div>
        </div>
        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-pen-fancy"></i>
                    </div>
                    <h4>Publish Strategically</h4>
                    <p>Focus on quality journals that align with your research impact goals</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h4>Build Networks</h4>
                    <p>Collaborate across disciplines and institutions for greater impact</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4>Master Grant Writing</h4>
                    <p>Learn to craft compelling proposals that secure funding</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h4>Continuous Learning</h4>
                    <p>Stay updated with latest research methodologies and tools</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Article Section -->
<?php
// Fetch featured article (most recent career corner article)
$featuredQuery = "SELECT buffer, manuscript_full_title, manuscript_file, date_published, date_uploaded, manuscriptPhoto, article_type 
                 FROM journals 
                 WHERE is_publication = 'yes' 
                 AND article_type = 'LEARNING CORNER' 
                 ORDER BY id DESC 
                 LIMIT 1";
$featuredResult = $con->query($featuredQuery);

if ($featuredResult && $featuredResult->num_rows > 0):
    $featured = $featuredResult->fetch_assoc();
    $featuredTitle = htmlspecialchars($featured['manuscript_full_title']);
    $featuredBuffer = htmlspecialchars($featured['buffer']);
    $featuredPhoto = $featured['manuscriptPhoto'] ?? null;
    $featuredImage = !empty($featuredPhoto) ? "https://asfirj.org/useruploads/article_images/" . $featuredPhoto : "https://res.cloudinary.com/dvm0bs013/image/upload/v1738234900/asfischolar_asbtdc.jpg";
?>
<!-- <section class="featured-section py-5">
    <div class="container">
        <div class="featured-article">
            <div class="row g-0">
                <div class="col-lg-7">
                    <div class="featured-content">
                        <span class="featured-badge"><i class="fas fa-star"></i> Featured Article</span>
                        <h3><?php echo $featuredTitle; ?></h3>
                        <p>Discover practical strategies and expert advice to accelerate your academic career and research impact.</p>
                        <a href="/content?sid=<?php echo $featuredBuffer; ?>" class="featured-btn">
                            Read Full Article <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="featured-image" style="background-image: url('<?php echo $featuredImage; ?>');"></div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<?php endif; ?>

<!-- Articles Listing Section -->
<main id="supplements" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style="color: #80078b; font-size: 28px; font-weight: 700;">All Career Resources</h2>
            <div class="gold-line" style="width: 60px; height: 3px; background: #ffbf00; margin: 10px auto;"></div>
            <p class="text-muted mt-3">Explore our collection of career development articles, research tips, and professional insights</p>
        </div>
        
        <div class="issueslay">
            <div id="articleListContainer" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php
                // Render career corner articles
                renderCareerCorner($con, $page, $filters);
                ?>
            </div>
        </div>
    </div>
</main>

<?php include '../components/footer.php'; ?>
    <script src="https://cdn.tailwindcss.com"></script>

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

<!-- Share Modal (same as before) -->
<style>
  #asfirj-share-modal {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.65);
    z-index: 2147483647;
    display: none;
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
        '<button class="asfirj-share-btn twitter" data-platform="twitter"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231z"/></svg>Twitter</button>' +
        '<button class="asfirj-share-btn facebook" data-platform="facebook"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>Facebook</button>' +
        '<button class="asfirj-share-btn linkedin" data-platform="linkedin"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065z"/></svg>LinkedIn</button>' +
        '<button class="asfirj-share-btn whatsapp" data-platform="whatsapp"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.277-.582c.948.552 2.046.846 3.054.846 3.18 0 5.767-2.586 5.768-5.766.001-3.18-2.585-5.767-5.768-5.767z"/></svg>WhatsApp</button>' +
        '<button class="asfirj-share-btn email" data-platform="email"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>Email</button>' +
        '<button class="asfirj-share-btn copy" data-platform="copy"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>Copy Link</button>' +
      '</div>' +
      '<div id="asfirj-share-link-row"><input id="asfirj-share-link-input" type="text" readonly /><button id="asfirj-copy-link-btn">Copy</button></div>' +
    '</div>';
  
  var toast = document.createElement('div');
  toast.id = 'asfirj-toast';
  
  document.addEventListener('DOMContentLoaded', function () {
    document.body.appendChild(modal);
    document.body.appendChild(toast);
    bindEvents();
  });
  
  var articleUrl = '', articleTitle = '';
  
  function openModal(id, title) {
    articleUrl = window.location.origin + '/content?sid=' + encodeURIComponent(id);
    articleTitle = title;
    document.getElementById('asfirj-share-subtitle').textContent = title;
    document.getElementById('asfirj-share-link-input').value = articleUrl;
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }
  
  function closeModal() {
    modal.style.display = 'none';
    document.body.style.overflow = '';
  }
  
  function share(platform) {
    var url = '';
    switch(platform) {
      case 'twitter': url = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(articleTitle) + '&url=' + encodeURIComponent(articleUrl); break;
      case 'facebook': url = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(articleUrl); break;
      case 'linkedin': url = 'https://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(articleUrl) + '&title=' + encodeURIComponent(articleTitle); break;
      case 'whatsapp': url = 'https://wa.me/?text=' + encodeURIComponent(articleTitle + ' ' + articleUrl); break;
      case 'email': url = 'mailto:?subject=' + encodeURIComponent(articleTitle) + '&body=' + encodeURIComponent('Check out this article:\n\n' + articleUrl); break;
      case 'copy': copyToClipboard(articleUrl); closeModal(); return;
    }
    if(url) { window.open(url, '_blank'); closeModal(); }
  }
  
  function copyToClipboard(text) {
    if(navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(text).then(function() { showToast('Link copied!'); }).catch(fallbackCopy.bind(null, text));
    } else { fallbackCopy(text); }
  }
  
  function fallbackCopy(text) {
    var ta = document.createElement('textarea');
    ta.value = text;
    ta.style.cssText = 'position:fixed;opacity:0;top:0;left:0';
    document.body.appendChild(ta);
    ta.focus(); ta.select();
    try { document.execCommand('copy'); showToast('Link copied!'); } catch(e) { showToast('Copy failed'); }
    document.body.removeChild(ta);
  }
  
  function showToast(msg) {
    toast.textContent = msg;
    toast.classList.add('show');
    setTimeout(function() { toast.classList.remove('show'); }, 2500);
  }
  
  function bindEvents() {
    document.body.addEventListener('click', function(e) {
      var btn = e.target.closest('.shareButton');
      if(btn) {
        e.preventDefault();
        openModal(btn.getAttribute('data-id'), btn.getAttribute('data-title'));
        return;
      }
      var platformBtn = e.target.closest('[data-platform]');
      if(platformBtn && modal.contains(platformBtn)) {
        share(platformBtn.getAttribute('data-platform'));
        return;
      }
      if(e.target === modal) closeModal();
    });
    document.getElementById('asfirj-share-close').addEventListener('click', closeModal);
    document.getElementById('asfirj-copy-link-btn').addEventListener('click', function() {
      copyToClipboard(document.getElementById('asfirj-share-link-input').value);
    });
    document.addEventListener('keydown', function(e) { if(e.key === 'Escape') closeModal(); });
  }
})();
</script>