<?php
    
    include_once '../config/dbconnect.php';

    $id = $conn->real_escape_string($_POST['id']);
    $pin = $conn->real_escape_string($_POST['pin']);

    $check= "SELECT * FROM  `verify_email`  WHERE user_id = $id AND pin='$pin'";
    $result = $conn->query($check);
    if($result){

        if($result->num_rows > 0){
       
            $sql ="UPDATE verify_email SET user_stat =1 WHERE user_id = $id";
            $result2 = $conn->query($sql);
            if($result2){
                $error = array('error'=>"");
                $success = array('success' => 1 );
                $message = array('message' =>"Email address confirmed. You can now log in." );
                $response = array_merge($success,$message,$error);
                echo json_encode($response);
            }
        }else{
            $error = array('error'=>"");
            $success = array('success' => 0 );
            $message = array('message' =>"Invalid verification code entered." );
            $response = array_merge($success,$message,$error);
            echo json_encode($response);
        }
    }else{
            $error = array('error'=> $conn->error);
            $success = array('success' => 0 );
            $message = array('message' =>"serve error occured" );
            $response = array_merge($success,$message,$error);
            echo json_encode($response);
    }

?>