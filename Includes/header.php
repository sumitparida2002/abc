<header>
    <div class="header_div">
    <img src="Includes/images/ABC_Logo.png" alt="ABC_Logo">
    <h1 class="bank_title">Algonquin Bank of Canada</h1>
    <a href="contact.html">&gt; Contact Us</a>
    <select name="language" id="language-select">
    <option value="EN" selected>EN</option>
    <option value="FR">FR</option>
    <option value="LN">LN</option>
    </select>
    
    <?php if(isset($_SESSION['logged'])): ?>
        <a href="account.php">My Account</a>
        <a href="logout.php">Log Out</a>
    <?php else: ?>
        <a href="signup.php">Sign Up</a> /
        <a href="signin.php">Sign In</a>
    <?php endif;?>
    </div>
    <div class="nav_bar">
        <a href="">Accounts</a>
        <a href="">Loans</a>
        <a href="">Mortgage</a>
        <a href="">Business Advice</a>
    </div>
</header>