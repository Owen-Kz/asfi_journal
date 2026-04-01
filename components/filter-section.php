<?php
include "../backend/db.php";

// Fetch unique authors
$authorsList = [];
$authorsQuery = "SELECT DISTINCT authors_fullname FROM authors ORDER BY authors_fullname ASC";
$authorsResult = mysqli_query($con, $authorsQuery);
if ($authorsResult && mysqli_num_rows($authorsResult) > 0) {
    while ($author = mysqli_fetch_assoc($authorsResult)) {
        $authorsList[] = $author['authors_fullname'];
    }
}

// Fetch unique article types from journals
$typesList = [];
$typesQuery = "SELECT DISTINCT article_type FROM journals WHERE article_type IS NOT NULL AND article_type != '' ORDER BY article_type ASC";
$typesResult = mysqli_query($con, $typesQuery);
if ($typesResult && mysqli_num_rows($typesResult) > 0) {
    while ($type = mysqli_fetch_assoc($typesResult)) {
        $typesList[] = $type['article_type'];
    }
}
?>

<!-- Filter Section - Tailwind Styled -->
<section class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-5">
                <form id="searchArticle" method="GET" action="">
                    <!-- Row 1: Filters -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Search Journal</label>
                            <input type="text" name="k" id="search" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-sm"
                                   value="<?php echo isset($_GET['k']) ? htmlspecialchars($_GET['k']) : ''; ?>" 
                                   placeholder="Enter journal title...">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Author</label>
                            <select name="author" id="authorsOption" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-sm bg-white">
                                <option value="">All Authors</option>
                                <?php foreach ($authorsList as $author): ?>
                                    <option value="<?php echo htmlspecialchars($author); ?>" <?php echo (isset($_GET['author']) && $_GET['author'] == $author) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($author); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Article Type</label>
                            <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-sm bg-white">
                                <option value="">All Types</option>
                                <?php foreach ($typesList as $type): ?>
                                    <option value="<?php echo htmlspecialchars($type); ?>" <?php echo (isset($_GET['type']) && $_GET['type'] == $type) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($type); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <input type="hidden" name="page" value="1">
                            <button type="submit" 
                                    class="w-full mt-6 px-4 py-2 bg-purple-700 hover:bg-purple-800 text-white text-sm font-medium rounded-lg transition-colors flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                Filter
                            </button>
                        </div>

                        <div>
                            <a href="?" 
                               class="w-full mt-6 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Reset
                            </a>
                        </div>
                    </div>

                    <!-- Row 2: Issues/Supplements Navigation + Year Filter - Mobile Responsive (Simple Fix) -->
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-6 pt-5 border-t border-gray-200">
                        <div class="bg-gray-100 rounded-lg p-1 flex">
                            <a href="?" 
                               class="inline-block px-5 py-2 text-sm font-medium rounded-md transition-all <?php echo (!isset($_GET['view']) || $_GET['view'] == 'issues') ? 'bg-purple-700 text-white shadow-sm' : 'text-gray-600 hover:text-purple-700'; ?>">
                                Issues
                            </a>
                            <a href="../supplements#supplements/" 
                               class="inline-block px-5 py-2 text-sm font-medium rounded-md transition-all <?php echo (isset($_GET['view']) && $_GET['view'] == 'supplements') ? 'bg-purple-700 text-white shadow-sm' : 'text-gray-600 hover:text-purple-700'; ?>">
                                Supplements
                            </a>
                        </div>

                        <div class="flex items-center gap-2">
                            <label class="text-sm text-gray-600">Filter by Year:</label>
                            <select name="year" id="yearFilter" 
                                    class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-sm bg-white">
                                <option value="">All Years</option>
                                <?php
                                $currentYear = date('Y');
                                for ($year = 2020; $year <= $currentYear; $year++) {
                                    $selected = (isset($_GET['year']) && $_GET['year'] == $year) ? 'selected' : '';
                                    echo '<option value="' . $year . '" ' . $selected . '>' . $year . '</option>';
                                }
                                ?>
                            </select>
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
    
    /* Simple mobile fix - just stack on small screens */
    @media (max-width: 640px) {
        .grid {
            gap: 1rem;
        }
        button, a[href="?"] {
            margin-top: 0;
        }
        /* This is the only fix needed - stack on mobile */
        .flex-col.sm\:flex-row {
            flex-direction: column;
        }
    }
</style>

<script>
    // Auto-submit when year filter changes
    document.addEventListener('DOMContentLoaded', function() {
        const yearFilter = document.getElementById('yearFilter');
        if (yearFilter) {
            yearFilter.addEventListener('change', function() {
                document.getElementById('searchArticle').submit();
            });
        }
    });
</script>