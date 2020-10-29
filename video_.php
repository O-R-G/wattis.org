<style>
#screen {
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    z-index: 10;
}

.fade {
    opacity: 0.9;
    background-color: #000;
    animation-name: fade; 
    animation-timing-function: ease-in;
    animation-duration: 5s; 
}

#video {
    width: 75%;
    z-index: 101;
}

#details {
    position: absolute;
    width: 25%;
    padding: 20px 0px 100px 0px;
}

#more {
    position: absolute;
    right: 0px;
    width: 50%;
    columns: 110px 2;
    column-gap: 20px;
    padding: 20px 0px 100px 0px;
}

.centered {
    margin: 0;
    /* position: fixed; */
    position: absolute;
    top: 150px;
    left: 50%;
    transform: translate(-50%, 0%);
}

@keyframes fade {
    from {
        opacity: 0.0;
    } to {
        opacity: 0.9;
    };
}
</style>

<div id='video-home'>
    <div id='screen'>
    </div>
    <div id='video' class='centered'>
        <div style="padding:56.25% 0 0 0;position:relative;">
            <iframe src="https://player.vimeo.com/video/469873476?color=FFFFFF&title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
        </div>
        <div id='details' class='helvetica small'>
            Jeffrey Gibson<br>
            Nothing Is Eternal, 2020<br>
            Single-channel digital video, sound<br>
            18:14 min<br>
            Courtesy of the artist and Sikkema Jenkins & Co.<br>
        </div>
        <div id='more' class='helvetica small'>
            Conceived during this pandemic era, the immersive video work depicts the American flag in unsettling stillness, as a marker of territory, and projected onto bodies, while set to a heartrending soundtrack. At once melancholic and beautiful, Gibson renders the iconic image of the flag as both elastic and unyielding. The slow transformation through time, color, and form reflects both a distillation of our social collapse and the reinvention of self and community, referencing the movement and change that is so desired for this nation<br />
            <br/>
            Jeffrey Gibson (b. 1972, Colorado, US) is an interdisciplinary artist and craftsperson based in Hudson, New York. His work references various aesthetic and material histories rooted in Indigenous cultures of the Americas, and in modern and con- temporary subcultures. Gibson, a member of the Mississippi Band of Choctaw Indians and of Cherokee descent, is forging a multifarious practice that redresses the exclusion and erasure of Indigenous art traditions from the history of Western art as it explores the complexity and fluidity of identity.<br />
            <br/>
            <a href='/view?id=4,1108'>READ MORE HERE . . .</a>
        </div>
        <script src="https://player.vimeo.com/api/player.js"></script>
        <script>
            /* 
                detect play/pause via vimeo api
            */
            var iframe = document.querySelector('iframe');
            var player = new Vimeo.Player(iframe);
            var screen = document.getElementById('screen');

            player.on('play', function() {
                screen.classList.add("fade");
            });
            player.on('pause', function() {
                screen.classList.remove("fade");
            });
        </script>

    </div>
</div>

<script>

    /*
        add eventlistener to clicking video
    */
    
    /*
    document.getElementById("myBtn").addEventListener("click", function() {
      myFunction(p1, p2);
    });
    */

</script>
