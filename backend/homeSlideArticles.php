<?php
/**
 * Home Slide Articles Component - Enhanced with Batch Author Fetching
 */

// Include batch author helper
include_once dirname(__FILE__) . '/helpers/getAuthorsBatch.php';
include __DIR__."/partials/helpers.php";

// Function to format date
function formatSliderDate($date) {
    if (empty($date)) return "";
    return date("F j, Y", strtotime($date));
}

// Function to render slider items with batch fetching
function renderSliderItemsOptimized($con, $limit = 3) {
    try {
        // Start output buffering
        ob_start();
        
        // Optimized query with prepared statement
        $stmt = $con->prepare("SELECT * FROM `journals` WHERE `is_publication` = 'yes' ORDER BY `id` DESC LIMIT ?");
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $count = mysqli_num_rows($result);
        
        if ($count > 0) {
            // Collect articles for batch author fetching
            $articles = [];
            $articleIds = [];
            
            while ($row = mysqli_fetch_assoc($result)) {
                $articles[] = $row;
                $articleIds[] = $row['buffer'];
            }
            
            // Batch fetch all authors in one query
            $authorsMap = getAuthorsBatch($con, $articleIds);
            
            $activeClass = true;
            $counter = 0;
            foreach ($articles as $row) {
                $ArticleTitle = htmlspecialchars($row['manuscript_full_title']);
                $ArticlePhoto = getCoverImage($row);
                $ArticleId = htmlspecialchars($row['buffer']);
                
                // Format date
                $MainPublishDate = $row["date_published"];
                if (!empty($MainPublishDate) && $MainPublishDate !== null && $MainPublishDate !== "") {
                    $ArticleDate = formatSliderDate($MainPublishDate);
                } else {
                    $ArticleDate = formatSliderDate($row['date_uploaded']);
                }
                
                // Get authors from batch fetched map
                $authorsArray = isset($authorsMap[$ArticleId]) ? $authorsMap[$ArticleId] : [];
                $authorsHTML = formatAuthorsHTML($authorsArray);
                
                // Determine active class for first item
                $activeClassAttr = $activeClass ? 'active' : '';
                $activeClass = false;
                
                // Render slider item with Tailwind styling
                echo '
                <div class="carousel-item ' . $activeClassAttr . ' relative w-full h-[500px] md:h-[600px] bg-cover bg-center bg-no-repeat transition-opacity duration-700 ease-in-out" 
                     style="background-image: url(\'' . $ArticlePhoto . '\');">
                    <!-- Dark overlay for readability -->
                    <div class="absolute inset-0 bg-black/50 bg-gradient-to-r from-black/70 to-transparent"></div>
                    
                    <!-- Carousel Caption -->
                    <div class="absolute bottom-0 left-0 right-0 p-6 md:p-12 text-white text-left">
                        <div class="max-w-3xl">
                            <!-- Tag -->
                            <span class="inline-block bg-[#80078b] text-white text-xs font-semibold uppercase tracking-wider px-3 py-1 rounded mb-3">
                                Recently Published
                            </span>
                            
                            <!-- Date -->
                            <div class="text-sm text-gray-300 mb-2 flex items-center gap-2">
                                <i class="far fa-calendar-alt text-[#9834db]"></i>
                                <span class="articleDateContainer">' . $ArticleDate . '</span>
                            </div>
                            
                            <!-- Article Title -->
                            <div class="mb-3">
                                <a href="./content?sid=' . $ArticleId . '"
                                   class="block text-2xl md:text-3xl lg:text-4xl font-bold text-white hover:text-[#9834db] transition-colors duration-200 no-underline leading-tight">
                                    ' . $ArticleTitle . '
                                </a>
                            </div>
                            
                            <!-- Authors -->
                            <div class="text-sm text-gray-300 flex items-center gap-2">
                                <i class="fas fa-user-edit text-[#9834db]"></i>
                                <span>' . $authorsHTML . '</span>
                            </div>
                        </div>
                    </div>
                </div>';
                
                $counter++;
            }
        } else {
            // Fallback content when no articles are available
            echo '
            <div class="carousel-item active relative w-full h-[500px] md:h-[600px] bg-gradient-to-r from-[#80078b] to-[#4a0452]">
                <div class="absolute inset-0 bg-black/30"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6 md:p-12 text-white text-left">
                    <div class="max-w-3xl">
                        <span class="inline-block bg-[#ffbf00] text-[#80078b] text-xs font-semibold uppercase tracking-wider px-3 py-1 rounded mb-3">
                            Coming Soon
                        </span>
                        <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-2">
                            New articles coming soon. Stay tuned!
                        </h2>
                        <p class="text-gray-300 text-sm">
                            Check back regularly for new publications.
                        </p>
                    </div>
                </div>
            </div>';
        }
        
        $output = ob_get_clean();
        echo $output;
        
    } catch (Exception $e) {
        // Log error and show fallback
        error_log("Slider Error: " . $e->getMessage());
        echo '
        <div class="carousel-item active relative w-full h-[500px] md:h-[600px] bg-gradient-to-r from-[#80078b] to-[#4a0452]">
            <div class="absolute inset-0 bg-black/30"></div>
            <div class="absolute bottom-0 left-0 right-0 p-6 md:p-12 text-white text-left">
                <div class="max-w-3xl">
                    <span class="inline-block bg-red-500 text-white text-xs font-semibold uppercase tracking-wider px-3 py-1 rounded mb-3">
                        Error Loading
                    </span>
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-2">
                        Unable to load articles
                    </h2>
                    <p class="text-gray-300 text-sm">
                        Please refresh the page or try again later.
                    </p>
                </div>
            </div>
        </div>';
    }
}

// Main execution
if (!isset($con) || !$con) {
    include_once dirname(__FILE__) . '/db.php';
}

// Define constant to indicate we're including from homepage
define('INCLUDED_FROM_HOMEPAGE', true);

// Render the slider with optimized function
renderSliderItemsOptimized($con, 3);
?>
