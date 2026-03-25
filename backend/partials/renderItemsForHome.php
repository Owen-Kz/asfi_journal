<?php
/**
 * Render Items for Home Component
 * Optimized with two-column layout (image left, content right)
 */

// Enable output buffering for better performance
ob_start();

// Set caching headers for better performance
header("Cache-Control: public, max-age=3600"); 
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 3600) . " GMT");

// Function to get cover image URL
function getCoverImage($row) {
    static $defaultImage = "https://res.cloudinary.com/dvm0bs013/image/upload/v1738234900/asfischolar_asbtdc.jpg";
    
    $photo = $row['manuscriptPhoto'] ?? null;
    $isOld = $row['is_old_publication'] ?? 'no';
    
    if (empty($photo)) return $defaultImage;
    
    return $isOld === "yes" 
        ? "https://asfirj.org/useruploads/article_images/" . $photo
        : "https://process.asfirj.org/useruploads/article_images/" . $photo;
}

// Function to format timestamp
function formatTimestamp($date) {
    if (empty($date)) return "";
    return date("j M Y", strtotime($date));
}

// Function to render a single article with two-column layout
function renderArticle($row, $authorsName) {
    $coverImage = getCoverImage($row);
    $formattedDate = formatTimestamp(!empty($row['date_published']) ? $row['date_published'] : $row['date_uploaded']);
    
    // Badges
    $editorsChoiceBadge = ($row['is_editors_choice'] === "yes") 
        // ? '<span >Editor\'s Choice</span>'
        ? '<span class="ml-2 inline-flex items-center px-2 py-1  font-medium rounded"><svg style="width:20px;" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19.965 8.521C19.988 8.347 20 8.173 20 8c0-2.379-2.143-4.288-4.521-3.965C14.786 2.802 13.466 2 12 2s-2.786.802-3.479 2.035C6.138 3.712 4 5.621 4 8c0 .173.012.347.035.521C2.802 9.215 2 10.535 2 12s.802 2.785 2.035 3.479A3.976 3.976 0 0 0 4 16c0 2.379 2.138 4.283 4.521 3.965C9.214 21.198 10.534 22 12 22s2.786-.802 3.479-2.035C17.857 20.283 20 18.379 20 16c0-.173-.012-.347-.035-.521C21.198 14.785 22 13.465 22 12s-.802-2.785-2.035-3.479zm-9.01 7.895-3.667-3.714 1.424-1.404 2.257 2.286 4.327-4.294 1.408 1.42-5.749 5.706z" fill="#4d91f7"/></svg> Editor\'s Choice </span>'

        : "";
    
    $openAccessBadge = ($row['is_open_access'] === "yes")
        ? '<span class="ml-2 inline-flex items-center px-2 py-1  font-medium rounded"><img src="./images/20181007070735!Open_Access_logo_PLoS_white.svg" style="width:10px;" alt=""> Open Access</span>'
        : "";
    
    // Escape output
    $articleType = htmlspecialchars($row['article_type']);
    $buffer = htmlspecialchars($row['buffer']);
    $title = htmlspecialchars($row['manuscript_full_title']);
    $manuscriptFile = htmlspecialchars($row['manuscript_file']);
    $viewsCount = (int)$row['views_count'];
    $downloadsCount = (int)$row['downloads_count'];
    
    // Abstract preview (stripping tags if HTML, then truncating)
    $abstract = $row['unstructured_abstract'] ?? $row['manuscript_abstract'] ?? "";
    $abstractPreview = (strlen($abstract) > 160) ? substr(strip_tags($abstract), 0, 160) . "..." : strip_tags($abstract);
    
    return '
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow mb-6">
        <div class="flex flex-col md:flex-row">
            <!-- Left Column: Image -->
            <div class="w-full md:w-64 h-48 md:h-auto bg-cover bg-center relative" style="background-image: url(\'' . $coverImage . '\'); background-color: #f3f4f6;">
                <div class="w-full h-full bg-gradient-to-r from-purple-900/70 to-transparent flex items-end p-4">
                    <span class="text-white text-sm  font-medium bg-purple-600 px-2 py-1 rounded">' . $articleType . '</span>
                </div>
            </div>
            
            <!-- Right Column: Content -->
            <div class="flex-1 p-6">
                <div class="flex items-start justify-between mb-2">
                    <div class="flex-1">
                        <a href="./content?sid=' . $buffer . '" class="hover:text-purple-700 transition-colors">
                            <h3 class=" font-semibold text-gray-900 mb-1 line-clamp-2">' . $title . '</h3>
                        </a>
                        <p class=" text-gray-600">by ' . htmlspecialchars($authorsName) . '</p>
                    </div>
                    <div class="flex flex-col items-end gap-1">
                        ' . $openAccessBadge . '
                        ' . $editorsChoiceBadge . '
                    </div>
                </div>

                <p class=" text-gray-400 mb-3">ID: ' . $buffer . '</p>
                
             
                <!-- Stats Row -->
                <div class="flex flex-wrap items-center gap-4  text-gray-500 mb-4">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 mr-1"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect><line x1="16" x2="16" y1="2" y2="6"></line><line x1="8" x2="8" y1="2" y2="6"></line><line x1="3" x2="21" y1="10" y2="10"></line></svg>
                        ' . $formattedDate . '
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 mr-1"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        ' . $viewsCount . ' Views
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 mr-1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" x2="12" y1="15" y2="3"></line></svg>
                        ' . $downloadsCount . ' Downloads
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-2">
                    <a href="./content?sid=' . $buffer . '" class="px-3 py-1.5 bg-gray-100 text-[#80078b]  font-medium rounded-lg transition-colors flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        View
                    </a>
                    <a href="https://asfirj.org/useruploads/manuscripts/' . $manuscriptFile . '" target="_blank" class="px-3 py-1.5 bg-gray-100 text-[#80078b]  font-medium rounded-lg transition-colors flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" x2="12" y1="15" y2="3"></line></svg>
                        PDF
                    </a>
                    <button data-id="' . $buffer . '" data-title="' . $title . '" class="shareButton px-3 py-1.5 bg-gray-100 text-[#80078b]   font-medium rounded-lg transition-colors flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" x2="15.42" y1="13.51" y2="17.49"></line><line x1="15.41" x2="8.59" y1="6.51" y2="10.49"></line></svg>
                        Share
                    </button>
                </div>
            </div>
        </div>
    </div>';
}

