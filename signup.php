<?php

require_once 'config.php';
require_once 'head.php';
require_once 'includes/header.php';
?>

<?php





$error = '';

if (isset($_GET['submit'])) {
    extract($_GET);

    $check_sql = "SELECT * FROM users WHERE email = '$email'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $error = "User with this email already exists.";
    } else {
        // Insert new user record
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        $result = $conn->query($sql);

        if ($result) {
            $userFetch = "SELECT * FROM users WHERE name='$name' AND password='$password' ";


            $result    = $conn->query($userFetch);
            $user_info = $result->fetch_assoc();

            $_SESSION['logged'] = '1';
            $_SESSION['name']   = $user_info["name"];
            $_SESSION['id']     = $user_info["id"];
            header("location: account.php");
        }
    }
}

?>

<main>

    <div class="sign_up_page_flex_container">
        <form action="./signup.php" method="get" class="signup_page_form">
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <input type="submit" name="submit" value="Submit">
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger mt-3" role="alert"><?= $error ?></div>
            <?php endif; ?>
        </form>


    </div>
</main>

<?php
require_once 'Includes/footer.php';
?>