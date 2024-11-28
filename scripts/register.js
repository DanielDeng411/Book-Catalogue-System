function validateForm() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const errorElement = document.getElementById('passwordError');
    const email =document.getElementById('email').value;

    const emailPattern = /^[a-zA-Z0-9]+\@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(email)) {
        errorElement.textContent = 'Email address should be in the format: xxx@xxx.xxx';
        return false;
    }
    if (password.length < 6) {
        errorElement.textContent = 'Password length must be at least 6 characters!';
        return false;
    }
    if (password !== confirmPassword) {
        errorElement.textContent = 'Passwords do not match!';
        return false;
    }
    
    errorElement.textContent = '';
    return true;
}
