let container = document.getElementById('container')

toggle = () => {
	container.classList.toggle('sign-in')
	container.classList.toggle('sign-up')
}

setTimeout(() => {
	container.classList.add('sign-in')
}, 200)
document.addEventListener('DOMContentLoaded', () => {
    let container = document.getElementById('container');
    let modal = document.getElementById('success-modal');
    let closeBtn = document.querySelector('.close-btn');
    let loginBtn = document.getElementById('login-btn'); // Assuming you have a login button

    modal.style.display='none'; 
    console.log(loginBtn)

    // Hàm toggle giữa sign-in và sign-up
    toggle = () => {
        container.classList.toggle('sign-in');
        container.classList.toggle('sign-up');
    };

    // Hiển thị modal sau khi đăng nhập thành công
    function showSuccessModal(message) {
        modal.querySelector('p').textContent = message; // Cập nhật thông báo
        modal.style.display = 'block';
    }

    // Đóng modal khi người dùng bấm nút "X"
    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Ẩn modal khi người dùng bấm bên ngoài modal
    window.addEventListener('click', (event) => {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });

    // Hiển thị modal sau khi nhấn nút đăng nhập
    loginBtn.addEventListener('click', () => {
        container.classList.add('sign-in');
        showSuccessModal('Đăng nhập thành công!');
    });
});

