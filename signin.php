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

        Another vulnerability is that the login system is using name for authentication. This is
        problematic because two people may share the same name.

        In the authentication process, a potential hacker is informed about the existence of a certain
        username. If a hacker can access any usernames, he can try as many passwords for that account as possible.
     -->
    <form action="" method="get">
        <label for="name">Name</label>
        <input type="text" name="name">
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

 $sql       = "SELECT * FROM users WHERE name='$name'";
 $result    = $conn->query($sql);
 $user_info = $result->fetch_assoc();
 if (!isset($user_info[ "name" ]) || $user_info[ "name" ] == "") {
  print("User name was not found.<br/>");
 } else {
  $sql       = "SELECT * FROM users WHERE password='$password'";
  $result    = $conn->query($sql);
  $user_info = $result->fetch_assoc();
  if (!isset($user_info[ "password" ]) || $user_info[ "password" ] == "") {
   print("Password is incorrect.");
  } else {
   $_SESSION[ 'logged' ] = '1';
   $_SESSION[ 'name' ]   = $user_info[ "name" ];
   $_SESSION[ 'id' ]     = $user_info[ "id" ];
   header("location: account.php");
  }
 }
}

?>