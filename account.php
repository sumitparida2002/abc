<?php
require_once 'config.php';
require_once 'head.php';
require_once 'Includes/header.php';

// Fetch user's transactions
$user_id = $_SESSION["id"];
$sql = "SELECT DATE(datetime) AS transaction_date, transaction FROM transactions WHERE user_id = ? ORDER BY datetime DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<main class=" ">
    <div class="d-flex justify-content-center mt-4">
        <div class="col-md-8 offset-md-2">
            <h2 class="text-light">Welcome <?= $_SESSION["name"]; ?>!</h2>
            <h4 class="mb-3 text-light">Account Information</h4>
            <div class="table-responsive">
                <table class="table table-light table-success">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <?php
                            $transaction_type = $row['transaction'] < 0 ? 'Withdrawal' : 'Deposit';
                            ?>
                            <tr>
                                <td><?= $row['transaction_date']; ?></td>
                                <td><?= $transaction_type; ?></td>
                                <td><?= $row['transaction']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <a href="transaction.php" class="btn btn-primary">Deposit or Withdraw Funds</a>
        </div>
    </div>
</main>

<?php
require_once 'Includes/footer.php';
?>