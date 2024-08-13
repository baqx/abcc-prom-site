<?php
session_start();
$ptitle = "Send Anonymous Message";
$css2 = "send.css";
include './inc/connect.php';
include './inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['msg'])) {
    $msg = $_POST['msg'];
    $response = [];

    if ($msg != "") {
        $msg = msg_encrypt($msg);
        $msg = mysqli_real_escape_string($conn, $msg);
        if (strlen($_POST["msg"]) < 500) {
            $uid = 0;
            $myip = getip();
            $timenow = time();
            $sql = "INSERT INTO messages (uid,content,timestamp,ip) VALUES('$uid', '$msg', '$timenow', '$myip')";

            if (mysqli_query($conn, $sql)) {
                $response['status'] = 'success';
                $response['message'] = 'Message sent successfully!';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'An error occurred while sending the message.';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'You cannot send more than 500 characters.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Please fill in the input fields.';
    }

    echo json_encode($response);
    exit();
}

include './header.php';
?>

<main class="message-content">
    <div class="section-header">
        <h2>Send Public Anonymous Message</h2>
        <center>
            <p>No one will know you sent it, just express your thoughts maturely and freely</p>
        </center>
    </div>
    <form class="message-form" id="anonymousMessageForm">
        <textarea id="anonymousMessage" name="msg" placeholder="Don't think twice, write it..." rows="5" oninput="updateWordCount()"></textarea>
        <div class="word-count" id="wordCount">0/500 chars</div>
        <button type="submit">Send Anonymously</button>
    </form>

    </div>
</main>

<?php include './footer.php'; ?>
<script src="./assets/js/send.js"></script>
</body>

</html>