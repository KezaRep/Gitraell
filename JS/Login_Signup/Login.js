// Login.js
const container = document.getElementById('container');
const signupBtn = document.getElementById('signupBtn'); // nút Đăng kí
const loginBtn = document.getElementById('loginBtn');   // nút Đăng nhập

// Khi nhấn nút Đăng kí ở panel bên phải
signupBtn.addEventListener('click', () => {
    container.classList.add("active"); // bật form sign-up
    document.title = "Đăng kí tài khoản";
});

// Khi nhấn nút Đăng nhập ở panel bên trái
loginBtn.addEventListener('click', () => {
    container.classList.remove("active"); // trở về form sign-in
    document.title = "Đăng nhập";
});
