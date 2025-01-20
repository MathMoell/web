<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My GitHub Page</title>
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
        #player {
            width: 560px;
            height: 315px;
            display: none;
        }
        .controls {
            margin-top: 20px;
        }
        .control-btn {
            margin: 5px;
        }
        .volume {
            width: 200px;
        }
    </style>
</head>
<body>
    <h1>Tervist</h1>
    <p>Olete sattunud minu lehele.</p>

    <!-- Original Links Section -->
    <p>
        <a href="https://github.com/MathMoell/html/blob/main/h01.html" target="_blank">Link koodiga: H01</a>
    </p>
    <p>
        <a href="https://github.com/MathMoell/html/blob/main/h02.html" target="_blank">Link koodiga: H02</a>
    </p>
    <p>
        <a href="https://mathmoell.github.io/html/h03.html" target="_blank">Link veebilehele H03</a>
    </p>
    <p>
        <a href="https://mathmoell.github.io/html/h04.html" target="_blank">Link veebilehele H04</a>
    </p>
    <p>
        <a href="https://mathmoell.github.io/html/teenused.html" target="_blank">Link veebilehele Teenused</a>
    </p>
    <p>
        <a href="https://mathmoell.github.io/html/kontakt.html" target="_blank">Link veebilehele Kontakt</a>
    </p>
    <p>
        <a href="https://mathmoell.github.io/html/h05.html" target="_blank">Link veebilehele H05</a>
    </p>
    <p>
        <a href="https://mathmoell.github.io/html/h06.html" target="_blank">Link veebilehele H06</a>
    </p>

    <!-- YouTube audio player -->
    <h2>Mängi muusikat ↓</h2>
    <p>Eden FM - "Stay"</p>
    
    <!-- YouTube player container -->
    <div id="player"></div>

    <!-- Controls for play, stop, and volume -->
    <div class="controls">
        <button class="control-btn" id="playButton">Play</button>
        <button class="control-btn" id="stopButton">Stop</button>
        <input type="range" class="volume" id="volumeControl" min="0" max="100" value="100">
        <label for="volumeControl">Volume</label>
    </div>

    <script>
        let player;
        let isPlaying = false;

        // Create the YouTube player using the Iframe API
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                videoId: 'JPbvDEWibi0', // Replace with the YouTube video ID
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }

        function onPlayerReady(event) {
            // Set the initial volume from the slider
            const volumeSlider = document.getElementById('volumeControl');
            player.setVolume(volumeSlider.value);
        }

        function onPlayerStateChange(event) {
            if (event.data === YT.PlayerState.ENDED) {
                isPlaying = false;
                document.getElementById('playButton').textContent = "Play";
            }
        }

        // Play the video
        document.getElementById('playButton').addEventListener('click', () => {
            if (!isPlaying) {
                player.playVideo();
                isPlaying = true;
                document.getElementById('playButton').textContent = "Pause";
            } else {
                player.pauseVideo();
                isPlaying = false;
                document.getElementById('playButton').textContent = "Play";
            }
        });

        // Stop the video
        document.getElementById('stopButton').addEventListener('click', () => {
            player.stopVideo();
            isPlaying = false;
            document.getElementById('playButton').textContent = "Play";
        });

        // Adjust the volume
        document.getElementById('volumeControl').addEventListener('input', (e) => {
            player.setVolume(e.target.value);
        });

        // Load the YouTube API
        (function loadYouTubeAPI() {
            const script = document.createElement('script');
            script.src = "https://www.youtube.com/iframe_api";
            document.body.appendChild(script);
        })();
    </script>
</body>
</html>