// Function to render issues for home page
function renderItemsForHome($con, $limit = 10) {
    try {
        // Start output buffering
        ob_start();
        
        // Query with limit for homepage
        $stmt = $con->prepare("SELECT * FROM `journals` WHERE `is_publication` = 'yes' ORDER BY `id` DESC LIMIT ?");
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if (mysqli_num_rows($result) > 0) {
            // Collect all article IDs for batch author fetching
            $articles = [];
            $articleIds = [];
            
            while ($row = $result->fetch_assoc()) {
                $articles[] = $row;
                $articleIds[] = $row['buffer'];
            }
            
            // Batch fetch all authors
            $authorsMap = getAuthorsBatch($con, $articleIds);
            
            // Render each article
            foreach ($articles as $row) {
                $articleId = $row['buffer'];
                $authorsName = isset($authorsMap[$articleId]) 
                    ? implode(", ", $authorsMap[$articleId]) 
                    : "Research Team";
                
                echo renderArticle($row, $authorsName);
            }
        } else {
            echo '<div class="text-center py-12 bg-gray-50 rounded-xl">
                    <h3 class=" font-semibold text-gray-700 mb-2">No articles available</h3>
                    <p class="text-gray-500">Check back soon for new publications.</p>
                  </div>';
        }
        
        $output = ob_get_clean();
        echo $output;
        
    } catch (Exception $e) {
        error_log("Error in renderItemsForHome: " . $e->getMessage());
        echo '<div class="text-center py-12 bg-red-50 rounded-xl">
                <h3 class=" font-semibold text-red-700 mb-2">Error loading articles</h3>
                <p class="text-red-500">Please try again later.</p>
              </div>';
    }
}


// Function to render recent articles with pagination
function renderRecentArticles($con, $page = 1, $items_per_page = 6) {
    $offset = ($page - 1) * $items_per_page;
    $totalPages = 0;
    
    try {
        // Count total
        $stmtCount = $con->prepare("SELECT COUNT(`id`) AS total FROM `journals` WHERE `is_publication` = 'yes'");
        $stmtCount->execute();
        $resultC = $stmtCount->get_result();
        $rowC = $resultC->fetch_assoc();
        $totalItems = $rowC['total'];
        $totalPages = ceil($totalItems / $items_per_page);
        
        // Get paginated results
        $stmt = $con->prepare("SELECT * FROM `journals` WHERE `is_publication` = 'yes' ORDER BY `id` DESC LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $items_per_page, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if (mysqli_num_rows($result) > 0) {
            $articles = [];
            $articleIds = [];
            
            while ($row = $result->fetch_assoc()) {
                $articles[] = $row;
                $articleIds[] = $row['buffer'];
            }
            
            $authorsMap = getAuthorsBatch($con, $articleIds);
            
            foreach ($articles as $row) {
                $articleId = $row['buffer'];
                $authorsName = isset($authorsMap[$articleId]) 
                    ? implode(", ", $authorsMap[$articleId]) 
                    : "Research Team";
                
                echo renderArticle($row, $authorsName);
            }
            
            // Pagination
            if ($totalPages > 1) {
                echo '<div class="flex justify-center gap-2 mt-8">';
                for ($i = 1; $i <= $totalPages; $i++) {
                    $activeClass = ($i == $page) ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300';
                    echo '<a href="?page=' . $i . '" class="px-4 py-2 rounded-lg ' . $activeClass . ' transition-colors">' . $i . '</a>';
                }
                echo '</div>';
            }
            
        } else {
            echo '<p class="text-center text-gray-500 py-8">No articles available.</p>';
        }
        
    } catch (Exception $e) {
        echo '<p class="text-center text-red-500 py-8">Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
}

// If called directly, render the component
if (basename($_SERVER['PHP_SELF']) == 'renderItemsForHome.php') {
    $type = isset($_GET['type']) ? $_GET['type'] : 'recent';
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    
    switch($type) {

        case 'recent':
            renderRecentArticles($con, $page, $limit);
            break;
        default:
            renderItemsForHome($con, $limit);
    }
}

// End output buffering
ob_end_flush();
?>