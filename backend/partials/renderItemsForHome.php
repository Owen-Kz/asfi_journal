<?php
/**
 * Render Items for Home Component
 * Card layout with image above, content below
 * Responsive: 2 columns on desktop, 1 column on mobile
 */

// Enable output buffering for better performance
ob_start();

// Set caching headers for better performance
header("Cache-Control: public, max-age=3600"); 
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 3600) . " GMT");
include __DIR__."/helpers.php";



// Function to get cover image URL
// function getCoverImage($row) {
//     static $defaultImage = "https://res.cloudinary.com/dvm0bs013/image/upload/v1738234900/asfischolar_asbtdc.jpg";
    
//     $photo = $row['manuscriptPhoto'] ?? null;
//     $isOld = $row['is_old_publication'] ?? 'no';
    
//     if (empty($photo)) return $defaultImage;
    
//     return $isOld === "yes" 
//         ? "https://asfirj.org/useruploads/article_images/" . $photo
//         : "https://process.asfirj.org/useruploads/article_images/" . $photo;
// }

// Function to format timestamp
function formatTimestamp($date) {
    if (empty($date)) return "";
    return date("j M Y", strtotime($date));
}

// Function to render a single article with card layout (image above, content below)
function renderArticle($row, $authorsName) {
    $coverImage = getCoverImage($row);
    $formattedDate = formatTimestamp(!empty($row['date_published']) ? $row['date_published'] : $row['date_uploaded']);
    
    // Badges - increased font size to text-lg
    $editorsChoiceBadge = ($row['is_editors_choice'] === "yes") 
        ? '<span class="editchoice inline-flex items-center gap-1.5 text-lg text-blue-700 bg-blue-50 px-3 py-1.5 rounded-full"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.965 8.521C19.988 8.347 20 8.173 20 8c0-2.379-2.143-4.288-4.521-3.965C14.786 2.802 13.466 2 12 2s-2.786.802-3.479 2.035C6.138 3.712 4 5.621 4 8c0 .173.012.347.035.521C2.802 9.215 2 10.535 2 12s.802 2.785 2.035 3.479A3.976 3.976 0 0 0 4 16c0 2.379 2.138 4.283 4.521 3.965C9.214 21.198 10.534 22 12 22s2.786-.802 3.479-2.035C17.857 20.283 20 18.379 20 16c0-.173-.012-.347-.035-.521C21.198 14.785 22 13.465 22 12s-.802-2.785-2.035-3.479zm-9.01 7.895-3.667-3.714 1.424-1.404 2.257 2.286 4.327-4.294 1.408 1.42-5.749 5.706z" fill="#4d91f7"/></svg> Editor\'s Choice</span>'
        : "";
    
    $openAccessBadge = ($row['is_open_access'] === "yes")
        ? '<span class="openaccess inline-flex items-center gap-1.5 text-lg text-green-700 bg-green-50 px-3 py-1.5 rounded-full"><img src="./images/20181007070735!Open_Access_logo_PLoS_white.svg" style="width:18px;" alt=""> Open Access</span>'
        : "";
    
    // Escape output
    $articleType = htmlspecialchars($row['article_type']);
    $buffer = htmlspecialchars($row['buffer']);
    $title = htmlspecialchars($row['manuscript_full_title']);
    // $manuscriptFile = htmlspecialchars($row['manuscript_file']);
    $viewsCount = (int)$row['views_count'];
    $downloadsCount = (int)$row['downloads_count'];
    $manuscriptFileURL = getManuscriptURL($row);

    
    return '
    <div class="w-full bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300 mb-6">
        <!-- Cover Image -->
        <div class="relative h-80 w-full overflow-hidden bg-gray-100">
            <img src="' . $coverImage . '" alt="' . $title . '" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
            <div class="absolute top-4 left-4">
                <span class="text-base font-semibold text-purple-700 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-sm">' . $articleType . '</span>
            </div>
            <div class="absolute top-4 right-4 flex gap-2">
                ' . $openAccessBadge . '
                ' . $editorsChoiceBadge . '
            </div>
        </div>
        
        <!-- Content -->
        <div class="p-6">
            <!-- Title - increased to 3xl/4xl -->
            <a href="./content?sid=' . $buffer . '" class="hover:text-purple-700 transition-colors">
                <h3 class="text-3xl md:text-4xl font-semibold text-gray-900 mb-3 line-clamp-2 leading-tight">' . $title . '</h3>
            </a>
            
            <!-- Authors - increased to text-xl -->
            <div class="mb-4">
                <p class="text-xl text-gray-600 line-clamp-2" title="' . htmlspecialchars($authorsName) . '">' . htmlspecialchars($authorsName) . '</p>
            </div>
            
            <!-- Stats - increased to text-base/lg -->
            <div class="flex flex-wrap items-center gap-5 text-base text-gray-500 mb-5 pb-3 border-b border-gray-100">
                <div class="flex items-center gap-1.5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>' . $formattedDate . '</span>
                </div>
                <div class="flex items-center gap-1.5 text-base" title="Views">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    <span>' . number_format($viewsCount) . '</span> Views
                </div>
                <div class="flex items-center gap-1.5 text-base" title="Downloads">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    <span>' . number_format($downloadsCount) . '</span> Downloads
                </div>
            </div>
            
            <!-- Action Buttons - increased to text-base with larger padding -->
            <div class="flex flex-wrap items-center gap-3" style="justify-content: space-between;">
                <a href="./content?sid=' . $buffer . '#abstract" class="px-6 py-4 bg-gray-100 hover:bg-purple-100 text-purple-700 rounded-lg transition-colors flex items-center gap-2 text-base font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    Abstract
                </a>
                <a href="./content?sid=' . $buffer . '#fulltext" class="px-6 py-4 bg-gray-100 hover:bg-purple-100 text-purple-700 rounded-lg transition-colors flex items-center gap-2 text-base font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Full Text
                </a>
                <a href="' . $manuscriptFileURL . '" target="_blank" class="downloadLink px-6 py-4 bg-gray-100 hover:bg-purple-100 text-purple-700 rounded-lg transition-colors flex items-center gap-2 text-base font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    PDF
                </a>
          
                <button class="shareButton px-6 py-4 bg-gray-100 hover:bg-purple-100 text-purple-700 rounded-lg transition-colors flex items-center gap-2 text-base font-medium cursor-pointer" 
                        data-id="' . htmlspecialchars($buffer, ENT_QUOTES) . '" 
                        data-title="' . htmlspecialchars($title, ENT_QUOTES) . '">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                    Share
                </button>
            </div>
        </div>
    </div>';
}

