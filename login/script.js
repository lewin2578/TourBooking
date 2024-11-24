// Quản lý popup đăng ký
const registerLink = document.getElementById('register-link');
const registerPopup = document.getElementById('popup-register');
const closeRegister = document.getElementById('close-register');

registerLink.addEventListener('click', (e) => {
    e.preventDefault();
    registerPopup.style.display = 'flex';
});
closeRegister.addEventListener('click', () => {
    registerPopup.style.display = 'none';
});

// Quản lý popup quên mật khẩu
const forgotPasswordLink = document.getElementById('forgot-password-link');
const forgotStep1 = document.getElementById('popup-forgot-step1');
const forgotStep2 = document.getElementById('popup-forgot-step2');
const forgotStep3 = document.getElementById('popup-forgot-step3');
const closeStep1 = document.getElementById('close-forgot-step1');
const closeStep2 = document.getElementById('close-forgot-step2');
const closeStep3 = document.getElementById('close-forgot-step3');
const sendToken = document.getElementById('send-token');
const verifyToken = document.getElementById('verify-token');

forgotPasswordLink.addEventListener('click', (e) => {
    e.preventDefault();
    forgotStep1.style.display = 'flex';
});

// Kiểm tra email popup quên mật khẩu bước 1
document.getElementById('send-token').addEventListener('click', function(e) {
    e.preventDefault();
    const emailInput = document.querySelector('#popup-forgot-step1 input[name="email"]');
    const email = emailInput.value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email === '') {
        alert('Vui lòng nhập email');
        return;
    }

    if (!emailRegex.test(email)) {
        alert('Email không đúng định dạng');
        return;
    }

    // Nếu email hợp lệ, chuyển sang bước tiếp theo
    forgotStep1.style.display = 'none';
    forgotStep2.style.display = 'flex';
});

// Kiểm tra token popup quên mật khẩu bước 2
document.getElementById('verify-token').addEventListener('click', function(e) {
    e.preventDefault();
    const tokenInput = document.querySelector('#popup-forgot-step2 input[name="token"]');
    const token = tokenInput.value.trim();

    if (token === '') {
        alert('Vui lòng nhập mã code');
        return;
    }

    // Nếu token hợp lệ, chuyển sang bước tiếp theo
    forgotStep2.style.display = 'none';
    forgotStep3.style.display = 'flex';
});

closeStep1.addEventListener('click', () => {
    forgotStep1.style.display = 'none';
});
sendToken.addEventListener('click', () => {
    forgotStep1.style.display = 'none';
    forgotStep2.style.display = 'flex';
});

closeStep2.addEventListener('click', () => {
    forgotStep2.style.display = 'none';
});
verifyToken.addEventListener('click', () => {
    forgotStep2.style.display = 'none';
    forgotStep3.style.display = 'flex';
});

closeStep3.addEventListener('click', () => {
    forgotStep3.style.display = 'none';
});