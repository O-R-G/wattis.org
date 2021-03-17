/*
    user interface control
*/

function init_ui() {

    // logo
    var logo = unescape(getCookie("logoCookie"));
    if (logo) { document.getElementById("logo").textContent = logo; }
    
    // menu    
    var sMenu_btn = document.getElementById('menu-btn');
    sMenu_btn.addEventListener('click', function(){
        // play_sound_random();
        play_sound(0);
        document.body.classList.add('viewing-menu');
    });
    
    var sClose_menu_btn = document.getElementById('close-menu-btn');
    sClose_menu_btn.addEventListener('click', function(){
        play_sound(1);
        document.body.classList.remove('viewing-menu');
    });
    
    // help
    var sHelp_btn = document.getElementById('help-btn');
    sHelp_btn.addEventListener('click', function(){
        play_sound(3);
        document.body.classList.add('viewing-help');
    });
    
    var sClose_help_btn = document.getElementById('close-help-btn');
    sClose_help_btn.addEventListener('click', function(){
        // off_sound.play();
        play_sound(4);
        document.body.classList.remove('viewing-help');
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
        var currentLevel = parseInt(sMenu_wrapper.getAttribute('level'));
        if(currentLevel < sMenu_level.length)
        {
            var btn_text = sMore_menu_btn.querySelector('a').innerText;
            sMore_menu_btn.querySelector('a').innerText = 'EVEN '+btn_text;
            sMenu_wrapper.setAttribute('level', currentLevel+1);
            if(currentLevel == sMenu_level.length-1)
                sMore_menu_btn.style.display = 'none';
        }
    });

    /*
    // * href
    var elements = document.getElementsByTagName('a');
    for(var i = 0, len = elements.length; i < len; i++) {
        elements[i].onclick = function () {
            play_sound_random();
        }
    }
    */

    // all clicks or taps
    // (touchstart event for taps may be better)

    document.body.addEventListener('click', function () {
        play_sound_random();
    });

    console.log('** ui ready **');
}



