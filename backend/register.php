<?php

include "db.php";
session_start();
// Get the JSON data from the POST request

$data = json_decode(file_get_contents('php://input'), true);

// // Access the values
$email_post = $data['email'];
$pass = $data['password'];
$username_post = $data['username'];
$first_name  = $data["first_name"];
$last_name = $data["last_name"];
$account_type = $data["accountType"];
$prefix = $data["prefix"];
$review = $data["review"];


// $email_post = $_POST['email'];
// $pass = $_POST['password'];
// $username_post = $_POST['username'];
// $first_name  = $_POST["first_name"];
// $last_name = $_POST["last_name"];
// $account_type = $_POST["accountType"];

// Encryoted Data 
$email = mysqli_real_escape_string($con, $email_post);
// $password = md5($pass);
$password = password_hash($pass, PASSWORD_DEFAULT);


if(isset($pass) && isset($email_post)&& isset($first_name) && isset($last_name) && isset($username_post)){
// CHeck if the user already exists
    $stmt = $con->prepare("SELECT * FROM `user_info` WHERE `email` = ? AND `username` = ? AND `first_name` = ? AND last_name = ?");
    $stmt->bind_param("ssss", $email, $username_post, $first_name, $last_name);
    $stmt->execute();
    $result = $stmt->get_result();
    $run_query = $result;
    // $run_query = $result;    
    $count = mysqli_num_rows($run_query);


	//if user record is available in database then $count will be equal to 1
	if($count > 0){
		$row = mysqli_fetch_array($run_query);
        $response = array('status' => 'error', 'message' => 'Account Already exist please login');
        echo json_encode($response);
    }
    else {
        // Create a NEw account if the user does not exist i.e record is not >  0
        $stmt = $con->prepare("INSERT INTO `user_info` (`email`, `username`, `prefix`, `for_review`,`first_name`, `last_name`, `acct_type`, `password`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $email, $username_post,$prefix,$review, $first_name, $last_name, $account_type, $password);
        // $stmt->execute();

        if($stmt->execute()){

 
        $response = array('status' => 'success', 'message' => 'Account Created Successfully', 'statement' => $stmt, 'result' => $result);
        echo json_encode($response);
   
    }
    else{
        echo "Error: " . $stmt->error;
    }
    }
}else{
    $response = array('status' => 'error', 'message' => 'Incomplete data');
echo json_encode($response);
    
}


?>