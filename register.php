<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Quicksand:wght@300..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style3.css">
    <script src="https://kit.fontawesome.com/d3ec5829fc.js" crossorigin="anonymous"></script>
    <title>Create Account</title>
</head>

<body>
    <div class="background"></div> <!-- Background overlay -->
    <div class="form-container"> <!-- Form container -->
        <form action="processdata.php" method="POST">
            <div class="text">
                <h2>Register Here!</h2>
            </div>
            <br>
            <div class="entryarea">
                <input type="text" name="username" id="username" required>
                <label for="username" class="labelline">Enter Username</label>
                <i class="fa-regular fa-user"></i>
            </div>
            <br>
            <div class="entryarea">
                <input type="text" name="firstname" id="firstname" required>
                <label for="firstname" class="labelline">Enter Firstname</label>
                <i class="fa-regular fa-user"></i>
            </div>
            <br>
            <div class="entryarea">
                <input type="text" name="lastname" id="lastname" required>
                <label for="lastname" class="labelline">Enter Lastname</label>
                <i class="fa-regular fa-user"></i>
            </div>
            <br>
            <div class="entryarea">
                <input type="text" name="mobile" id="mobile" required>
                <label for="mobile" class="labelline">Enter Mobile Number</label>
                <!--<i class="fa-solid fa-phone"></i>-->
            </div>
            <br>
            <div class="entryarea">
                <input type="password" name="password" id="password" required>
                <label for="password" class="labelline">Enter Password</label>
                <i class="fa-regular fa-eye" id="togglePassword"></i>
            </div>
            
            <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <!--<option value="admin">Admin</option>-->
                    <option value="doctor">Doctor</option>
                    <option value="project_director">Project Director</option>
                </select><br>
            <div>
                <button type="submit">Submit</button>
            </div>
            <hr>
                <p>Already registered, Login in <a href="doctorlogin.php"> Here</a></p>
        </form>
    </div>

    <script>
        // Toggle password visibility
        const togglePassword = document.querySelector("#togglePassword");
        const passwordField = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);

            // Toggle eye icon
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });
    </script>
</body>
</html>
