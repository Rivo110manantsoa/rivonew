let body = document.body;
// show profile on click
let profile = document.querySelector(".header .flex .profile");
document.querySelector("#user-btn").onclick = () =>{
    profile.classList.toggle("active");
    form_search.classList.remove("active");
}
// show form-search on click
let form_search = document.querySelector(".header .flex .form-search");
document.querySelector("#search-btn").onclick = () =>{
    form_search.classList.toggle("active");
    profile.classList.remove("active");
}

// show sidebar
let sidebar = document.querySelector(".sidebar");
document.querySelector("#menu-btn").onclick = () => {
    sidebar.classList.toggle('active');
    body.classList.toggle('active');
}

// hide sidebar
document.querySelector('.sidebar .close-sidebar').onclick = () => {
    sidebar.classList.remove('active');
    body.classList.remove('active');
}

window.onscroll = () => {
    profile.classList.remove('active');
    form_search.classList.remove('active');

    if (window.innerWidth < 1200) {
        sidebar.classList.remove('active');
        body.classList.remove('active');
    }

}

// dark and light mode
let switchModeBtn = document.querySelector('#switch-mode-btn'); 
let darkMode = localStorage.getItem('dark-mode');

const DarkMode = () => {
    switchModeBtn.classList.replace('fa-sun','fa-moon');
    body.classList.add('dark');
    localStorage.setItem('dark-mode','enabled');
}
const LightMode = () => {
    switchModeBtn.classList.replace('fa-moon','fa-sun');
    body.classList.remove('dark');
    localStorage.setItem('dark-mode','disabled');
}

if (darkMode == 'enabled') {
    DarkMode();
}

switchModeBtn.onclick = () => {
    let darkMode = localStorage.getItem('dark-mode');
    if (darkMode == 'disabled') {
        DarkMode();
    } else {
        LightMode();
    }
}
