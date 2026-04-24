<?php
include "../backend/db.php";

/**
 * Clean author name by removing numbers, extra spaces, and normalizing case
 * @param string $name The raw author name
 * @return string Cleaned author name
 */
function cleanAuthorName($name) {
    // First, trim the name
    $cleaned = trim($name);
    
    // Remove numbers and special characters at the end (e.g., "Eman Sobh-", "Eman Sobh 3")
    // This handles trailing hyphens, numbers, and other special chars
    $cleaned = preg_replace('/[\s\-\.\,]*[\d\-\_]+$/', '', $cleaned);
    
    // Remove any remaining special characters but keep letters, spaces, hyphens, dots, commas, apostrophes
    // Allow hyphens only when they're between letters (e.g., "Jean-Luc")
    $cleaned = preg_replace('/[^a-zA-Z\s\-\'\.\,]/', '', $cleaned);
    
    // Remove leading/trailing hyphens and spaces
    $cleaned = trim($cleaned, '- ');
    
    // Normalize multiple spaces and hyphens
    $cleaned = preg_replace('/[\s\-]+/', ' ', $cleaned);
    
    // Remove spaces before/after hyphens (e.g., "Jean - Luc" -> "Jean-Luc")
    $cleaned = preg_replace('/\s*-\s*/', '-', $cleaned);
    
    // Convert to proper case (capitalize first letter of each word)
    $cleaned = mb_convert_case($cleaned, MB_CASE_TITLE, 'UTF-8');
    
    // Handle special cases like "Jean-Luc" (keep the hyphenated capitalization)
    $cleaned = preg_replace_callback('/\b\w+-\w+\b/', function($matches) {
        return $matches[0]; // Keep as is since mb_convert_case already handled it
    }, $cleaned);
    
    return $cleaned;
}

/**
 * Get unique authors with deduplication logic
 * Groups similar names (e.g., "Eman Sobh", "Eman Sobh3-2", "EMAN SOBH 3", "Eman Sobh-" all become "Eman Sobh")
 */
function getUniqueAuthors($con, $publicationType = null) {
    // Build query based on publication type
    $query = "SELECT DISTINCT a.authors_fullname 
              FROM authors a
              INNER JOIN journals j ON a.article_id = j.buffer";
    
    if ($publicationType === 'issues') {
        $query .= " WHERE j.is_publication = 'yes'";
    } elseif ($publicationType === 'supplements') {
        $query .= " WHERE j.is_publication = 'no'";
    }
    
    $query .= " AND a.authors_fullname IS NOT NULL 
                AND a.authors_fullname != '' 
                ORDER BY a.authors_fullname ASC";
    
    $result = mysqli_query($con, $query);
    
    if (!$result || mysqli_num_rows($result) === 0) {
        return [];
    }
    
    // Array to store cleaned names
    $authorMap = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $originalName = $row['authors_fullname'];
        $cleanedName = cleanAuthorName($originalName);
        
        if (empty($cleanedName)) {
            continue;
        }
        
        $lowercaseKey = preg_replace('/\s+/', ' ', strtolower(trim($cleanedName)));
        
        if (!isset($authorMap[$lowercaseKey])) {
            $authorMap[$lowercaseKey] = $cleanedName;
        }
    }
    
    $uniqueAuthors = array_values($authorMap);
    usort($uniqueAuthors, function($a, $b) {
        return strnatcasecmp($a, $b);
    });
    
    return $uniqueAuthors;
}

/**
 * Get unique article types based on publication type
 */
function getArticleTypes($con, $publicationType = null) {
    $query = "SELECT DISTINCT article_type 
              FROM journals 
              WHERE article_type IS NOT NULL 
              AND article_type != ''";
    
    if ($publicationType === 'issues') {
        $query .= " AND is_publication = 'yes'";
    } elseif ($publicationType === 'supplements') {
        $query .= " AND is_publication = 'no'";
    }
    
    $query .= " ORDER BY article_type ASC";
    
    $result = mysqli_query($con, $query);
    $types = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($type = mysqli_fetch_assoc($result)) {
            $types[] = $type['article_type'];
        }
    }
    
    return $types;
}

/**
 * Get available years based on publication type
 */
function getAvailableYears($con, $publicationType = null) {
    $query = "SELECT DISTINCT YEAR(date_published) as year 
              FROM journals 
              WHERE date_published IS NOT NULL";
    
    if ($publicationType === 'issues') {
        $query .= " AND is_publication = 'yes'";
    } elseif ($publicationType === 'supplements') {
        $query .= " AND is_publication = 'no'";
    }
    
    $query .= " ORDER BY year DESC";
    
    $result = mysqli_query($con, $query);
    $years = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($year = mysqli_fetch_assoc($result)) {
            $years[] = $year['year'];
        }
    }
    
    return $years;
}

