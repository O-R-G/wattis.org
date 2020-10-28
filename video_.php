<style>
#screen {
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    opacity: 0.9;
    color: #FFF;
    background-color: #000;
    animation-name: fade; 
    animation-timing-function: ease-in;
    animation-duration: 4s; 
    z-index: 10;
    /* z-index: 100; */
}

#video {
    width: 85%;
    /* z-index: 11; */
    z-index: 101;
}

#details {
    position: absolute;
    left: 10px;
    bottom: 10px;
}

#close {
    position: absolute;
    right: 10px;
    top: 10px;
}

#more {
    position: absolute;
    right: 10px;
    bottom: 10px;
    color: #FFF;
}

.center {
    margin: 0;
    position: fixed;
    /* position: absolute; */
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #FFF;
}

.punctuation {
    color: #FFF;
}

.logo a {
    /* color: #FFF !important; */
}

#video-home .white a {
    border-bottom: solid 3px #FFF !important;
}

#video-home .black a {
    border-bottom: solid 3px #FFF !important;
}

#video-home a {
    border-bottom: #FFF !important;
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
        <div id='details' class='helvetica small'>
            Jeffrey Gibson<br>
            Nothing Is Eternal, 2020<br>
            Single-channel digital video, sound<br>
            18:14 min<br>
            Courtesy of the artist and Sikkema Jenkins & Co.<br>
        </div>
        <div id='more'>
            <a href=''>Read more here . . .</a>
        </div>
        <div id='close'>
            <a href=''>Close</a>
        </div>
    </div>
    <div id='video' class='center'>
        <div style="padding:56.25% 0 0 0;position:relative;">
            <iframe src="https://player.vimeo.com/video/469873476?color=FFFFFF&title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
        </div>
        <script src="https://player.vimeo.com/api/player.js"></script>
    </div>
</div>
