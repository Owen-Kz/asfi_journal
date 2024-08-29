<?php 

function SendEmail($email, $manuscripTitle, $manuscriptId, $issueNumber, $fileName){
        // Submissions Endpoint for emails 
        // Offline 
        // $url = "http://localhost/asfirj_submission_controls/backend/sendPublicationEmail.php";


    // Online 
    $url = "https://cp.asfirj.org/backend/sendPublicationEmail.php";
    $subject = "Paper Published on ASFIRJ";
    $message = "
    <p> We are pleased to inform you that your paper is now published on online at ASFI Research Journal (ASFIRJ).</p>
    
    <p>You can Find the Article here at https://asfirj.org/content?sid=$manuscriptId</p>
    <p>We are pleased to inform you that your paper is now published on online at ASFI Research Journal (ASFIRJ).</p>

    <p>You can find the article here:</p>
    <p>https://asfirj.org/content?sid=67ccd7b376335667a4f7.</p>
    <p> A complimentary PDF copy of the article is also attached to this email, which you can share with your co-authors.</p>

    <p>Thank you for publishing your paper with ASFIRJ and we look forward to future submissions from you.</p>
    ";
    
    // Email details
    $emailData = array(
        'to' => $email,
        'subject' => $subject,
        'message' => $message,
        'fileName' => $fileName,
    );

    // Path to the downloaded certificate bundle
    $cacert = "/var/www/html/cacert.pem";

    // Initialize cURL session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($emailData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));
    // curl_setopt($ch, CURLOPT_CAINFO, $cacert); // Set the path to the certificate bundle
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification

    // Execute cURL request and get the response
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo json_encode(array("status" => "error", "message" => 'cURL error: ' . curl_error($ch)));
        return false;
    } else {
        // echo json_encode(array("status" => "emailSent", "message" => 'Response: ' . $response));
        
    }

    // Close cURL session
    curl_close($ch);
    return true;
   


}