// Determine active tab (default to 'supplements' for this page)
$activeTab = isset($_GET['tab']) && $_GET['tab'] === 'issues' ? 'issues' : 'supplements';

// Fetch data based on active tab
$authorsList = getUniqueAuthors($con, $activeTab);
$typesList = getArticleTypes($con, $activeTab);
$yearsList = getAvailableYears($con, $activeTab);
?>

<!-- Filter Section - Tailwind Styled -->
<section class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-5">
                <form id="searchArticle" method="GET" action="../search" role="search">
                    <!-- Row 1: Filters -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                        <input type="hidden" name="tab" id="activeTab" value="<?php echo $activeTab; ?>">
                        
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search Title or Author</label>
                            <input type="text" name="k" id="search" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-sm"
                                   value="<?php echo isset($_GET['k']) ? htmlspecialchars($_GET['k'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
                                   placeholder="Enter title or author name..."
                                   aria-label="Search articles">
                        </div>

                        <div>
                            <label for="authorsOption" class="block text-sm font-medium text-gray-700 mb-1">Author</label>
                            <select name="author" id="authorsOption" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-sm bg-white"
                                    aria-label="Filter by author">
                                <option value="">All Authors</option>
                                <?php foreach ($authorsList as $author): ?>
                                    <option value="<?php echo htmlspecialchars($author, ENT_QUOTES, 'UTF-8'); ?>" <?php echo (isset($_GET['author']) && $_GET['author'] == $author) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($author, ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label for="articleType" class="block text-sm font-medium text-gray-700 mb-1">Article Type</label>
                            <select name="type" id="articleType" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-sm bg-white"
                                    aria-label="Filter by article type">
                                <option value="">All Types</option>
                                <?php foreach ($typesList as $type): ?>
                                    <option value="<?php echo htmlspecialchars($type, ENT_QUOTES, 'UTF-8'); ?>" <?php echo (isset($_GET['type']) && $_GET['type'] == $type) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($type, ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label for="yearFilter" class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                            <select name="year" id="yearFilter" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-sm bg-white"
                                    aria-label="Filter by year">
                                <option value="">All Years</option>
                                <?php foreach ($yearsList as $year): ?>
                                    <option value="<?php echo $year; ?>" <?php echo (isset($_GET['year']) && $_GET['year'] == $year) ? 'selected' : ''; ?>>
                                        <?php echo $year; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" 
                                    id="filterButton"
                                    class="flex-1 mt-6 px-4 py-2 bg-purple-700 hover:bg-purple-800 text-white text-sm font-medium rounded-lg transition-colors flex items-center justify-center gap-2"
                                    aria-label="Apply filters">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                </svg>
                                Filter
                            </button>
                            
                            <button type="button" 
                                    id="resetButton"
                                    class="flex-1 mt-6 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors flex items-center justify-center gap-2"
                                    aria-label="Reset all filters">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Reset
                            </button>
                        </div>
                    </div>

                    <!-- Row 2: Issues/Supplements Navigation Tabs -->
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-6 pt-5 border-t border-gray-200">
                        <div class="bg-gray-100 rounded-lg p-1 flex" role="tablist">
                            <button type="button" 
                                    id="issuesTab"
                                    data-tab="issues"
                                    class="tab-button inline-block px-5 py-2 text-sm font-medium rounded-md transition-all <?php echo $activeTab === 'issues' ? 'bg-purple-700 text-white shadow-sm' : 'text-gray-600 hover:text-purple-700'; ?>"
                                    role="tab"
                                    aria-selected="<?php echo $activeTab === 'issues' ? 'true' : 'false'; ?>">
                                Issues
                            </button>
                            <button type="button" 
                                    id="supplementsTab"
                                    data-tab="supplements"
                                    class="tab-button inline-block px-5 py-2 text-sm font-medium rounded-md transition-all <?php echo $activeTab === 'supplements' ? 'bg-purple-700 text-white shadow-sm' : 'text-gray-600 hover:text-purple-700'; ?>"
                                    role="tab"
                                    aria-selected="<?php echo $activeTab === 'supplements' ? 'true' : 'false'; ?>">
                                Supplements
                            </button>
                        </div>
                        
                        <div class="text-sm text-gray-500" id="tabDescription">
                            <?php echo $activeTab === 'issues' ? 'Showing issues (standard publications)' : 'Showing supplements (conference proceedings, special issues, etc.)'; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
    /* Override any conflicting styles */
    .bg-purple-700 {
        background-color: #80078b;
    }
    .bg-purple-800 {
        background-color: #5a1f4e;
    }
    .focus\:ring-purple-500:focus {
        --tw-ring-color: #80078b;
    }
    .focus\:border-purple-500:focus {
        border-color: #80078b;
    }
    
    /* Custom select arrow */
    select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
        background-position: right 0.75rem center;
        background-repeat: no-repeat;
        background-size: 1.25rem;
        padding-right: 2.5rem;
    }
    
    /* Mobile responsive adjustments */
    @media (max-width: 640px) {
        .grid {
            gap: 1rem;
        }
        button, .reset-button {
            margin-top: 0;
        }
        .flex-col.sm\:flex-row {
            flex-direction: column;
        }
    }
    
    /* Focus styles for accessibility */
    *:focus-visible {
        outline: 2px solid #80078b;
        outline-offset: 2px;
    }
    
    /* Loading state */
    .tab-button.loading {
        opacity: 0.6;
        cursor: wait;
    }
    
    /* Smooth transitions */
    .tab-button {
        transition: all 0.2s ease;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const yearFilter = document.getElementById('yearFilter');
        const articleType = document.getElementById('articleType');
        const authorSelect = document.getElementById('authorsOption');
        const searchInput = document.getElementById('search');
        const filterButton = document.getElementById('filterButton');
        const resetButton = document.getElementById('resetButton');
        const activeTabInput = document.getElementById('activeTab');
        const tabDescription = document.getElementById('tabDescription');
        
        // Tab switching functionality
        const issuesTab = document.getElementById('issuesTab');
        const supplementsTab = document.getElementById('supplementsTab');
        const tabButtons = document.querySelectorAll('.tab-button');
        
        // Function to update filters based on tab
        async function switchTab(tab) {
            // Update active tab input
            activeTabInput.value = tab;
            
            // Update URL without reload
            const url = new URL(window.location.href);
            url.searchParams.set('tab', tab);
            url.searchParams.delete('page'); // Reset to page 1 when switching tabs
            window.history.pushState({}, '', url);
            
            // Show loading state on buttons
            tabButtons.forEach(btn => {
                btn.classList.add('loading');
            });
            
            try {
                // Fetch new filter options via AJAX
                const response = await fetch(`../backend/get_filter_options.php?tab=${tab}`);
                const data = await response.json();
                
                if (data.success) {
                    // Update author dropdown
                    updateSelectOptions('authorsOption', data.authors, authorSelect.value);
                    
                    // Update article type dropdown
                    updateSelectOptions('articleType', data.types, articleType.value);
                    
                    // Update year dropdown
                    updateSelectOptions('yearFilter', data.years, yearFilter.value);
                    
                    // Update description text
                    tabDescription.textContent = tab === 'issues' 
                        ? 'Showing regular issues (standard publications)' 
                        : 'Showing supplements (conference proceedings, special issues, etc.)';
                    
                    // Submit the form to reload articles
                    document.getElementById('searchArticle').submit();
                }
            } catch (error) {
                console.error('Error switching tabs:', error);
                // Fallback: just submit the form
                document.getElementById('searchArticle').submit();
            } finally {
                // Remove loading state
                tabButtons.forEach(btn => {
                    btn.classList.remove('loading');
                });
            }
        }
        
        // Helper function to update select dropdowns
        function updateSelectOptions(selectId, options, currentValue) {
            const select = document.getElementById(selectId);
            if (!select) return;
            
            const oldValue = currentValue || select.value;
            select.innerHTML = '<option value="">All</option>';
            
            options.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option;
                optionElement.textContent = option;
                if (option === oldValue) {
                    optionElement.selected = true;
                }
                select.appendChild(optionElement);
            });
        }
        
        // Tab click handlers
        if (issuesTab) {
            issuesTab.addEventListener('click', function(e) {
                e.preventDefault();
                const currentTab = activeTabInput.value;
                if (currentTab !== 'issues') {
                    switchTab('issues');
                }
            });
        }
        
        if (supplementsTab) {
            supplementsTab.addEventListener('click', function(e) {
                e.preventDefault();
                const currentTab = activeTabInput.value;
                if (currentTab !== 'supplements') {
                    switchTab('supplements');
                }
            });
        }
        
        // Function to submit form
        function submitForm() {
            document.getElementById('searchArticle').submit();
        }
        
        // Auto-submit when filters change
        if (yearFilter) {
            yearFilter.addEventListener('change', submitForm);
        }
        
        if (articleType) {
            articleType.addEventListener('change', submitForm);
        }
        
        if (authorSelect) {
            authorSelect.addEventListener('change', submitForm);
        }
        
        // Reset button functionality
        if (resetButton) {
            resetButton.addEventListener('click', function() {
                // Clear all form inputs
                if (searchInput) searchInput.value = '';
                if (authorSelect) authorSelect.value = '';
                if (articleType) articleType.value = '';
                if (yearFilter) yearFilter.value = '';
                
                // Submit the form
                submitForm();
            });
        }
        
        // Handle browser back/forward buttons
        window.addEventListener('popstate', function() {
            location.reload();
        });
    });
</script>