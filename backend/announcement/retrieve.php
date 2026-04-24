<?php
/**
 * Get announcements from database
 * Returns JSON response with proper error handling
 * Always returns an array (empty if no results or error occurs)
 */

// Set JSON content type header
header('Content-Type: application/json');

// Error reporting (disable in production)
define('DEBUG_MODE', false); // Set to false in production

if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
}

// Include database connection
if (!file_exists("../db.php")) {
    if (DEBUG_MODE) {
        error_log("Database config file not found: ../db.php");
    }
    echo json_encode([]);
    exit;
}

include "../db.php";

// Check database connection
if (!isset($con) || !$con || $con->connect_error) {
    error_log("Database connection failed: " . (isset($con) && $con ? $con->connect_error : "Connection variable not set"));
    echo json_encode([]);
    exit;
}

/**
 * Fetch announcements from database
 * @param mysqli $con Database connection
 * @param string|null $priority Optional priority filter
 * @return array Array of announcements (empty if none found or error)
 */
function getAnnouncements($con, $priority = null) {
    $result = [];
    
    try {
        if ($priority !== null && !empty($priority)) {
            // Validate priority value
            $validPriorities = ['high', 'medium', 'low'];
            if (!in_array(strtolower($priority), $validPriorities)) {
                error_log("Invalid priority value: " . $priority);
                return [];
            }
            
            // Fetch announcements by priority
            $sql = "SELECT * FROM `announcements` WHERE `priority` = ? ORDER BY 
                    CASE `priority`
                        WHEN 'high' THEN 1
                        WHEN 'medium' THEN 2
                        WHEN 'low' THEN 3
                        ELSE 4
                    END ASC,
                    `created_at` DESC, `id` DESC";
            
            $stmt = $con->prepare($sql);
            if (!$stmt) {
                error_log("SQL prepare failed: " . $con->error);
                return [];
            }
            
            $priorityLower = strtolower($priority);
            $stmt->bind_param("s", $priorityLower);
        } else {
            // Fetch all announcements
            $sql = "SELECT * FROM `announcements` ORDER BY 
                    CASE `priority`
                        WHEN 'high' THEN 1
                        WHEN 'medium' THEN 2
                        WHEN 'low' THEN 3
                        ELSE 4
                    END ASC,
                    `created_at` DESC, `id` DESC";
            
            $stmt = $con->prepare($sql);
            if (!$stmt) {
                error_log("SQL prepare failed: " . $con->error);
                return [];
            }
        }
        
        // Execute statement
        if (!$stmt->execute()) {
            error_log("SQL execute failed: " . $stmt->error);
            $stmt->close();
            return [];
        }
        
        // Get results
        $queryResult = $stmt->get_result();
        if ($queryResult && $queryResult->num_rows > 0) {
            $result = $queryResult->fetch_all(MYSQLI_ASSOC);
        }
        
        $stmt->close();
        
    } catch (Exception $e) {
        error_log("Exception in getAnnouncements: " . $e->getMessage());
        return [];
    }
    
    return $result;
}

/**
 * Sanitize array data for JSON output
 * @param array $data Array to sanitize
 * @return array Sanitized array
 */
function sanitizeOutput($data) {
    if (!is_array($data)) {
        return [];
    }
    
    array_walk_recursive($data, function(&$item) {
        if (is_string($item)) {
            // Remove any unwanted characters and escape HTML
            $item = htmlspecialchars(trim($item), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        } elseif (is_null($item)) {
            $item = '';
        }
    });
    
    return $data;
}

// Get priority parameter
$priority = isset($_GET['priority']) ? trim($_GET['priority']) : null;

// Validate and clean priority
if ($priority !== null && $priority !== '') {
    // Allow only specific priority values
    $allowedPriorities = ['high', 'medium', 'low'];
    $priority = in_array(strtolower($priority), $allowedPriorities) ? strtolower($priority) : null;
}

// Fetch announcements
$announcements = getAnnouncements($con, $priority);

// Sanitize output
$announcements = sanitizeOutput($announcements);

// Ensure we always return a JSON array
if (empty($announcements)) {
    echo json_encode([]);
} else {
    // Add response metadata (optional)
    $response = [
        'success' => true,
        'count' => count($announcements),
        'data' => $announcements
    ];
    
    // If you want just the array without metadata, use this instead:
    // echo json_encode($announcements, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

// Close connection
if (isset($con) && $con && !$con->connect_error) {
    $con->close();
}
?>