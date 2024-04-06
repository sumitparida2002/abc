<?php

require_once 'config.php';
require_once 'head.php';
require_once 'includes/header.php';

// Initialize the sign-up error message variable
$signUpErrorMsg = '';

if (isset($_POST['submit'])) {
    // Check if all fields are filled
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])) {
        $signUpErrorMsg = 'All fields are required!';
    } else {
        // Retrieve the submitted values
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Hash the password using SHA256
        $hashed_password = hash('sha256', $password);

        try {
            // Prepare the SQL statement to insert user data

            $stmt = "INSERT INTO users_hashed (name, email, hashed_password) VALUES(:name, :email, :hashed_password)";
            $prepStmt = $myPDO->prepare($stmt);
            $prepStmt->execute(['name' => $name, 'email' => $email, 'hashed_password' => $hashed_password]);


            $signUpErrorMsg = 'User created';

            // SAVE USER DATA

            // Redirect to account page after successful sign-up
            //header("Location: account.php");
            //exit();
        } catch (PDOException $e) {
            // Display error message if sign-up fails
            $signUpErrorMsg = 'Error: Unable to create account. Please try again later.';
        }
    }
}

?>

<main>
    <div class="sign_up_page_flex_container">
        <form action="" method="post" class="signup_page_form"> <!-- Changed method to POST -->
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <!-- Display sign-up error message -->
            <div><span style='color: red;'><?php echo htmlspecialchars($signUpErrorMsg); ?></span></div>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</main>

<?php
require_once 'Includes/footer.php';
?>