// Function to render issues for home page
function renderItemsForHome($con, $limit = 10) {
    try {
        ob_start();
        
        $stmt = $con->prepare("SELECT * FROM `journals` WHERE `is_publication` = 'yes' ORDER BY `id` DESC LIMIT ?");
        $stmt->bind_param("i", $limit);
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
        } else {
            echo '<div class="col-span-2 text-center py-12 bg-gray-50 rounded-xl">
                    <h3 class="text-2xl font-semibold text-gray-700 mb-2">No articles available</h3>
                    <p class="text-xl text-gray-500">Check back soon for new publications.</p>
                  </div>';
        }
        
        $output = ob_get_clean();
        echo $output;
        
    } catch (Exception $e) {
        error_log("Error in renderItemsForHome: " . $e->getMessage());
        echo '<div class="col-span-2 text-center py-12 bg-red-50 rounded-xl">
                <h3 class="text-2xl font-semibold text-red-700 mb-2">Error loading articles</h3>
                <p class="text-xl text-red-500">Please try again later.</p>
              </div>';
    }
}

function renderRecentArticles($con, $page = 1, $items_per_page = 6) {
    $offset = ($page - 1) * $items_per_page;
    $totalPages = 0;
    
    try {
        $stmtCount = $con->prepare("SELECT COUNT(`id`) AS total FROM `journals` WHERE `is_publication` = 'yes'");
        $stmtCount->execute();
        $resultC = $stmtCount->get_result();
        $rowC = $resultC->fetch_assoc();
        $totalItems = $rowC['total'];
        $totalPages = ceil($totalItems / $items_per_page);
        
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
            
            if ($totalPages > 1) {
                echo '<div class="col-span-2 flex justify-center gap-2 mt-8 flex-wrap">';
                for ($i = 1; $i <= $totalPages; $i++) {
                    $activeClass = ($i == $page) ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300';
                    echo '<a href="?page=' . $i . '" class="px-5 py-2 rounded-lg text-base ' . $activeClass . ' transition-colors">' . $i . '</a>';
                }
                echo '</div>';
            }
            
        } else {
            echo '<p class="col-span-2 text-center text-xl text-gray-500 py-8">No articles available.</p>';
        }
        
    } catch (Exception $e) {
        echo '<p class="col-span-2 text-center text-xl text-red-500 py-8">Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
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