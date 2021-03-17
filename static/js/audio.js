/*

    using sound.js
    https://createjs.com/getting-started/soundjs

    audio_src[] = mp3 urls defined in static/js/audio-src.js

*/
    
function init_audio () {
    load_sounds();
    console.log('** audio ready **');
}

function load_sounds () {
    i = 0;
    for (var i in audio_src)
        createjs.Sound.registerSound(audio_src[i], i);
}
    
function play_sound (soundID) {
    createjs.Sound.play(soundID);
}

function play_sound_random () {
    soundID = Math.floor(Math.random() * audio_src.length);
    createjs.Sound.play(soundID);
}
