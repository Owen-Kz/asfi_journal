<?php 

function SendEmail($email, $manuscripTitle, $manuscriptId, $issueNumber, $fileName, $authorName = "") {
    // Online endpoint
    $url = "https://greek.asfirj.org/backend/sendPublicationEmail.php";
    
    // Personalized subject line
    $subject = "Your Paper \"$manuscripTitle\" Has Been Published in ASFIRJ (Issue $issueNumber)";
    
    // Clean and personalize the manuscript title for the URL
    $cleanTitle = urlencode(strtolower(str_replace(' ', '-', $manuscripTitle)));
    $articleUrl = "https://asfirj.org/content?sid=$manuscriptId&title=$cleanTitle";
    
    // Modern, personalized email template
    $message = "
    <html>
    <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto;'>
        <div style='background-color: #f8f9fa; padding: 20px; border-radius: 5px;'>
            <h2 style='color: #2c3e50;'>Congratulations, " . ($authorName ? htmlspecialchars($authorName) : "Author") . "!</h2>
            
            <p>Your paper, <strong>\"$manuscripTitle\"</strong>, has now been officially published in <em>ASFI Research Journal</em>, Issue $issueNumber.</p>
            
            <p style='margin: 20px 0;'>
                <a href='$articleUrl' style='background-color: #3498db; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;'>View Your Published Paper</a>
            </p>
            
            <p>We've attached a complimentary PDF copy for your records and to share with co-authors.</p>
            
            <p>This publication contributes to our shared mission of advancing research in your field. We're honored to have your work in ASFIRJ.</p>
            
            <div style='margin-top: 30px; font-size: 0.9em; color: #7f8c8d; border-top: 1px solid #eee; padding-top: 15px;'>
                <p>ASFI Research Journal Editorial Team<br>
                <a href='https://asfirj.org' style='color: #3498db;'>asfirj.org</a></p>
                
                <p style='font-size: 0.8em;'>
                    <a href='https://asfirj.org/unsubscribe?email=$email' style='color: #7f8c8d;'>Unsubscribe</a> | 
                    <a href='https://asfirj.org/contact' style='color: #7f8c8d;'>Contact Us</a>
                </p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    // Email details
    $emailData = array(
        'to' => $email,
        'subject' => $subject,
        'message' => $message,
        'fileName' => $fileName,
    );

    // Initialize cURL with proper SSL verification
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($emailData),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_SSL_VERIFYPEER => true, // Always verify SSL in production
        CURLOPT_SSL_VERIFYHOST => 2,
    ]);

    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        error_log('Email sending error: ' . curl_error($ch));
        curl_close($ch);
        return false;
    }

    curl_close($ch);
    return true;
}