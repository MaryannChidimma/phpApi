<?php

include_once '../config/dbconnect.php';

$username = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);
$pass = md5($password);

$sql = "SELECT * FROM users INNER JOIN verify_email ON users.user_id =verify_email.user_id WHERE email = '$username' AND password = '$pass' ";
 
 error_log($sql);
 $result = $conn->query($sql);
 
 $row = array();

    if  ($result)
    {
        if($result->num_rows > 0){
           while($r = $result->fetch_array(MYSQLI_ASSOC)) {
              $row = $r;
            }
            $success = array('success' => 1 );
            $user["user"] = $row;
            $response= array_merge($success,$user);
            echo json_encode($response);
         
        }
        else {
               $success = array('success' => 0 );
            $error = array('error'=>"");
            $message = array('message' =>"Incorrect details. please try again." );
            $response = array_merge($success,$row,$message,$error);
            echo json_encode($response);
        }
       //
    } 
    else {
            $success = array('success' => 0 );
           $error = array('error'=> $conn->error);
             $message = array('message' =>"serve error occured" );
            $response = array_merge($success,$row,$message,$error);
            echo json_encode($response);
    }

 $conn->close();
?>                                                                                                      