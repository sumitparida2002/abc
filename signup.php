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
    <form action="" method="get">
        <label for="name">Name</label>
        <input type="text" name="name">
        <label for="email">email</label>
        <input type="text" name="email">
        <label for="password">Password</label>
        <input type="password" name="password">
        <input type="submit" name="submit" value="Submit">
    </form>
</main>

<?php
require_once 'footer.php';
?>

<?php

extract($_GET);
if (isset($_GET[ 'submit' ])) {
 $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
 $conn->query($sql);
}

?>