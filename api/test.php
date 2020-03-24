<html>
<head></head>
<body>

<form method="Post"  action='test.php'>
<?php
include_once '../config/dbconnect.php';
//"SELECT * FROM products as p,product_details as pd WHERE p.product_id = pd.product_id ";

$sql ="SELECT * fROM admin";

    $result = $conn->query($sql);
    $row = array();
    if ($result){
        if($result->num_rows > 0){
            echo "<table>";
            $i = 1;
           while($r = $result->fetch_array(MYSQLI_ASSOC)) {
              echo '<tr><td><input type="text" name="name'.$i.'" value="'.$r["name"].'"></td><td><input type="text name="state_code'.$i.'" value="'.$r['state_code'].'"/></td></tr>';
              $i = $i+1;
            }
            echo '<tr><td><input name="submit" type="submit"/></td></tr></table>';
         
        }else{
            
        }
    }else{
         
    }
    $conn->close();
?>
</form>
</body>
</html>