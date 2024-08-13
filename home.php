<?php
session_start();
if (!isset($_SESSION["myid"])) {
    header('location: ./login?ref=inner');
}
include './inc/connect.php';
include './inc/functions.php';
include './dashboard_header.php'; ?>
<main class="dashboard-content">

    <div class="info-section">
        <h2>Welcome to the Wall of Whimsy! 🎉</h2>
        <p>Here, you can explore all things about the farewell bash! Send your anonymous messages and let your inner thoughts out. </p>
        <p>Don’t forget to check out the voting page to support your favorites! Click the links below to get started!</p>
    </div>
    <div class="profile-section">
        <div class="profile-info">
            <img src="./assets/img/avatars/<?php echo $myavatar; ?>" alt="User Avatar" class="profile-avatar">
            <div class="profile-details">
                <h2><?php echo $mysurname; ?> <?php echo $myfirstname; ?></h2>
                <p>Username: @<?php echo $myusername; ?></p>
                <p>Class: <?php echo $myclass; ?></p>
                <p>Department: <?php echo $mydepartment; ?></p>
                <?php if ($myadminstatus > 0) { ?> <p>You are an admin! 😎 </p><?php } ?>
            </div>
        </div>
    </div>

    <div class="action-buttons">
        <a href="./send"> <button class="action-button">Send Public Anonymous Message 👽☠</button></a>


        <a href="./voting"> <button class="action-button">Vote for your faves ✨</button></a>
        <a href="./upload"> <button class="action-button">Upload Pictures 📷</button></a>
        <?php if ($myadminstatus > 0) {
        ?>
            <a href="./anonymous"><button class="action-button"> Anonymous Panel [ADM] </button></a>
            <a href="./category"> <button class="action-button"> Register Category [ADM] </button></a>
            <a href="./nominate"> <button class="action-button"> Register Nominees [ADM] </button></a>
        <?php
        } ?>
        <a href="./voting"> <button class="action-button">Logout 😭</button></a>

    </div>
    <div class="countdown-section">
        <p class="countdown-heading">Countdown to Valedictory Service</p>
        <div class="countdown-timer">
            <div class="countdown-box">
                <span id="days" class="countdown-time">00</span>
                <span class="countdown-label">Days</span>
            </div>
            <div class="countdown-box">
                <span id="hours" class="countdown-time">00</span>
                <span class="countdown-label">Hours</span>
            </div>
            <div class="countdown-box">
                <span id="minutes" class="countdown-time">00</span>
                <span class="countdown-label">Minutes</span>
            </div>
            <div class="countdown-box">
                <span id="seconds" class="countdown-time">00</span>
                <span class="countdown-label">Seconds</span>
            </div>
        </div>
    </div>

    <div class="charts">
        <div class="chart">
            <h3>Voting Stats</h3>
            <canvas id="votingChart"></canvas>
        </div>
        <div class="chart">
            <h3>Category Distribution</h3>
            <canvas id="categoryChart"></canvas>
        </div>
    </div>


</main>

<script src="./assets/js/home.js"></script>
<script src="./assets/js/countdown.js"></script>
</body>
<?php include './footer.php'; ?>

</html>