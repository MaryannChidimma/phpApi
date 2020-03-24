<?php

    include_once '../config/dbconnect.php';

    $userId = $conn->real_escape_string($_POST['userId']);
    
    $sql = "SELECT * FROM request WHERE user_id = '$userId'";
    $result = $conn->query($sql);

     if  ($result)
    {
        if($result->num_rows > 0){
           while($r = $result->fetch_array(MYSQLI_ASSOC)) {
              $row[] = $r;
            }
            $success = array('success' => 1 );
            $record["records"] = $row;
            $response= array_merge($success,$record);
            echo json_encode($response);
         
        }
        else {
            $success = array('success' => 0 );
            $error = array('error'=>"");
            $message = array('message' =>"No record found." );
            $response = array_merge($success,$message,$error);
            echo json_encode($response);
        }
       //
    } 
    else {
        $success = array('success' => 0 );
        $error = array('error'=>$conn->error);
        $message = array('message' =>"" );
        $response = array_merge($success,$message,$error);
        echo json_encode($response);
    }

 $conn->close();
    
?>