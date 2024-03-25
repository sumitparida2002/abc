<?php

require_once 'config.php';
require_once 'head.php';
require_once 'includes/header.php';
?>

<main>
    <!--
        The method for the form is GET because we wanted to make sure that the password is
        exposed and also any user can inject data into the URL field easily.

        Also, we do not hash the password here so that the system is vulnerable to brute force
        attack.

        Not using prepared statements here will enable hackers to inject their sql scripts.

        Also, since the data coming from the form are not sanitized, hackers can inject Javascript
        Code into the application.
     -->
<div class="sign_up_page_flex_container">
    <form action="" method="get" class="signup_page_form">
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <input type="submit" name="submit" value="Submit">
    </form>
</div>
</main>

<?php
require_once 'Includes/footer.php';
?>

<?php

extract($_GET);
if (isset($_GET[ 'submit' ])) {
 $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
 $conn->query($sql);
}

?>