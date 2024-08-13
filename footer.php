<link rel="stylesheet" href="./assets/css/footer.css">
<footer class="footer-section">
    <div class="footer-content">
        <img src="./assets/img/abcc.png" alt="School Logo" class="school-logo">
        <div class="footer-info">
            <h2>Advanced Breed Comprehensive College</h2>
            <p>Success Oriented!</p>
        </div>
    </div>
    <div class="footer-links">

        <?php if (isset($_SESSION["myid"])) { ?>
            <a href="./home">Dashboard</a>
            <a href="./logout">logout</a>

        <?php } else { ?>
            <a href="./login">Login</a>
            <a href="./signup">Signup</a>
        <?php
        } ?>
        <a href="./privacy">Privacy Policy</a>
    </div>
    <div class="footer-bottom">
        <p> Developed with 💖 by <a style="text-decoration: none; color: var(--accent-color);" href="//github.com/baqx">Code Corsair </a></p>
        <p>&copy; <?php echo date('Y'); ?> Advanced Breed Comprehensive College Farewell Bash. No rights reserved 🤣</p>
    </div>
</footer>