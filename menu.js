// hambuerger menu

var menu = document.getElementById("menu-toggle");
var menuItems = document.getElementById("menu");

var menuStatus = 0;
menu.addEventListener("click", ()=> {
    menuItems.classList.toggle("active");
    if (menuStatus == 0) {
        menu.style = "transform: rotate(90deg)";
        menuStatus = 1;
    } else if (menuStatus == 1) {
        menu.style = "transform: rotate(0deg)";
        menuStatus = 0;
    }
});

window.addEventListener("click", event=> {
    if (event.target === menuItems) {
        menu.style = "transform: rotate(0deg);";
        menuStatus = 0;
        menuItems.classList.remove("active");
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
            if (activeMenu !== null && activeMenu !== weaponsMenu[index]) {
                activeMenu.classList.remove("activeWeapons"); 
            }
            if (activeWeapon !== null && activeWeapon !== element) {
                activeWeapon.style.borderBottom = "";
            }
            if (weaponsMenu[index].classList.contains("activeWeapons")) {
                weaponsMenu[index].classList.remove("activeWeapons");
                activeMenu = null;
                activeWeapon = null;
            } else {
                weaponsMenu[index].classList.add("activeWeapons");
                activeMenu = weaponsMenu[index];
                element.style.borderBottom = "solid 2px white";
                activeWeapon = element; 
            }
        });

        weaponsMenu[index].querySelectorAll('.item').forEach((item) => {
            item.addEventListener('click', () => {
                weaponsMenu.forEach(menu => menu.classList.remove("activeWeapons"));
                activeMenu = null;
                if (activeWeapon) {
                    activeWeapon.style.borderBottom = "";
                }
                activeWeapon = null;
                // Hide the menu in responsive version
                menuItems.classList.remove("active");
                menu.style = "transform: rotate(0deg)";
                menuStatus = 0;
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

