<?php
session_start();
include './inc/connect.php';
include './inc/functions.php';
$css1 = "privacy-policy.css";
$ptitle = "Privacy Policy";
include './header.php';
?>

<body>
    <header class="policy-header">
        <h1>Privacy Policy</h1>
    </header>

    <main class="policy-content">
        <section class="policy-section">
            <h2>User Login Info</h2>
            <p>Your login information, including your password, is encrypted and securely stored. We prioritize your privacy and security. Note that if you are a nominee for voting later, your avatar will be visible to other students.</p>
        </section>

        <section class="policy-section">
            <h2>Anonymous Messaging</h2>
            <p>We take your anonymity seriously. No one, including the developer of this site, can track or identify the sender of any anonymous messages. Feel free to express your thoughts without fear of exposure.</p>
        </section>
        <section class="policy-section">
            <h2>Gallery Image Upload</h2>
            <p>Your name might be visible if you upload a picture on the gallery.</p>
        </section>
        <section class="policy-section">
            <h2>Purging</h2>
            <p>Once the website has fulfilled its purpose, all data, including your personal information and messages, will be permanently purged. We ensure that no trace of your information remains.</p>
        </section>
        <div class="developer-info">
            <h2>Developer Information</h2>
            <p>Adegbola AbdulBaqee</p>
            <p><strong>LinkedIn:</strong> <a href="https://linkedin.com/abdulbaqee" target="_blank">linkedin.com/abdulbaqee</a></p>
            <p><strong>GitHub:</strong> <a href="https://github.com/baqx" target="_blank">github.com/baqx</a></p>
            <p><strong>TikTok:</strong> <a href="https://tiktok.com/@iambaqx" target="_blank">tiktok.com/@iambaqx</a></p>
        </div>
    </main>

    <?php include './footer.php'; ?>
</body>

</html>