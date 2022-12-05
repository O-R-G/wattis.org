/*
    user interface control
*/

menu_level = 0;

function init_ui() {

    // logo
    var logo_mark = unescape(getCookie("logoCookie"));
    if (logo_mark) 
        document.getElementById("logo_mark").innerHTML = logo_mark;

    // menu    
    var sMenu_btn = document.getElementById('menu-btn');
    if(sMenu_btn)
    {
        sMenu_btn.addEventListener('click', function(){            
            document.body.classList.add('viewing-menu');
            play_sound(0);
        });
    }
    else console.log('missing #menu-btn . . .');
    
    
    var sClose_menu_btn = document.getElementById('close-menu-btn');
    sClose_menu_btn.addEventListener('click', function(){
        play_sound(1);
        document.body.classList.remove('viewing-menu');
    });

    // search
    var sSearch_btn = document.getElementById('search-btn');
    var sSearch_input = document.getElementById('search-input');
    sSearch_btn.addEventListener('click', function(){
        if(document.body.classList.contains('viewing-search')){
            play_sound(5);
        }
        else{
            play_sound(6);
            setTimeout(function(){sSearch_input.focus();}, 0);
        }
        document.body.classList.toggle('viewing-search');
    });
    
    // more ... even more    
    var sMore_menu_btn = document.getElementById('more-menu-btn');
    var sMenu_wrapper = document.getElementById('menu-wrapper');
    var sMenu_level = document.getElementsByClassName('menu-level');
    
    sMore_menu_btn.addEventListener('click', function(){
        var menu_level_max = document.getElementsByClassName('menu-level').length;
        console.log(menu_level, menu_level_max);
        if(menu_level < menu_level_max) {
            menu_level++;
            var btn_text = sMore_menu_btn.querySelector('#more-menu-btn-text').innerText;
            sMore_menu_btn.querySelector('#more-menu-btn-text').innerText = 'EVEN '+btn_text;
            sMenu_wrapper.setAttribute('level', menu_level+1);
            var this_menu_level = document.getElementById('menu-level-'+menu_level);
            this_menu_level.style.display = 'block';
            if(menu_level == menu_level_max)
                sMore_menu_btn.style.display = 'none';
        }
    });

    // ** not working yet, but getting close -- todo with 'this' and scope ** 
    // also perhaps the createjs.Sound.play(soundID) from createJS should
    // be async or else has an isPlaying property
    // still cutting off the sound

    // also breaks the More... click eventListener so commented out for now

    /*
    // href
    var e = document.getElementsByTagName('a');
    for(var i = 0, len = e.length; i < len; i++) {
        e[i].onclick = function () {
            href = this.href;
            play_sound_random_async(href).then(
                function(href) {
                    console.log(href);
                    location.href = href;
                });
            return false;   // squelch html href
        }
    }
    */

    // clicks / taps
    document.body.addEventListener('click', function () {
    // document.body.addEventListener('touchstart', function () {    
        play_sound_random();
    });

    console.log('** ui ready **');
}



