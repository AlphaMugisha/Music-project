<?php
// 1. Connect to database
include 'db.php';

// 2. Fetch songs
$sql = "SELECT * FROM songs";
$result = $conn->query($sql);
$songs = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $songs[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VibePlayer Pro</title>

    <!-- Main CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <!-- Background -->
    <div class="background"></div>

    <!-- Main Container -->
    <div class="container">

        <!-- PLAYER -->
        <div class="player">

            <div class="header">
                <i class="fas fa-music"></i>
                <span>Now Playing</span>
                <i class="fas fa-ellipsis-h"></i>
            </div>

            <div class="img-area">
                <img src="images/cover.png" alt="Album Cover" id="cover-img">
            </div>

            <div class="song-details">
                <h2 id="song-name">Select a Song</h2>
                <p id="song-artist">Artist Name</p>
            </div>

            <div class="audio-progress">
                <div class="progress-bar">
                    <div class="progress-current" id="progress-bar-fill"></div>
                </div>
                <div class="time">
                    <span id="current-time">0:00</span>
                    <span id="max-duration">0:00</span>
                </div>
            </div>

            <!-- CONTROLS -->
            <div class="controls">
                <i id="prev" class="fas fa-step-backward"></i>

                <div class="play-pause">
                    <i id="play-pause-btn" class="fas fa-play"></i>
                </div>

                <i id="next" class="fas fa-step-forward"></i>

                <!-- Volume Control -->
                <div class="volume-control">
                    <i class="fas fa-volume-up"></i>
                    <input type="range" id="volume-slider" min="0" max="100" value="80">
                </div>
            </div>
        </div>

        <!-- PLAYLIST -->
        <div class="playlist">

            <div class="playlist-header">
                <h3>My Playlist</h3>

                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="search-input" placeholder="Search song...">
                </div>
            </div>

            <!-- Empty playlist message -->
            <p class="playlist-empty" id="empty-playlist">
                No songs found
            </p>

            <ul id="playlist-ul"></ul>
        </div>

    </div>

    <!-- Audio Element -->
    <audio id="audio"></audio>

    <!-- PHP → JS bridge -->
    <script>
        let musicList = <?php echo json_encode($songs); ?>;
    </script>

    <!-- Main JS -->
    <script src="script.js"></script>

</body>
</html>
