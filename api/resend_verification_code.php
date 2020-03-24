<?php
    include_once '../config/dbconnect.php';

    $id = $conn->real_escape_string($_POST['id']);
    $email = $conn->real_escape_string($_POST['email']);
    $pin = md5($email);

    $check= "SELECT * FROM `verify_email WHERE user_id = '$id";
    $result = $conn->query($check);

    if($result){

        if($result->num_rows == 0){
          
            $sql2= "INSERT INTO verify_email(user_id, pin,user_stat) VALUES('$id','$pin','0')";
            $result3 = $conn->query($sql2);
            $to = "$email"; 
            $from="enquiries@qpsloyalty.com";
            $subject = "Confirm your Email:Quick Print Shop";
            
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";

            $body = "$name, thanks for signing  up with the QPS Loyalty Program.\n\n"."Your verification code is $pin
                \n please ignore if you didn't sign up with QPS";

            $send=mail($to, $subject, $body, $headers);
            $success = array('success' => 1 );
            $message = array('message' =>"Your Account has being created, Check your mailbox and verify your mail" );
            $response = array_merge($success,$message);
            echo json_encode($response);
            
        }else{
            $to = "$email"; 
            $from="enquiries@qpsloyalty.com";
            $subject = "Confirm your Email:Quick Print Shop";

            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";

            $body = "$name, thanks for signing  up with the QPS Loyalty Program.\n\n"."Your verification code is $pin
                \n please ignore if you didn't sign up with QPS";

            $send=mail($to, $subject, $body, $headers);
        
            $success = array('success' => 1 );
            $message = array('message' =>"Your Account has being created, Check your mailbox and verify your mail" );
            $response = array_merge($success,$message);
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