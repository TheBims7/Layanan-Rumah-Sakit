let menuList = document.getElementById("menuList")
menuList.style.maxHeight = "0px";
const header = document.querySelector("header");

function toggleMenu(){
    if(menuList.style.maxHeight == "0px"){
        menuList.style.maxHeight = "300px";
        header.classList.add("active");
    }
    else{
        menuList.style.maxHeight = "0px";
        setTimeout(() => {
            header.classList.remove("active");
        }, 500);
    }
}

function showPopup() {
    document.getElementById('popup').style.display = 'block';
}

function hidePopup() {
    document.getElementById('popup').style.display = 'none';
}

function logout() {
    window.location.href = '../logout.php'; // Arahkan ke file logout PHP
}