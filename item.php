<?php
    $conn = new mysqli("localhost", "root", "", "csgo");
    if ($conn -> connect_error) {
        die("Connection failed: " . $conn -> connect_error);
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['item'])) {
        $item = $conn -> real_escape_string($_POST['item']);
        $sql = "SELECT DISTINCT 
                weapons.item, 
                weapons.skin_name, 
                collection.collection_name,  
                cases.case_name
                FROM 
                    weapons
                JOIN collection 
                    ON weapons.item = collection.item AND weapons.skin_name = collection.skin_name
                JOIN cases 
                    ON weapons.item = cases.item AND weapons.skin_name = cases.skin_name
                WHERE weapons.item = '$item'";

        if ($result = $conn -> query($sql)) {
            if($result -> num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<a href='index.php?item={$_POST['item']}&skin_name={$row['skin_name']}' class='box-item'>
                            <p>{$row['skin_name']}</p>
                            <img src='./item_img/{$_POST['item']}/{$row['skin_name']}.png' alt='{$row['skin_name']}' class='item-img'>
                            <p><img src='./item_img/case/{$row['case_name']}.png' alt='{$row['case_name']}' class='item-img-case'> {$row['case_name']}</p>
                        </a>";   
                }
            } else {
                echo "0 results";
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . $conn -> error;
        }
    }
?>