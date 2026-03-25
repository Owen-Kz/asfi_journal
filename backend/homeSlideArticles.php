<?php
/**
 * Home Slide Articles Component - Enhanced with Batch Author Fetching
 */

// Include batch author helper
include_once dirname(__FILE__) . '/helpers/getAuthorsBatch.php';

// Function to get cover image URL with caching
function getSliderCoverImage($row) {
    static $defaultImage = null;
    if ($defaultImage === null) {
        $defaultImage = "https://res.cloudinary.com/dvm0bs013/image/upload/v1738234900/asfischolar_asbtdc.jpg";
    }
    
    $photo = $row['manuscriptPhoto'] ?? null;
    $isOld = $row['is_old_publication'] ?? 'no';
    
    if (empty($photo)) {
        return $defaultImage;
    }
    
    return $isOld === "yes" 
        ? "https://asfirj.org/useruploads/article_images/" . $photo
        : "https://process.asfirj.org/useruploads/article_images/" . $photo;
}

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
                $ArticlePhoto = getSliderCoverImage($row);
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
                
                // Render slider item with proper escaping and data attributes for carousel
                echo '
                <div class="item ' . $activeClassAttr . '" style="background-image: url(\'' . $ArticlePhoto . '\'); background-size: cover; background-position: center;">
                    <div class="carousel-caption article-info1">
                        <div class="tag">Recently Published</div>
                        <span class="articleDateContainer">
                            <input type="hidden" value="' . $ArticleDate . '">
                            ' . $ArticleDate . '
                        </span>
                        <div class="big">
                            <div class="inner-layer">
                                <div data-animation="reveal-text" data-delay="1s">
                                    <span style="animation-delay: 1s;"></span>
                                    <a href="./content?sid=' . $ArticleId . '"
                                        class="article-title u-text u-text-palette-5-light-3 u-text-2">
                                        ' . $ArticleTitle . '
                                    </a>
                                </div>
                            </div>
                            <div class="small">
                                <div class="inner-layer">
                                    <p class="u-text u-text-palette-5-light-3 u-text-1">
                                        ' . $authorsHTML . '
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                
                $counter++;
            }
        } else {
            // Fallback content when no articles are available
            echo '
            <div class="item active">
                <div class="carousel-caption article-info1">
                    <div class="tag">Coming Soon</div>
                    <div class="big">
                        <div class="inner-layer">
                            <div data-animation="reveal-text" data-delay="1s">
                                <span style="animation-delay: 1s;"></span>
                                <a href="#" class="article-title u-text u-text-palette-5-light-3 u-text-2">
                                    New articles coming soon. Stay tuned!
                                </a>
                            </div>
                        </div>
                        <div class="small">
                            <div class="inner-layer">
                                <p class="u-text u-text-palette-5-light-3 u-text-1">
                                    Check back regularly for new publications.
                                </p>
                            </div>
                        </div>
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
        <div class="item active">
            <div class="carousel-caption article-info1">
                <div class="tag">Error Loading</div>
                <div class="big">
                    <div class="inner-layer">
                        <div data-animation="reveal-text" data-delay="1s">
                            <span style="animation-delay: 1s;"></span>
                            <a href="#" class="article-title u-text u-text-palette-5-light-3 u-text-2">
                                Unable to load articles
                            </a>
                        </div>
                    </div>
                    <div class="small">
                        <div class="inner-layer">
                            <p class="u-text u-text-palette-5-light-3 u-text-1">
                                Please refresh the page or try again later.
                            </p>
                        </div>
                    </div>
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