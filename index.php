<?php
    $conn = new mysqli("localhost", "root", "","csgo");
    if ($conn -> connect_error) {
        die("Connection failed: " . $conn -> connect_error);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkinShoot</title>
    <link rel="stylesheet" href="main.css">
    <link rel="shortcut icon" href="./image/logo.ico" type="image/x-icon">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- font -->

    <!-- icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <!-- icons -->
</head>
<body>
    <header>
        <section class="logo">
            <a href="./index.php">
                <img src="./image/logo.png" alt="SkinShoot">
            </a>
        </section>
        <section class="search">
            <label for="searchBox" class="material-symbols-outlined">search</label>
            <input id="searchBox" type="text" placeholder="Search..." onkeyup="SearchItem(this.value)">
        </section>
        <section class="menu" id="menu">
            <div class="weapons">Pistols</div>
            <ul class="weaponsMenu">
                <li class="item">ALL</li>
                <li class="item">CZ75-Auto</li>
                <li class="item">Desert Eagle</li>
                <li class="item">Dual Berettas</li>
                <li class="item">Five-SeveN</li>
                <li class="item">Glock-18</li>
                <li class="item">P2000</li>
                <li class="item">P250</li>
                <li class="item">R8 Revolver</li>
                <li class="item">Tec-9</li>
                <li class="item">USP-S</li>
                <li class="item">Zeus x27</li>
            </ul>
            
            <div class="weapons">SMGs</div>
            <ul class="weaponsMenu">
                <li class="item">MAC-10</li>
                <li class="item">MP5-SD</li>
                <li class="item">MP7</li>
                <li class="item">MP9</li>
                <li class="item">P90</li>
                <li class="item">PP-Bizon</li>
                <li class="item">UMP-45</li>
            </ul>

            <div class="weapons">Shootguns</div>
            <ul class="weaponsMenu">
                <li class="item">MAG-7</li>
                <li class="item">Nova</li>
                <li class="item">Sawed-Off</li>
                <li class="item">XM1014</li>
            </ul>

            <div class="weapons">Machine Guns</div>
            <ul class="weaponsMenu">
                <li class="item">M249</li>
                <li class="item">Negev</li>
            </ul>

            <div class="weapons">Assault Rifles</div>
            <ul class="weaponsMenu">
                <li class="item">AK-47</li>
                <li class="item">AUG</li>
                <li class="item">FAMAS</li>
                <li class="item">Galil AR</li>
                <li class="item">M4A1-S</li>
                <li class="item">M4A4</li>
                <li class="item">SG553</li>
            </ul>

            <div class="weapons">Sniper Rifles</div>
            <ul class="weaponsMenu">
                <li class="item">AWP</li>
                <li class="item">G3SG1</li>
                <li class="item">SCAR-20</li>
                <li class="item">SSG 08</li>
            </ul>

            <div class="weapons">Knife</div>
            <ul class="weaponsMenu">
                <li class="item">Bayonet</li>
                <li class="item">Bowie Knife</li>
                <li class="item">Butterfly Knife</li>
                <li class="item">Classic Knife</li>
                <li class="item">Falchion Knife</li>
                <li class="item">Flip Knife</li>
                <li class="item">Gut Knife</li>
                <li class="item">Huntsman Knife</li>
                <li class="item">Karambit</li>
                <li class="item">Kukri Knife</li>
                <li class="item">M9 Bayonet</li>
                <li class="item">Navaja Knife</li>
                <li class="item">Nomada Knife</li>
                <li class="item">Paracord Knife</li>
                <li class="item">Shadow Daggers</li>
                <li class="item">Skeleton Knife</li>
                <li class="item">Stiletto Knife</li>
                <li class="item">Survival Knife</li>
                <li class="item">Talon Knife</li>
                <li class="item">Ursus Knife</li>
            </ul>

            <div class="weapons">Gloves</div>
            <ul class="weaponsMenu">
                <li class="item">Bloodhound Gloves</li>
                <li class="item">Broken Fang Gloves</li>
                <li class="item">Driver Gloves</li>
                <li class="item">Hand Wraps</li>
                <li class="item">Hydra Gloves</li>
                <li class="item">Moto Gloves</li>
                <li class="item">Specialist Gloves</li>
                <li class="item">Sport Gloves</li>
            </ul>
        </section>
        <section class="menu-toggle" id="menu-toggle">&#9776;</section>
    </header>
    <section id="center">
        <script>
            var item = document.querySelectorAll('.item');
            item.forEach((element, index) => {
                element.addEventListener('click', function() {
                    showWeaponsByCategory(element.innerHTML);
                })
            });

            function showWeaponsByCategory(category) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('center').innerHTML = this.responseText;
                    } else {
                        console.error("Błąd: " + this.status + " - " + this.statusText);
                    }
                };
                xhttp.open("POST", "item.php", true);
                xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhttp.send("category=" + encodeURIComponent(category.toLowerCase()));
            }

            function SearchItem() {
                var searchBox = document.getElementById('searchBox').value;
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('center').innerHTML = this.responseText;
                    } else {
                        console.error("Błąd: " + this.status + " - " + this.statusText);
                    }
                };
                xhttp.open("POST", "search.php", true);
                xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhttp.send("search=" + encodeURIComponent(searchBox.toLowerCase()));
            }
        </script>
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['category']) && isset($_GET['item'])) {
                $category = $conn -> real_escape_string($_GET['category']);
                $item = $conn -> real_escape_string($_GET['item']);
                $sql = "SELECT *
                        FROM `$category`
                        WHERE skin_name = '$item'";

                if ($result = $conn -> query($sql)) {
                    if($result -> num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<div class='box-item'>
                                    <img src='./item_img/{$category}/{$row['skin_name']}.png' alt='{$row['skin_name']}'>
                                    <p>{$row['skin_name']}</p>
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
    </section>
    <footer>

    </footer>
</body>
<script src="./menu.js"></script>
</html>