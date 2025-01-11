// hambuerger menu

var menu = document.getElementById("menu-toggle");
var menuItems = document.getElementById("menu");

var menuStatus = 0;
menu.addEventListener("click", () => {
    menuItems.classList.toggle("active");
    if (menuItems.classList.contains("active")) {
        menuItems.classList.remove("inactive");
    } else {
        menuItems.classList.add("inactive");
    }
    if (menuStatus == 0) {
        menu.style = "transform: rotate(90deg)";
        menuStatus = 1;
    } else if (menuStatus == 1) {
        menu.style = "transform: rotate(0deg)";
        menuStatus = 0;
    }
});

window.addEventListener("click", event => {
    if (event.target === menuItems) {
        menu.style = "transform: rotate(0deg)";
        menuStatus = 0;
        menuItems.classList.remove("active");
        menuItems.classList.add("inactive");
    }
});

var searchBox = document.getElementById("search-box");
var searchInput = document.querySelector(".search input");

searchInput.addEventListener("input", () => {
    if (searchInput.value.trim() === "") {
        searchBox.classList.add("hidden");
    } else {
        searchBox.classList.remove("hidden");
    }
});

// Navigation (HEADER)
var weapons = document.querySelectorAll(".weapons"); 
var activeMenu = null;
var activeWeapon = null; 

weapons.forEach((element, index) => {
    var weaponsMenu = document.querySelectorAll(".weaponsMenu"); 
    if (weaponsMenu[index]) {
        element.addEventListener("click", () => {
            if (window.innerWidth > 1153) { // Only apply for non-responsive versions
                if (activeMenu !== null && activeMenu !== weaponsMenu[index]) {
                    activeMenu.classList.remove("activeWeapons");
                    activeMenu.classList.add("inactiveWeapons");
                }
                if (activeWeapon !== null && activeWeapon !== element) {
                    activeWeapon.style.borderBottom = "";
                }
                if (weaponsMenu[index].classList.contains("activeWeapons")) {
                    weaponsMenu[index].classList.remove("activeWeapons");
                    weaponsMenu[index].classList.add("inactiveWeapons");
                    element.style.borderBottom = ""; // Remove the style from the clicked element
                    activeMenu = null;
                    activeWeapon = null;
                } else {
                    weaponsMenu[index].classList.remove("inactiveWeapons");
                    weaponsMenu[index].classList.add("activeWeapons");
                    activeMenu = weaponsMenu[index];
                    element.style.borderBottom = "solid 2px white";
                    activeWeapon = element; 
                }
            } else { // Apply for responsive versions
                if (weaponsMenu[index].classList.contains("activeWeapons")) {
                    weaponsMenu[index].classList.remove("activeWeapons");
                    weaponsMenu[index].classList.add("inactiveWeapons");
                } else {
                    weaponsMenu[index].classList.remove("inactiveWeapons");
                    weaponsMenu[index].classList.add("activeWeapons");
                }
            }
        });

        weaponsMenu[index].querySelectorAll('.item').forEach((item) => {
            item.addEventListener('click', () => {
                if (window.innerWidth > 1153) { // Only apply for non-responsive versions
                    weaponsMenu.forEach(menu => {
                        menu.classList.remove("activeWeapons");
                        menu.classList.add("inactiveWeapons");
                    });
                    activeMenu = null;
                    if (activeWeapon) {
                        activeWeapon.style.borderBottom = "";
                    }
                    activeWeapon = null;
                    // Hide the menu in responsive version
                    menuItems.classList.remove("active");
                    menu.style = "transform: rotate(0deg)";
                    menuStatus = 0;
                } else { // Apply for responsive versions
                    weaponsMenu[index].classList.remove("activeWeapons");
                    weaponsMenu[index].classList.add("inactiveWeapons");
                    // Hide the weapons menu
                    menuItems.classList.remove("active");
                    menuItems.classList.add("inactive");
                    menu.style = "transform: rotate(0deg)";
                    menuStatus = 0;
                }
            });
        });
    }
});

//scroll
var scroll = document.querySelectorAll(".weaponsMenu");
scroll.forEach(menu => {
    menu.addEventListener("wheel", (event) => { 
        event.preventDefault();
        if (menuItems.classList.contains("active")) {
            menu.scrollTop += event.deltaY;
        } else {
            menu.scrollLeft += event.deltaY;
        }
    });
});

