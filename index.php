<?php
session_start();
include './inc/connect.php';
include './inc/functions.php';
include './header.php';
?>


<section class="hero">
    <div class="hero-content">
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
        <h1>Welcome to the Best Evening of Your Life!</h1>
        <p>Join us for a magical evening filled with fun, laughter, and unforgettable memories.</p>
    </div>
    <div class="hero-image">
        <img src="./assets/img/dj.png" alt="Purrrrr!">
    </div>
</section>
<section class="memories-in-motion">
    <div class="section-header">
        <h2>Memories in Motion</h2>
    </div>
    <div class="marquee">
        <div class="marquee-inner">
            <?php
            $mems = mysqli_query($conn, "SELECT * FROM memories ORDER BY rand() LIMIT 20");
            while ($mem = mysqli_fetch_array($mems)) {
                $img = $mem["img"];
                $caption = $mem["caption"];
                echo "<img src='./assets/img/memories/$img' alt='$caption' />";
            }
            ?>
        </div>
    </div>

    <!-- Photo Preview Modal -->
    <div class="photo-preview-modal" id="photoPreviewModal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="preview-image" id="previewImage" src="" alt="Preview" />
    </div>
</section>
<section class="program-order">
    <div class="section-header">
        <h2>Order of Program</h2>
    </div>

    <div class='timeline'>
        <?php
        $program_query = mysqli_query($conn, "SELECT * FROM programme ORDER BY id ASC");
        while ($prog = mysqli_fetch_assoc($program_query)) {
            $prog_title = $prog["title"];
            $prog_subtitle = $prog["subtitle"];
            $prog_time = $prog["timestamp"];
            echo "     
            <div class='timeline-item'>
                <div class='timeline-time'>$prog_time</div>
                <div class='timeline-content'>
                    <h3>$prog_title</h3>
                    <p>$prog_subtitle</p>
                </div>
            </div>
        ";
        }

        ?>
    </div>
</section>



<script src="./assets/js/memories.js"></script>
<script src="./assets/js/countdown.js"></script>
</body>
<?php include './footer.php'; ?>

</html>