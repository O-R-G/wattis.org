/*

    using sound.js
    https://createjs.com/getting-started/soundjs

    audio_src[] = mp3 urls defined in static/js/audio-src.js

*/
    
function init_audio () {
    audio_src = shuffle(audio_src);
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

async function play_sound_random_async (href) {
    soundID = Math.floor(Math.random() * audio_src.length);
    instance = createjs.Sound.play(soundID);
    /*
    // see https://createjs.com/docs/soundjs/classes/Sound.html#property_PLAY_FINISHED
    // not working but on the right track probably
    // maybe should be either async or use a callback
    while (instance.playState !== 'playFinished') {
        console.log(instance.playState);
    }
    // console.log(instance.playState);
    */
    console.log(instance);
    return href;
}

function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex;
  while (0 !== currentIndex) {
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }
  return array;
}

