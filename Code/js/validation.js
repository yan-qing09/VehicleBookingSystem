document.getElementById('registrationForm').addEventListener('submit', function(event) {
    var password1 = document.getElementById('exampleInputPassword1').value;
    var password2 = document.getElementById('exampleInputPassword2').value;

    if (password1 !== password2) {
        document.getElementById('passwordError').innerHTML = 'Passwords do not match';
        event.preventDefault();
    } else {
        document.getElementById('passwordError').innerHTML = '';
    }
});






