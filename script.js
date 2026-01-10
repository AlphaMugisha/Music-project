const mainCard = document.querySelector(".container"),
    coverImg = mainCard.querySelector("#cover-img"),
    songName = mainCard.querySelector("#song-name"),
    songArtist = mainCard.querySelector("#song-artist"),
    playPauseBtn = mainCard.querySelector("#play-pause-btn"),
    prevBtn = mainCard.querySelector("#prev"),
    nextBtn = mainCard.querySelector("#next"),
    playlistUl = mainCard.querySelector("#playlist-ul");

let musicIndex = 0; // Starts at the first song (song1)

window.addEventListener("load", () => {
    loadMusic(musicIndex); // Load the first song
    renderPlaylist();      // Show all 5 songs in the list
});

// 1. Function to load a specific song
function loadMusic(index) {
    const currentSong = musicList[index];
    songName.innerText = currentSong.name;
    songArtist.innerText = currentSong.artist;
    
    // This fixes your image problem. 
    // It assumes your DB column is called 'image' and file is 'cover1.png'
    coverImg.src = `images/${currentSong.image}.png`; 
}

// 2. Function to create the 5 song items in your playlist
function renderPlaylist() {
    playlistUl.innerHTML = ""; // Clear the list first
    
    musicList.forEach((song, index) => {
        // Create the HTML for each song "row"
        let liTag = `
            <li onclick="clicked(${index})">
                <div class="row">
                    <img src="images/${song.image}.png" class="list-thumb">
                    <div class="list-info">
                        <span>${song.name}</span>
                        <p>${song.artist}</p>
                    </div>
                </div>
            </li>`;
        playlistUl.insertAdjacentHTML("beforeend", liTag);
    });
}

// 3. Next Song Logic
nextBtn.addEventListener("click", () => {
    musicIndex++; // Increment index
    // If it's the last song, go back to the first
    if(musicIndex > musicList.length - 1) { musicIndex = 0; }
    loadMusic(musicIndex);
});

// 4. Prev Song Logic
prevBtn.addEventListener("click", () => {
    musicIndex--;
    if(musicIndex < 0) { musicIndex = musicList.length - 1; }
    loadMusic(musicIndex);
});

// 5. Click a song from the list to play it
function clicked(index) {
    musicIndex = index;
    loadMusic(musicIndex);
}