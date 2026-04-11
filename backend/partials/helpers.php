<?php

function getClientIp() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    return $_SERVER['REMOTE_ADDR'];
}

function updateDownloadsCount($row) {
    global $con;

    $articleId = $row["id"];
    $clientIp = getClientIp(); // Get client IP

    try {
        // Check if user already downloaded
        $stmtCheck = $con->prepare("
            SELECT id FROM view_download_count 
            WHERE user_ip = ? AND article_id = ? AND type = 'downloaded'
        ");

        if (!$stmtCheck) {
            throw new Exception("Prepare failed (check): " . $con->error);
        }

        $stmtCheck->bind_param("si", $clientIp, $articleId);
        $stmtCheck->execute();
        $result = $stmtCheck->get_result();

        if ($result->num_rows === 0) {
            // Not downloaded before → update count
            $stmtUpdate = $con->prepare("
                UPDATE journals 
                SET downloads_count = downloads_count + 1 
                WHERE id = ?
            ");

            if (!$stmtUpdate) {
                throw new Exception("Prepare failed (update): " . $con->error);
            }

            $stmtUpdate->bind_param("i", $articleId);
            $stmtUpdate->execute();
            $stmtUpdate->close();

            // Insert tracking record
            $stmtInsert = $con->prepare("
                INSERT INTO view_download_count (user_ip, article_id, type)
                VALUES (?, ?, 'downloaded')
            ");

            if (!$stmtInsert) {
                throw new Exception("Prepare failed (insert): " . $con->error);
            }

            $stmtInsert->bind_param("si", $clientIp, $articleId);
            $stmtInsert->execute();
            $stmtInsert->close();

            $stmtCheck->close();
            return "Download updated";

        } else {
            $stmtCheck->close();
            return "Already downloaded";
        }

    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}
function getManuscriptURL($row) {
    static $defaultImage = "https://res.cloudinary.com/dvm0bs013/image/upload/v1738234900/asfischolar_asbtdc.jpg";
    
    $manuscript = $row['manuscript_file'] ?? null;
    $isOld = $row['is_old_publication'] ?? 'no';
    
    if (empty($manuscript)) return $defaultImage;
    return $isOld === "yes" 
        ? "https://asfirj.org/useruploads/manuscripts/" . $manuscript
        : "https://process.asfirj.org/useruploads/manuscripts/" . $manuscript;
}

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