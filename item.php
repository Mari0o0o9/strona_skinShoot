<?php
    $conn = new mysqli("localhost", "root", "", "csgo");
    if ($conn -> connect_error) {
        die("Connection failed: " . $conn -> connect_error);
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['category'])) {
        $category = $conn -> real_escape_string($_POST['category']);
        $sql = "SELECT *
                FROM `$category`";

        if ($result = $conn -> query($sql)) {
            if($result -> num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<a href='index.php?category={$_POST['category']}&item={$row['skin_name']}' class='box-item'>
                            <p>{$row['skin_name']}</p>
                            <img src='./item_img/{$_POST['category']}/{$row['skin_name']}.png' alt='{$row['skin_name']}'>
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