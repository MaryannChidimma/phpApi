<?php
     
    include_once '../config/dbconnect.php';

    $email = $conn->real_escape_string($_POST['email']);
    $tel=  $conn->real_escape_string($_POST['phone']);
    $userType =  $conn->real_escape_string($_POST['type']);

    //check db for user email and phone if exist
    $check= "SELECT email, phone_no FROM users WHERE email= '$email' OR phone_no='$tel' ";
    $result = $conn->query($check);

    //if no record of either mail or phone
    if($result->num_rows ==0){
        $success = array('success' => 1);
        $message = array('message' => "No SuchUSer Exist!");
        $response = array_merge($success,$message);
        echo json_encode($response);
    }else{ 
        $success = array('success' => 0);
        $message = array('message' => "Email or phone number already Exist! Use a different one.");
        $response = array_merge($success,$message);
        echo json_encode($response);
    }

?>