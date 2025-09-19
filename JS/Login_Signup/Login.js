const container = document.getElementById('container');
const signupBtn = document.getElementById('sign-up');
const loginBtn = document.getElementById('login');

signupBtn.addEventListener('click', () => {
    container.classList.add("active");
    document.title = "Đăng kí tài khoản";
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
    document.title = "Đăng nhập";
});
