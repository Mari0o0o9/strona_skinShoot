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
                containers.container_name
                FROM 
                    weapons
                JOIN collection 
                    ON weapons.item = collection.item AND weapons.skin_name = collection.skin_name
                JOIN cases 
                    ON weapons.item = cases.item AND weapons.skin_name = cases.skin_name
                JOIN containers
                    ON weapons.item = containers.item AND weapons.skin_name = containers.skin_name
                WHERE weapons.item = '$item'";

        if ($result = $conn -> query($sql)) {
            if($result -> num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<a href='index.php?item={$_POST['item']}&skin_name={$row['skin_name']}' class='box-item'>
                            <p>{$row['skin_name']}</p>
                            <img src='./item_img/{$_POST['item']}/{$row['skin_name']}.png' alt='{$row['skin_name']}' class='item-img'>";
                            if ($row['case_name'] == null) {
                                echo "<p><img src='./item_img/collection/{$row['collection']}.png' alt='{$row['collection']}' class='item-img-case'> {$row['collection']}</p>";
                            } elseif ($row['case_name'] == null && $row['container_name'] != null) {
                                echo "<p><img src='./item_img/container/{$row['container_name']}.png' alt='{$row['container_name']}' class='item-img-case'> {$row['container_name']}</p>";
                            } elseif ($row['container_name'] != null && is_array($row['container_name']) && count($row['container_name']) > 1) {
                                $number = count($row['container_name']);
                                echo "<p>Found in {$number} containers</p>";
                            } else {
                                echo "<p><img src='./item_img/case/{$row['case_name']}.png' alt='{$row['case_name']}' class='item-img-case'> {$row['case_name']}</p>";
                            }
                    echo "</a>";   
                }
            } else {
                echo "0 results";
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . $conn -> error;
        }
    }
?>