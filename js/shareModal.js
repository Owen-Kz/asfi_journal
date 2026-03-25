// Share Modal Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Share button click handler
    document.body.addEventListener('click', function(e) {
        if (e.target.classList.contains('shareButton')) {
            const articleId = e.target.getAttribute('data-id');
            const modal = document.getElementById(`shareModal_${articleId}`);
            
            if (modal) {
                modal.style.display = 'block';
                // Add overlay
                const overlay = document.createElement('div');
                overlay.id = 'modalOverlay';
                overlay.style.position = 'fixed';
                overlay.style.top = '0';
                overlay.style.left = '0';
                overlay.style.width = '100%';
                overlay.style.height = '100%';
                overlay.style.backgroundColor = 'rgba(0,0,0,0.5)';
                overlay.style.zIndex = '9999';
                document.body.appendChild(overlay);
            }
        }
    });
    
    // Close modal handler
    document.body.addEventListener('click', function(e) {
        if (e.target.classList.contains('close-modal')) {
            const articleId = e.target.getAttribute('data-id');
            const modal = document.getElementById(`shareModal_${articleId}`);
            if (modal) {
                modal.style.display = 'none';
                // Remove overlay
                const overlay = document.getElementById('modalOverlay');
                if (overlay) overlay.remove();
            }
        }
    });
    
    // Click outside modal to close
    document.body.addEventListener('click', function(e) {
        if (e.target.id === 'modalOverlay') {
            const modals = document.querySelectorAll('[id^="shareModal_"]');
            modals.forEach(modal => {
                modal.style.display = 'none';
            });
            const overlay = document.getElementById('modalOverlay');
            if (overlay) overlay.remove();
        }
    });
    
    // Share option click handler
    document.body.addEventListener('click', function(e) {
        if (e.target.classList.contains('shareOption')) {
            const platform = e.target.getAttribute('data-platform');
            const articleId = e.target.getAttribute('data-id');
            const articleTitle = e.target.getAttribute('data-title');
            const articleUrl = `${window.location.origin}/content?sid=${articleId}`;
            
            let shareUrl = '';
            
            switch(platform) {
                case 'asfischolar':
                    shareUrl = `https://asfischolar.org/share?url=${encodeURIComponent(articleUrl)}&title=${encodeURIComponent(articleTitle)}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(articleTitle)}&url=${encodeURIComponent(articleUrl)}`;
                    break;
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(articleUrl)}`;
                    break;
                case 'linkedin':
                    shareUrl = `https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(articleUrl)}&title=${encodeURIComponent(articleTitle)}`;
                    break;
                case 'whatsapp':
                    shareUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(articleTitle)} ${encodeURIComponent(articleUrl)}`;
                    break;
                case 'copy':
                    navigator.clipboard.writeText(articleUrl).then(() => {
                        alert('Link copied to clipboard!');
                    }).catch(err => {
                        console.error('Failed to copy:', err);
                        alert('Failed to copy link');
                    });
                    
                    // Close modal after copy
                    const modal = document.getElementById(`shareModal_${articleId}`);
                    if (modal) modal.style.display = 'none';
                    const overlay = document.getElementById('modalOverlay');
                    if (overlay) overlay.remove();
                    return;
                default:
                    return;
            }
            
            if (shareUrl) {
                window.open(shareUrl, '_blank', 'width=600,height=400');
            }
            
            // Close modal after sharing
            const modal = document.getElementById(`shareModal_${articleId}`);
            if (modal) modal.style.display = 'none';
            const overlay = document.getElementById('modalOverlay');
            if (overlay) overlay.remove();
        }
    });
    
    // Hover effects for share options
    document.body.addEventListener('mouseover', function(e) {
        if (e.target.classList.contains('shareOption')) {
            e.target.style.backgroundColor = '#f5f5f5';
        }
    });
    
    document.body.addEventListener('mouseout', function(e) {
        if (e.target.classList.contains('shareOption')) {
            e.target.style.backgroundColor = 'transparent';
        }
    });
});