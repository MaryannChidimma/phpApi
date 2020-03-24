<?php

    include_once '../config/dbconnect.php';
    $receiver_id ="1";
    $userId = $conn->real_escape_string($_POST['userId']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);
    $attachment= "";
    $date_sent = date("Y-m-d h:i:s");
    if(isset($_POST['image'])){
    	$image -= $_POST['image'];
    	$name = $_POST['imageName'];
    	file_put_contents($path, base64_decode())

    }else{
    	 $sql = "INSERT INTO `messages`(`sender_id`, `receiver_id`, `subject`, `message`, `attachment`,
    `date_sent`, `reply`, `message_status`) VALUES 
    ('$userId','$receiver_id','$subject','$message','','$date_sent','','0')";
    }
   
   
    $result = $conn->query($sql);
    if($result){
    
            $success = array('success' => 1 );
            $messages = array('message'=>"message sent");
            $response= array_merge($success,$messages);
            echo json_encode($response);
         
    }else{
       
            $success = array('success' => 0 );
            $messages = array('message'=> $conn->error);
            $response= array_merge($success,$messages);
            echo json_encode($response);
    }
    $conn->close();
?>