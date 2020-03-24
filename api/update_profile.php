<?php
    include_once '../config/dbconnect.php';

    $userId = $conn->real_escape_string($_POST['userId']);
   
    if(isset($_POST['load'])){
         $sql ="SELECT * FROM user_details INNER JOIN users ON 
            users.user_id= user_details.user_id WHERE user_details.user_id='$userId'";
            $result = $conn->query($sql);
        if($result){ 
            $row = array();
            if($result->num_rows > 0){
                while($r = $result->fetch_array(MYSQLI_ASSOC)) {
                 $row = $r;
                }
                $success = array('success' => 1 );
                $user["user"] = $row;
                $response= array_merge($success,$user);
                echo json_encode($response);
            }else {
                $success = array('success' => 0 );
                $message = array('message' =>"update your profile" );
                $response = array_merge($success,$message);
                echo json_encode($response);
            }
    
        } else {
            $success = array('success' => 0 );
            $message = array('message' =>$conn->error );
            $response = array_merge($success,$message);
            echo json_encode($response);
        }
        $conn->close();
        return;
    }
    
      if(isset($_POST['loadMarchant'])){
         $sql ="SELECT * FROM users WHERE user_details.user_id='$userId'";
            $result = $conn->query($sql);
        if($result){ 
            $row = array();
            if($result->num_rows > 0){
                while($r = $result->fetch_array(MYSQLI_ASSOC)) {
                 $row = $r;
                }
                $success = array('success' => 1 );
                $user["user"] = $row;
                $response= array_merge($success,$user);
                echo json_encode($response);
            }else {
                $success = array('success' => 0 );
                $message = array('message' =>"update your profile" );
                $response = array_merge($success,$message);
                echo json_encode($response);
            }
    
        } else {
            $success = array('success' => 0 );
            $message = array('message' =>$conn->error );
            $response = array_merge($success,$message);
            echo json_encode($response);
        }
        $conn->close();
        return;
    }
    
     
    $userName = $conn->real_escape_string($_POST['userName']);
    $userPhone = $conn->real_escape_string($_POST['userPhone']);
    
    if(isset($_POST['updateMarchant'])){
         $sql =" UPDATE users SET fullname = '$userName', phone_no = '$userPhone' WHERE user_id='$userId'";
            $result = $conn->query($sql);
        if($result){ 
            $row = array();
            if($result->num_rows > 0){
                while($r = $result->fetch_array(MYSQLI_ASSOC)) {
                 $row = $r;
                }
                $success = array('success' => 1 );
                $user["user"] = $row;
                $response= array_merge($success,$user);
                echo json_encode($response);
            }else {
                $success = array('success' => 0 );
                $message = array('message' =>"update your profile" );
                $response = array_merge($success,$message);
                echo json_encode($response);
            }
    
        } else {
            $success = array('success' => 0 );
            $message = array('message' =>$conn->error );
            $response = array_merge($success,$message);
            echo json_encode($response);
        }
        $conn->close();
        return;
    }
    

    if(isset($_POST['bankName'])){
        $bankName = $conn->real_escape_string($_POST['bankName']);
        $accountName = $conn->real_escape_string($_POST['accountName']);
        $accountNumber = $conn->real_escape_string($_POST['accountNumber']);
        $sql ="SELECT * FROM user_details WHERE user_id='$userId'";

        $result = $conn->query($sql);
        if($result){
            if($result->num_rows > 0){
                $sql2 ="UPDATE user_details SET bank_name ='$bankName', account_name ='$accountName',
                account_number = '$accountNumber' WHERE user_id='$userId'; 
                UPDATE users SET fullname = '$userName', phone_no = '$userPhone' WHERE user_id='$userId'";
                $result2 = $conn->multi_query($sql2);
                if($result2){
                    $error = array('error'=>"");
                    $success = array('success' => 1 );
                    $message = array('message' =>"Update Successful." );
                    $response = array_merge($success,$message,$error);
                    echo json_encode($response);
                }else{
                    $success = array('success' => 0 );
                    $error = array('error'=>$conn->error);
                    $message = array('message' =>"" );
                    $response = array_merge($success,$message,$error);
                    echo json_encode($response);
                }
            }else {
                $sql2 = "INSERT INTO `user_details`(`user_id`, `bank_name`, `account_name`, `account_number`, 
                `company_name`, `company_regno`, `company_email`, `company_phone`, `referral_id`)
                VALUES ('$userId','$bankName','$accountName','$accountNumber','','','','','0');
                UPDATE users SET fullname = '$userName' ,phone_no = '$userPhone' WHERE user_id='$userId'";
                $result2 = $conn->multi_query($sql2);
                if($result2){
                    $error = array('error'=>"");
                    $success = array('success' => 1 );
                    $message = array('message' =>"Update Successful." );
                    $response = array_merge($success,$message,$error);
                    echo json_encode($response);
                }else{
                    $success = array('success' => 0 );
                    $error = array('error'=>$conn->error);
                    $message = array('message' =>"" );
                    $response = array_merge($success,$message,$error);
                    echo json_encode($response);
                }
            }
        }else{
            $success = array('success' => 0 );
            $error = array('error'=>$conn->error);
            $message = array('message' =>"" );
            $response = array_merge($success,$message,$error);
            echo json_encode($response);
        }
        $conn->close();
        return;
    }
   
    $companyName = $conn->real_escape_string($_POST['companyName']);
    $companyEmail = $conn->real_escape_string($_POST['companyEmail']);
    $companyPhone = $conn->real_escape_string($_POST['companyPhone']);
    $companyRegNo = $conn->real_escape_string($_POST['companyRegNo']);

    $sql ="SELECT * FROM user_details WHERE user_id='$userId'";

    $result = $conn->query($sql);
    if($result){
        if($result->num_rows > 0){
            $sql2 ="UPDATE user_details SET company_name ='$companyName', company_regno ='$companyRegNo',
                company_email = '$companyEmail', company_phone = '$companyPhone' WHERE user_id='$userId'; 
                UPDATE users SET fullname = '$userName', phone_no = '$userPhone' WHERE user_id='$userId'";
              $result2 = $conn->multi_query($sql2);
            if($result2){
                $error = array('error'=>"");
                $success = array('success' => 1 );
                $message = array('message' =>"Update Successful." );
                $response = array_merge($success,$message,$error);
                echo json_encode($response);
            }else{
                $success = array('success' => 0 );
                $error = array('error'=>$conn->error);
                $message = array('message' =>"" );
                $response = array_merge($success,$message,$error);
                echo json_encode($response);
            }
        }else {
           $sql2 = "INSERT INTO `user_details`(`user_id`, `bank_name`, `account_name`, `account_number`, 
           `company_name`, `company_regno`, `company_email`, `company_phone`, `referral_id`)
            VALUES ('$userId','','','','$companyName','$companyRegNo','$companyEmail','$companyPhone','0');
            UPDATE users SET fullname = '$userName' ,phone_no = '$userPhone' WHERE user_id='$userId'";
            $result2 = $conn->multi_query($sql2);
            if($result2){
                $error = array('error'=>"");
                $success = array('success' => 1 );
                $message = array('message' =>"Update Successful." );
                $response = array_merge($success,$message,$error);
                echo json_encode($response);
            }else{
                $success = array('success' => 0 );
                $error = array('error'=>$conn->error);
                $message = array('message' =>"" );
                $response = array_merge($success,$message,$error);
                echo json_encode($response);
            }
        }
    }else{
            $success = array('success' => 0 );
            $error = array('error'=>$conn->error);
            $message = array('message' =>"" );
            $response = array_merge($success,$message,$error);
            echo json_encode($response);
    }
      $conn->close();
?>