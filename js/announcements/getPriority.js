/**
 * Fetch announcements with retry logic
 */
class AnnouncementFetcher {
    constructor(containerId, options = {}) {
        this.container = document.getElementById(containerId);
        this.options = {
            retries: 3,
            retryDelay: 1000,
            timeout: 10000,
            priority: '1',
            ...options
        };
        
        if (!this.container) {
            console.warn(`Container with id "${containerId}" not found`);
            return;
        }
        
        this.init();
    }
    
    init() {
        this.showLoading();
        this.fetchWithRetry();
    }
    
    async fetchWithRetry(retryCount = 0) {
        try {
            const data = await this.fetchAnnouncements();
            this.renderAnnouncements(data);
        } catch (error) {
            if (retryCount < this.options.retries) {
                console.log(`Retry attempt ${retryCount + 1}/${this.options.retries}`);
                setTimeout(() => {
                    this.fetchWithRetry(retryCount + 1);
                }, this.options.retryDelay * (retryCount + 1));
            } else {
                this.showError(`Failed to load after ${this.options.retries} attempts. Please try again later.`);
            }
        }
    }
    
    async fetchAnnouncements() {
        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(), this.options.timeout);
        
        try {
            const response = await fetch(`https://asfirj.org/backend/announcement/retrieve.php?priority=${this.options.priority}`, {
                signal: controller.signal,
                headers: { 'Accept': 'application/json' }
            });
            
            clearTimeout(timeoutId);
            
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }
            
            const data = await response.json();
            return Array.isArray(data) ? data : (data.data || []);
            
        } catch (error) {
            clearTimeout(timeoutId);
            throw error;
        }
    }
    
    renderAnnouncements(announcements) {
        if (!this.container) return;
        
        if (announcements && announcements.length > 0) {
            const fragment = document.createDocumentFragment();
            announcements.forEach(announcement => {
                fragment.appendChild(this.createAnnouncementElement(announcement));
            });
            this.container.innerHTML = '';
            this.container.appendChild(fragment);
        } else {
            this.showEmpty();
        }
    }
    
    createAnnouncementElement(announcement) {
        const div = document.createElement('div');
        div.className = 'announcement mb-4';
        
        const title = this.escapeHtml(announcement.title || 'Untitled');
        const slug = this.escapeHtml(announcement.slug || '#');
        let content = this.escapeHtml(announcement.data || announcement.content || '');
        content = content.trim();
        
        const preview = content.length > 100 ? content.substring(0, 100).trim() + '...' : content || 'No description available.';
        
        div.innerHTML = `
            <a href="/announcement?x=${slug}" class="block group max-w-xl mx-auto bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
                <h3 class="text-lg font-semibold text-purple-700 group-hover:text-purple-800 group-hover:underline transition-colors">
                    ${title}
                </h3>
                <p class="text-gray-600 mt-2 line-clamp-3 leading-relaxed">
                    ${preview}
                </p>
                <div class="mt-4 flex items-center text-sm text-purple-600 group-hover:text-purple-800 group-hover:translate-x-1 transition-all">
                    <span>Read more</span>
                    <svg class="w-4 h-4 ml-1 group-hover:ml-2 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </a>
        `;
        
        return div;
    }
    
    escapeHtml(str) {
        if (!str) return '';
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }
    
    showLoading() {
        if (!this.container) return;
        this.container.innerHTML = `
            <div class="flex justify-center items-center py-8">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-purple-700"></div>
                <span class="ml-3 text-gray-600">Loading announcements...</span>
            </div>
        `;
    }
    
    showEmpty() {
        if (!this.container) return;
        this.container.innerHTML = `
            <div class="text-center py-12 bg-gray-50 rounded-xl">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">No announcements found</h3>
                <p class="text-sm text-gray-500">Check back later for new announcements.</p>
            </div>
        `;
    }
    
    showError(message) {
        if (!this.container) return;
        this.container.innerHTML = `
            <div class="text-center py-12 bg-red-50 rounded-xl">
                <svg class="w-16 h-16 mx-auto text-red-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-red-700 mb-2">Unable to load announcements</h3>
                <p class="text-sm text-red-600">${message}</p>
                <button onclick="location.reload()" class="mt-4 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Try Again
                </button>
            </div>
        `;
    }
}

// Usage
// Replace the existing code with:
const fetcher = new AnnouncementFetcher('announcement-container', {
    priority: '1',
    retries: 3,
    retryDelay: 1000,
    timeout: 10000
});