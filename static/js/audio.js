/*

    preload sounds into array, choose randomly on clicks 
    using webaudio api

    https://stackoverflow.com/questions/31060642/preload-multiple-audio-files

*/

/*

    1. preload all mp3 as Audio objects
    2. add each object to audio array
    3. play_random() picks one sound (preloaded) at random and plays it

*/

// ls /media/audio/assets/A/ | pbcopy
// could be done with php scan_dir and passed via json
// or just short bash script

var audio_src = [
    "/media/audio/assets/A/bubbles.mp3",  
    "/media/audio/assets/A/clay.mp3",
    "/media/audio/assets/A/confetti.mp3",
    "/media/audio/assets/A/corona.mp3",
    "/media/audio/assets/A/dotted-spiral.mp3",
    "/media/audio/assets/A/flash-1.mp3",
    "/media/audio/assets/A/flash-2.mp3",
    "/media/audio/assets/A/flash-3.mp3",
    "/media/audio/assets/A/glimmer.mp3",
    "/media/audio/assets/A/moon.mp3",
    "/media/audio/assets/A/pinwheel.mp3",
    "/media/audio/assets/A/piston-1.mp3",
    "/media/audio/assets/A/piston-2.mp3",
    "/media/audio/assets/A/piston-3.mp3",
    "/media/audio/assets/A/prism-1.mp3",
    "/media/audio/assets/A/prism-2.mp3",
    "/media/audio/assets/A/prism-3.mp3",
    "/media/audio/assets/A/splits.mp3",
    "/media/audio/assets/A/squiggle.mp3",
    "/media/audio/assets/A/strike.mp3",
    "/media/audio/assets/A/suspension.mp3",
    "/media/audio/assets/A/timer.mp3",
    "/media/audio/assets/A/ufo.mp3",
    "/media/audio/assets/A/veil.mp3",
    "/media/audio/assets/A/wipe.mp3",
    "/media/audio/assets/A/zig-zag.mp3"
];

var audios = [];
function audio_preload(url) {
    var audio = new Audio();
    audio.addEventListener('canplaythrough', audio_loaded, false);
    audio.src = url;
    audios.push(audio);
    // return audios;
}
    
var loaded = 0;
function audio_loaded() {
    loaded++;
    console.log(loaded);
    /*
    if (loaded == audio_src.length)
        init();
    */
}

/*
// var player = document.getElementById('player');
var player;
function play(index) {
    player.src = audio_src[index];
    player.play();
}
*/

// move this somewhere earlier in page load ** fix **    
for (var i in audio_src) {
    audio_preload(audio_src[i]);
}
