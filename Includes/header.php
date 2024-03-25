<header class="header_grid_container">
    <div class="logo_div">
    <a href="index.php">
    <img src="Includes/images/ABC_Logo.png" alt="ABC_Logo">
    </a>
    </div>

    <div class="title_div">
    <h1 class="bank_title">Algonquin Bank of Canada</h1>
    </div>

    <div class="main_nav">
    <a href="contact.html">&gt; Contact Us</a>
    <select name="language" id="language-select">
    <option value="EN" selected>EN</option>
    <option value="FR">FR</option>
    <option value="LA">LA</option>
    </select>
    
    <?php if(isset($_SESSION['logged'])): ?>
        <a href="account.php">My Account</a>
        <a href="logout.php">Log Out</a>
    <?php else: ?>
        <!-- <a href="signup.php" class="sign_up">Sign Up</a> -->
        <a href="signin.php" class="sign_in">Sign In</a>
    <?php endif;?>
    </div>
    <div class="nav_bar2">
        <a href="">Accounts</a>
        <a href="">Loans</a>
        <a href="">Mortgage</a>
        <a href="">Business Advice</a>
    </div>
</header>