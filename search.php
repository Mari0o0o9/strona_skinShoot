<?php
    $conn = new mysqli("localhost", "root", "", "csgo");
    if ($conn -> connect_error) {
        die("Connection failed: " . $conn -> connect_error);
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['search'])) {
        $search = trim($conn -> real_escape_string($_POST['search']));
        $search = str_replace('-', '', $search); // Remove hyphens
        $searchParts = explode(' ', $search);

        if(!empty($search)) {
            if (count($searchParts) > 1) {
                $sql = "SELECT *
                    FROM weapons
                    WHERE (REPLACE(LOWER(item), '-', '') LIKE LOWER('%{$searchParts[0]}%') AND REPLACE(LOWER(skin_name), '-', '') LIKE LOWER('%{$searchParts[1]}%'))
                    OR (REPLACE(LOWER(item), '-', '') LIKE LOWER('%{$searchParts[1]}%') AND REPLACE(LOWER(skin_name), '-', '') LIKE LOWER('%{$searchParts[0]}%'))
                    LIMIT 5";
            } else {
                $sql = "SELECT *
                    FROM weapons
                    WHERE REPLACE(LOWER(item), '-', '') LIKE LOWER('%{$search}%') OR REPLACE(LOWER(skin_name), '-', '') LIKE LOWER('%{$search}%')
                    LIMIT 5";
            }

            if ($result = $conn -> query($sql)) {
                if($result -> num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<a href='./index.php?item={$row['item']}&skin_name={$row['skin_name']}' class='search-item'>
                               <img src='./item_img/{$row['item']}/{$row['skin_name']}.png' alt='{$row['skin_name']}' class='img-search-item'>" . strtoupper($row['item']) . " - " . ucwords($row['skin_name']) .
                         "</a>";   
                    }
                } else {
                    echo "No Results"; 
                }
            } 
        } else {
            echo "No Results"; 
        }
    }
?>