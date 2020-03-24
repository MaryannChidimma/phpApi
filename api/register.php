 <?php
    
    include_once '../config/dbconnect.php';

    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $tel=  $conn->real_escape_string($_POST['phone']);
    $password = $conn->real_escape_string($_POST['password']);
    $refEmail =  $conn->real_escape_string($_POST['refEmail']);
    $userType =  $conn->real_escape_string($_POST['type']);
    $pass = md5($password);
     $id = time();
    $pin= $id; 
    $nowr = date("Y-m-d h:i:s");

    //insert to db 
    $sql= "INSERT INTO `users` (`user_id`, `fullname`, `email`, `phone_no`, `password`,
    `referral_email`, `user_type`, `date_registered`,channel) 
    VALUES (NULL, '$name', '$email', '$tel', '$pass', '$refEmail', '$userType', '$nowr','mobile')";
    $result2 = $conn->query($sql);
    if($result2){
        $id= $conn->insert_id; //mysqli_insert_id($con);
        $sql2= "INSERT INTO verify_email(user_id, pin,user_stat) VALUES('$id','$pin','0')";
        $result3 = $conn->query($sql2);
        $to = "$email"; 
        $from="enquiries@qpsloyalty.com";
        $subject = "Confirm your Email:The Quick Print Shop";

        $headers = "From: " . strip_tags($from) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        $headers .= "Reply-To: ". strip_tags($from) . "\r\n";

        $body = "Dear $name, Welcome to The Quick Print Shop Loyalty Program.\n\n"."Your verification code is $pin
                \nPlease ignore if you didn't sign up with The Quick Print Shop";

        $send=mail($to, $subject, $body, $headers);
    

        $success = array('success' => 1 );
        $id = array('id' => $id);
        $message = array('message' =>"Your Account has being created, Check your mailbox and verify your mail" );
        $response = array_merge($success,$message,$id);
        echo json_encode($response);
    
    }else{
            $error = array('error'=> $conn->error);
            $success = array('success' => 0 );
            $message = array('message' =>"serve error occured" );
            $response = array_merge($success,$message,$error);
            echo json_encode($response);
    }
  $conn->close();
?>