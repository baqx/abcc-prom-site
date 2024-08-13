<?php
session_start();
$ptitle = "Anonymous Messages";
$css2 = "send.css";
include './inc/connect.php';
include './inc/functions.php';
if (getuser($_SESSION["myid"], "admin") < 1) {
    header("location: ./home");
    exit();
}
include './header.php';
?>

<main class="message-content">
    <div class="section-header">
        <h2>Anonymous Messages</h2>
        <center>
            <p>View all anonymous messages on this page</p>
        </center>
    </div>

    <div class="message-feedback">
        <h4>Refresh the page to check for new messages</h4>
        <div class="message-list">
            <?php
            $sql = mysqli_query($conn, "SELECT * FROM messages WHERE uid=0 ORDER BY timestamp DESC");
            while ($row = mysqli_fetch_array($sql)) {
                $mid = $row["id"];
                $msg = htmlspecialchars(msg_decrypt($row["content"]));
                $timestamp = $row["timestamp"];
                $formattedDate = date('g:i A, M j, Y', $timestamp);

            ?>
                <div class="message-item">
                    <p style="white-space: pre-line;"><?php echo $msg; ?></p>
                    <div style="display:flex;margin:3px;justify-content:space-between;">
                        <span class="message-time">Submitted: <?php echo $formattedDate; ?></span>
                        <a href="./whisper?id=<?php echo $mid; ?>" style="text-decoration:none;color:var(--accent-color)">Download</a>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</main>

<?php include './footer.php'; ?>
</body>

</html>