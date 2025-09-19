const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
    document.title = "Đăng nhập";
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
    document.title = "Đăng kí";
});
