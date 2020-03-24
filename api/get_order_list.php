<?php
    include_once '../config/dbconnect.php';

    $userId= $conn->real_escape_string($_POST['userId']);
    $sql2= "SELECT * FROM  `orders`  WHERE user_id='$userId'";
    $result2 = $conn->query($sql2);
    if  ($result2){
        while($r = $result2->fetch_array(MYSQLI_ASSOC)) {
              $row = $r;
        }
        $success = array('success' => 1 );
        $order["order"] = $row;
        $response= array_merge($success,$order);
        echo json_encode($response);
         
    }
    else {
            $success = array('success' => 0 );
            $error = array('error'=> $conn->error);
            $response = array_merge($success,$error);
            echo json_encode($response);
    }
    $conn->close();

?>