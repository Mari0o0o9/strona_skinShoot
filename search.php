<?php
    $conn = new mysqli("localhost", "root", "", "csgo");
    if ($conn -> connect_error) {
        die("Connection failed: " . $conn -> connect_error);
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['search'])) {
        $category = $conn -> real_escape_string($_POST['search']);
        $sql = "SELECT `$search`
                FROM *";

        if ($result = $conn -> query($sql)) {
            if($result -> num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='box-item'>
                            <p>{$row['skin_name']}</p>
                            <img src='./item_img/{$category}/{$row['skin_name']}.png' alt='{$row['skin_name']}'>
                        </div>";   
                }
            } else {
                echo "0 results";
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . $conn -> error;
        }
    }
?>