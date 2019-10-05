var menu_active = false;



function menu() {
    var sidebar = document.querySelector(".sidebar_left");
    if (menu_active === false) {
        sidebar.style.display = "block";
        menu_active = true;
    }
    else {
        sidebar.style.display = "none";
        menu_active = false;
    }
}