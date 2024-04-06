<?php

require_once 'config.php';
require_once 'head.php';
require_once 'includes/header.php';

// Initialize the login error message variable
$logInErrorMsg = '';

if (isset($_POST['submit'])) {
    // Check if email is empty
    if (empty($_POST['email'])) {
        $logInErrorMsg = 'You must enter an email!';
    } elseif (empty($_POST['password'])) {
        // Check if password is empty
        $logInErrorMsg = 'You must enter a password!';
    } else {
        // Retrieve the submitted email and password
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare the SQL statement to retrieve user information based on email

        $stmt = "SELECT * FROM users_hashed WHERE email = :email";
        $prepStmt = $myPDO->prepare($stmt);
        $prepStmt->execute(['email' => $email]);

        $row = $prepStmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Verify the password using SHA256 hashing algorithm
            $hashed_password = hash('sha256', $password);

            // Check if the hashed password matches the stored hashed password
            if ($hashed_password === $row['hashed_password']) {
                // Start the session and set session variables
                session_start();
                $_SESSION['logged'] = true;
                $_SESSION['name'] = $row['name']; // For potential future use
                $_SESSION['id'] = $row['id'];
                // Redirect to the account page
                header("Location: account.php");
                exit();
            } else {
                $logInErrorMsg = 'Invalid email or password.';
            }
        } else {
            $logInErrorMsg = 'Invalid email or password.';
        }
        // Both error messages display the same to avoid giving potential hackers the opportunity to tell
        // If an email is registered or not
    }
}
?>

<main class="signin_page_grid_container">
    <div class="park_img">
        <img src="Includes/images/AlgonquinPark.png" alt="Algonquin Park Image">
    </div>
    <div class="form_container">
        <form action="" method="post">
            <label for="email">Email</label> <!-- Changed from 'Name' to 'Email' -->
            <input type="text" id="email" name="email">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <!-- Display the login error message -->
            <div><span style='color: red;'><?php echo htmlspecialchars($logInErrorMsg); ?></span></div> <!-- Prevent XSS -->
            <input class="signin_page_submit_btn" type="submit" name="submit" value="Submit">
        </form>
        <a href="signup.php" class="signUp">Sign Up for New Account</a>
    </div>
</main>

<?php
require_once 'Includes/footer.php';
?>