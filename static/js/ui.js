/*
    user interface control
*/
menu_level = 0;


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
    var sLogo = document.getElementById('logoContainer');
    sLogo.addEventListener('click', function(){
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
        var menu_level_max = document.getElementsByClassName('menu-level').length;
        console.log(menu_level, menu_level_max);
        if(menu_level < menu_level_max)
        {
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

    /*
    // href
    var e = document.getElementsByTagName('a');
    for(var i = 0, len = e.length; i < len; i++) {
        e[i].onclick = function () {
            play_sound_random();
        }
    }
    */
    
    // clicks / taps
    // (touchstart event for taps may be better)
    // document.body.addEventListener('click', function () {
    document.body.addEventListener('touchstart', function () {
        play_sound_random();
    });

    console.log('** ui ready **');
}



