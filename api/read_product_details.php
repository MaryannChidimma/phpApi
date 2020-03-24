<?php
    include_once '../config/dbconnect.php';

    $id = $_POST["id"];

    $sql = $conn->prepare("SELECT * fROM product_details WHERE `product_id` =?");
    $sql->bind_Param('i',$id);
    $sql->execute();
    $result = $sql->get_result();

    $row = array();
    if ($result){
        if($result->num_rows > 0){
           while($r = $result->fetch_array(MYSQL_ASSOC)) {
              $row[] = $r;
            }
            $success = array('success' => 1 );
            $product["products"] = $row;
            $response= array_merge($success,$product);
            echo json_encode($response);
         
        }else{
            $success = array('success' => 0 );
            $product["products"] = $row;
            $response= array_merge($success,$product);
            echo json_encode($response);
        }
    }else{
        $success = array('success' => 3 );
        $response= array_merge($success);
        echo json_encode($response);    
    }
    $conn->close();
?>