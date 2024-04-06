<?php

require_once 'config.php';
require_once 'head.php';
require_once 'Includes/header.php';

$sql = "SELECT * FROM transactions WHERE user_id='$_SESSION[id]'";
$result = $conn->query($sql);
$transactions = $result->fetch_all();

?>

<main>
    <h2>Welcome <?= $_SESSION["name"]; ?>!</h2>
    <h4>Here is you account information.</h4>
    <table>
        <thead>
            <tr>
                <th>Deposits</th>
                <th>Withdrawals</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</main>

<?php
require_once 'Includes/footer.php';
?>

