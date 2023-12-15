function handleLogin(event) {
    event.preventDefault();

    const formData = new FormData(event.target);
    fetch('../src/api/login.php', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            if (data.success) {
                window.location.href = 'http://localhost/mycalculator/public/calculator.html';
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            // console.error('Login error:', error);
            alert('An error occurred. Check the console for more information.');
        });
}

document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }
});
