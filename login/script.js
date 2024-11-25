// Slideshow functionality
let currentSlide = 0;
const slides = document.querySelectorAll('.slideshow img');
let slideInterval;

function showNextSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
}

// Change slide every 3 seconds
slideInterval = setInterval(showNextSlide, 3000);

// Cleanup khi component unmount
function cleanup() {
    clearInterval(slideInterval);
}

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
// const sendToken = document.getElementById('send-token');
// const verifyToken = document.getElementById('verify-token');

closeStep1.addEventListener('click', () => {
    forgotStep1.style.display = 'none';
});

closeStep2.addEventListener('click', () => {
    forgotStep2.style.display = 'none';
});

closeStep3.addEventListener('click', () => {
    forgotStep3.style.display = 'none';
});

// Đóng popup khi click outside
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('popup')) {
        e.target.style.display = 'none';
    }
});

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

    const formData = new FormData();
    formData.append('email', email);

    fetch('forgot_password.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            if (data === 'Mã xác nhận đã được gửi đến email của bạn!') {
                forgotStep1.style.display = 'none';
                forgotStep2.style.display = 'flex';
            } else {
                alert(data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Đã xảy ra lỗi. Vui lòng thử lại sau!');
        });
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

    const formData = new FormData();
    formData.append('token', token);

    fetch('forgot_password.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            if (data === 'Mã xác nhận hợp lệ! Vui lòng đặt lại mật khẩu mới.') {
                forgotStep2.style.display = 'none';
                forgotStep3.style.display = 'flex';
            } else {
                alert(data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Đã xảy ra lỗi. Vui lòng thử lại sau!');
        });
});

// Xử lý đặt lại mật khẩu bước 3
document.getElementById('reset-password').addEventListener('click', function(e) {
    e.preventDefault();
    const passwordInput = document.querySelector('#popup-forgot-step3 input[name="password"]');
    const confirmPasswordInput = document.querySelector('#popup-forgot-step3 input[name="confirm_password"]');
    const password = passwordInput.value.trim();
    const confirmPassword = confirmPasswordInput.value.trim();

    if (password === '' || confirmPassword === '') {
        alert('Vui lòng nhập đầy đủ thông tin');
        return;
    }

    if (password !== confirmPassword) {
        alert('Mật khẩu không khớp');
        return;
    }

    const formData = new FormData();
    formData.append('password', password);
    formData.append('confirm_password', confirmPassword);

    fetch('reset_password.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            if (data === 'Đặt lại mật khẩu thành công!') {
                alert(data);
                forgotStep3.style.display = 'none';
            } else {
                alert(data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Đã xảy ra lỗi. Vui lòng thử lại sau!');
        });
});
