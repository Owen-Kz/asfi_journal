<?php
// previewMetaData.php - Reusable meta tags for content pages
// This file expects to be included from a page that already has db.php loaded
// Only process if we have database connection and sid parameter
$article_id = isset($_GET["sid"]) ? trim($_GET["sid"]) : null;

// Default metadata (fallback)
$defaultImage = "https://res.cloudinary.com/dvm0bs013/image/upload/v1738234900/asfischolar_asbtdc.jpg";
$defaultTitle = "ASFI Research Journal";
$defaultDescription = "ASFI Research Journal is an international journal, accepting contributions from all countries of the world. ASFIRJ publishes original papers, expert reviews, systematic reviews and meta-analyses, position papers, guidelines, protocols, data, editorials, news and commentaries, research letters.";
$defaultKeywords = "research,journal,africa,scholars,asfi,asfiresearchjournal,asfischolar";

// Initialize with defaults
$metaTitle = $defaultTitle;
$metaDescription = $defaultDescription;
$metaImage = $defaultImage;
$metaKeywords = $defaultKeywords;
$pageTitle = $defaultTitle;

// Helper function to get cover image
function getCoverImageMeta($row, $defaultImage) {
    try {
        $photo = isset($row['manuscriptPhoto']) && !empty($row['manuscriptPhoto']) 
            ? $row['manuscriptPhoto'] 
            : null;
        $isOld = isset($row['is_old_publication']) ? $row['is_old_publication'] : 'no';
        
        if (empty($photo)) {
            return $defaultImage;
        }
        
        return $isOld === "yes" 
            ? "https://asfirj.org/useruploads/article_images/" . htmlspecialchars($photo)
            : "https://process.asfirj.org/useruploads/article_images/" . htmlspecialchars($photo);
    } catch (Exception $e) {
        return $defaultImage;
    }
}

// Try to fetch article data if sid is provided
if (!empty($article_id)) {
    try {
        // Check if database connection exists (checking if $con is defined and valid)
        if (isset($con) && $con && !$con->connect_error) {
            $stmt = $con->prepare("SELECT `article_type`, `manuscript_file`, `cover_letter`, `manuscript_tables`, `figures`, `supplimentary_materials`, `graphic_abstract`, `manuscript_full_title`, `manuscript_running_title`, `abstract_background`, `abstract_objectives`, `abstract_method`, `abstract_results`, `abstract_discussion`, `unstructured_abstract`, `manuscriptPhoto`, `status`, `date_uploaded`, `corresponding_authors_email`, `buffer`, `views_count`, `downloads_count`, `date_reviewed`, `date_submitted`, `date_accepted`, `date_published`, `is_editors_choice`, `is_open_access`, `hyperlink_to_others`, `is_publication`, `page_number`, `doi_number`, `issues_number`, `is_old_publication`, `language`, `related_journal_id`, `abstract_ar`, `abstract_fr`, `abstract_ptg` FROM `journals` WHERE `buffer` = ? LIMIT 1");
            
            if ($stmt) {
                $stmt->bind_param("s", $article_id);
                
                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    
                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        
                        if (!empty($row['manuscript_full_title'])) {
                            $articleTitle = htmlspecialchars($row['manuscript_full_title']);
                            $pageTitle = $articleTitle . " - ASFI Research Journal";
                            $metaTitle = $articleTitle . " | ASFI Research Journal";
                            // Use the article title as part of the description
                            $metaDescription = $articleTitle . " - " . $defaultDescription;
                            $metaImage = getCoverImageMeta($row, $defaultImage);
                        }
                    }
                }
                $stmt->close();
            }
        } else {
            // Log that database connection is not available
            error_log("previewMetaData.php: Database connection not available");
        }
    } catch (Exception $e) {
        error_log("Error fetching article metadata: " . $e->getMessage());
        // Fall back to defaults
    }
}

// Output meta tags
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo $metaDescription; ?>">
<meta name="author" content="Weperch LLC">
<meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<title><?php echo $pageTitle; ?></title>
<meta name="title" content="<?php echo $metaTitle; ?>">
<meta name="description" content="<?php echo $metaDescription; ?>">
<meta name="keywords" content="<?php echo $metaKeywords; ?>">
<link rel="shortcut icon" href="../assets/images/logoIcon/favicon.png" type="image/x-icon">

<link rel="apple-touch-icon" href="../assets/images/logoIcon/logo.png">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="ASFI Research Journal">

<meta itemprop="name" content="ASFI Research Journal">
<meta itemprop="description" content="<?php echo $metaDescription; ?>">
<meta itemprop="image" content="<?php echo $metaImage; ?>">

<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo $metaTitle; ?>">
<meta property="og:description" content="<?php echo $metaDescription; ?>">
<meta property="og:image" content="<?php echo $metaImage; ?>">
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="1180">
<meta property="og:image:height" content="600">
<meta property="og:url" content="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo $metaTitle; ?>">
<meta name="twitter:description" content="<?php echo $metaDescription; ?>">
<meta name="twitter:image" content="<?php echo $metaImage; ?>">