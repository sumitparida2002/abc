<?php
require_once 'config.php';
require_once 'head.php';
require_once 'Includes/header.php';

// Initialize variables for form validation and feedback
$amount = '';
$type = '';
$error = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $amount = $_POST['amount'];
    $type = $_POST['type'];

    if (!is_numeric($amount) || $amount <= 0) {
        $error = 'Please enter a valid positive amount.';
    } else {
        // Perform deposit or withdrawal based on the selected type
        if ($type == 'deposit') {
            $sql = "INSERT INTO transactions (user_id, transaction) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $_SESSION["id"], $amount);
            $stmt->execute();
            $stmt->close();
            $sql = "IN users SET balance = balance + ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("di", $amount, $_SESSION["id"]);
            $stmt->execute();
            $stmt->close();

            header("Location: account.php");
            exit();
        } elseif ($type == 'withdrawal') {



            $withdrawalAmount = -$amount; // Negative amount for withdrawal
            $sql = "INSERT INTO transactions (user_id, transaction) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $_SESSION["id"], $withdrawalAmount);
            $stmt->execute();
            $stmt->close();

            header("Location: account.php");
            exit();
        }
    }
}


?>

<?php
require_once './config/config.php';
require_once 'head.php';
require_once 'Includes/header.php';

// Initialize variables for form validation and feedback
$amount = '';
$type = '';
$error = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate amount and type
    $amount = $_POST['amount'];
    $type = $_POST['type'];

    if (!is_numeric($amount) || $amount <= 0) {
        $error = 'Please enter a valid positive amount.';
    } else {
        // Perform deposit or withdrawal based on the selected type
        if ($type == 'deposit') {
            // Insert a new transaction record for deposit
            $sql = "INSERT INTO transactions (user_id, transaction) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $_SESSION["id"], $amount);
            $stmt->execute();
            $stmt->close();

            // Redirect to account page
            header("Location: account.php");
            exit();
        } elseif ($type == 'withdrawal') {
            // Check if the user has sufficient balance for the withdrawal
            $sql = "SELECT balance FROM users WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $_SESSION["id"]);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($amount > $user['balance']) {
                $error = 'Insufficient balance for withdrawal.';
            } else {
                // Insert a new transaction record for withdrawal
                $withdrawalAmount = -$amount; // Negative amount for withdrawal
                $sql = "INSERT INTO transactions (user_id, transaction) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("is", $_SESSION["id"], $withdrawalAmount);
                $stmt->execute();
                $stmt->close();

                // Redirect to account page
                header("Location: account.php");
                exit();
            }
        }
    }
}

?>

<main class=" ">
    <div class="d-flex justify-content-center mt-4">
        <div class="col-md-6 ">
            <h2 class="text-light">Welcome <?= $_SESSION["name"]; ?>!</h2>
            <h4 class="text-light">Would you like to withdraw or deposit.</h4>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label class="text-light" for="amount">Amount:</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="<?= $amount ?>" required>
                </div>
                <div class="form-group">
                    <label class="text-light" for="type">Type:</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="deposit">Deposit</option>
                        <option value="withdrawal">Withdrawal</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success mt-2">Submit</button>
            </form>
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger mt-3" role="alert"><?= $error ?></div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php
require_once 'Includes/footer.php';
?>


<?php
require_once 'Includes/footer.php';
?>