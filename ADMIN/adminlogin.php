<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Quicksand:wght@300..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <script src="https://kit.fontawesome.com/d3ec5829fc.js" crossorigin="anonymous"></script>
    <title>Log in</title>
</head>
<body>
    <div class="background"></div> <!-- Background overlay -->
    <div class="form-container"> <!-- Form container -->
        <form action="validatedata.php" method="GET">
            <div class="text">
                <h2>Login Form</h2>
            </div>
            <br>
            <div class="entryarea">
                <input type="text" name="username" id="username" required>
                <div class="labelline">Enter Username</div>
                <i class="fa-regular fa-user" id="fa-user"></i>
            </div>
            <br>
            <div class="entryarea">
                <input type="password" name="password" id="password" required>
                <div class="labelline">Enter Password</div>
                <i class="fa-regular fa-eye" id="togglePassword"></i> <!-- Password visibility icon -->
            </div>
            <div class="remember-me">
                <input type="checkbox" id="rememberMe">
                <label for="rememberMe">Remember me</label>
            </div>
            <button type="submit" id="loginButton">LOGIN</button>
            
        </form>
    </div>


    <script>

document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordField = document.getElementById('password');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash'); // Change icon if needed
});

    </script>
</body>
</html>
