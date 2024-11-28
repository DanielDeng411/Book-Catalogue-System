function validateForm() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const errorElement = document.getElementById('passwordError');
    if (password.length < 6) {
        errorElement.textContent = 'Password length must be at least 6 characters!';
        return false;
    }
    if (password !== confirmPassword) {
        errorElement.textContent = 'Passwords do not match!';
        return false;
    }
    
    errorElement.textContent = '';
    document.getElementById('registerForm').submit();
    return true;
}
