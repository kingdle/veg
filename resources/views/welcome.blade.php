<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>苗果笔记</title>

    <!-- Styles -->
    <style>
        /* ---- reset ---- */

        body,
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            margin: 0;
            font: normal 100% Arial, Helvetica, sans-serif;
            background-color: #1a1a1b;
            text-shadow: 3px 3px 0 rgba(0, 0, 0, 0.2);
        }

        .heading span {
            cursor: pointer;
            display: inline-block;
            transition: transform 0.25s;
        }

        .heading span:hover {
            transform: translateY(-20px) rotate(10deg) scale(2);
        }

        .web-green {
            font-size: 36px;
            color: #519c47;
        }

        .web-orange {
            font-size: 36px;
            color: #ff580b;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
            color: #ffffff;
        }

        .title h2 {
            font-size: 66px;
        }

        svg {
            position: absolute;
            top: 0;
            left: 0px;
            width: 40px;
            height: 600px;
        }

        .bg-bubbles li {
            position: absolute;
            list-style: none;
            display: block;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.15);
            bottom: -90px;
            border-radius: 50%;
            -webkit-animation: square 25s infinite;
            animation: square 25s infinite;
            -webkit-transition-timing-function: linear;
            transition-timing-function: linear;
            -webkit-animation-direction: alternate;
            /* Chrome, Safari, Opera */

            animation-direction: alternate;
        }

        .bg-bubbles li:nth-child(1) {
            left: 10%;
        }

        .bg-bubbles li:nth-child(2) {
            left: 20%;
            width: 80px;
            height: 80px;
            -webkit-animation-delay: 2s;
            animation-delay: 2s;
            -webkit-animation-duration: 17s;
            animation-duration: 17s;
        }

        .bg-bubbles li:nth-child(3) {
            left: 25%;
            -webkit-animation-delay: 4s;
            animation-delay: 4s;
        }

        .bg-bubbles li:nth-child(4) {
            left: 40%;
            width: 60px;
            height: 60px;
            -webkit-animation-duration: 22s;
            animation-duration: 22s;
            background-color: rgba(255, 255, 255, 0.25);
        }

        .bg-bubbles li:nth-child(5) {
            left: 70%;
        }

        .bg-bubbles li:nth-child(6) {
            left: 80%;
            width: 70px;
            height: 70px;
            -webkit-animation-delay: 3s;
            animation-delay: 3s;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .bg-bubbles li:nth-child(7) {
            left: 32%;
            width: 90px;
            height: 90px;
            -webkit-animation-delay: 7s;
            animation-delay: 7s;
        }

        .bg-bubbles li:nth-child(8) {
            left: 55%;
            width: 20px;
            height: 20px;
            -webkit-animation-delay: 15s;
            animation-delay: 15s;
            -webkit-animation-duration: 40s;
            animation-duration: 40s;
        }

        .bg-bubbles li:nth-child(9) {
            left: 25%;
            width: 10px;
            height: 10px;
            -webkit-animation-delay: 2s;
            animation-delay: 2s;
            -webkit-animation-duration: 40s;
            animation-duration: 40s;
            background-color: rgba(255, 255, 255, 0.3);
        }

        .bg-bubbles li:nth-child(10) {
            left: 90%;
            width: 60px;
            height: 60px;
            -webkit-animation-delay: 11s;
            animation-delay: 11s;
        }

        .bg-bubbles li:nth-child(11) {
            left: 65%;
            -webkit-animation-duration: 13s;
            animation-duration: 13s;
        }

        .bg-bubbles li:nth-child(12) {
            left: 75%;
            width: 30px;
            height: 30px;
            -webkit-animation-delay: 7s;
            animation-delay: 7s;
            -webkit-animation-duration: 13s;
            animation-duration: 13s;
        }

        .bg-bubbles li:nth-child(13) {
            left: 55%;
            -webkit-animation-delay: 7s;
            animation-delay: 7s;
        }

        .bg-bubbles li:nth-child(14) {
            left: 90%;
            width: 44px;
            height: 44px;
            -webkit-animation-duration: 12s;
            animation-duration: 12s;
            background-color: rgba(255, 255, 255, 0.25);
        }

        .bg-bubbles li:nth-child(15) {
            left: 4%;
            -webkit-animation-delay: 5s;
            animation-delay: 5s;
            -webkit-animation-duration: 8s;
            animation-duration: 8s;
        }

        .bg-bubbles li:nth-child(16) {
            left: 66%;
            width: 50px;
            height: 50px;
            -webkit-animation-delay: 13s;
            animation-delay: 13s;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .bg-bubbles li:nth-child(17) {
            left: 32%;
            width: 90px;
            height: 90px;
            -webkit-animation-delay: 7s;
            animation-delay: 7s;
        }

        .bg-bubbles li:nth-child(18) {
            left: 55%;
            width: 20px;
            height: 20px;
            -webkit-animation-delay: 5s;
            animation-delay: 5s;
            -webkit-animation-duration: 20s;
            animation-duration: 20s;
        }

        .bg-bubbles li:nth-child(19) {
            left: 88%;
            width: 10px;
            height: 10px;
            -webkit-animation-delay: 12s;
            animation-delay: 12s;
            -webkit-animation-duration: 10s;
            animation-duration: 10s;
            background-color: rgba(255, 255, 255, 0.3);
        }

        .bg-bubbles li:nth-child(20) {
            left: 58%;
            width: 60px;
            height: 60px;
            -webkit-animation-delay: 14s;
            animation-delay: 14s;
        }

        @-webkit-keyframes square {
            0% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
            100% {
                -webkit-transform: translateY(-900px) rotate(600deg);
                transform: translateY(-900px) rotate(600deg);
            }
        }

        @keyframes square {
            0% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
            100% {
                -webkit-transform: translateY(-900px) rotate(600deg);
                transform: translateY(-900px) rotate(600deg);
            }
        }

        .wheel-string {
            z-index: -1;
            background-color: orange;
            width: 200px;
            height: 20px;
            position: absolute;
            top: 160px;
            left: 50%;
        }

        .wheel-string-one {
            -webkit-transform-origin: 0 50%;
            -moz-transform-origin: 0 0;
            -o-transform-origin: 0 0;
            -ms-transform-origin: 0 0;
            transform-origin: 0 50%;
            -webkit-transform: rotate(-90deg);
            -moz-transform: rotate(-90deg);
            -o-transform: rotate(-90deg);
            -ms-transform: rotate(-90deg);
            transform: rotate(-90deg);
        }

        .wheel-string-two {
            -webkit-transform-origin: 0 50%;
            -moz-transform-origin: 0 0;
            -o-transform-origin: 0 0;
            -ms-transform-origin: 0 0;
            transform-origin: 0 50%;
            -webkit-transform: rotate(-18deg);
            -moz-transform: rotate(-18deg);
            -o-transform: rotate(-18deg);
            -ms-transform: rotate(-18deg);
            transform: rotate(-18deg);
        }

        .wheel-string-three {
            -webkit-transform-origin: 0 50%;
            -moz-transform-origin: 0 0;
            -o-transform-origin: 0 0;
            -ms-transform-origin: 0 0;
            transform-origin: 0 50%;
            -webkit-transform: rotate(54deg);
            -moz-transform: rotate(54deg);
            -o-transform: rotate(54deg);
            -ms-transform: rotate(54deg);
            transform: rotate(54deg);
        }

        .wheel-string-four {
            -webkit-transform-origin: 0 50%;
            -moz-transform-origin: 0 0;
            -o-transform-origin: 0 0;
            -ms-transform-origin: 0 0;
            transform-origin: 0 50%;
            -webkit-transform: rotate(126deg);
            -moz-transform: rotate(126deg);
            -o-transform: rotate(126deg);
            -ms-transform: rotate(126deg);
            transform: rotate(126deg);
        }

        .wheel-string-five {
            -webkit-transform-origin: 0 50%;
            -moz-transform-origin: 0 0;
            -o-transform-origin: 0 0;
            -ms-transform-origin: 0 0;
            transform-origin: 0 50%;
            -webkit-transform: rotate(198deg);
            -moz-transform: rotate(126deg);
            -o-transform: rotate(126deg);
            -ms-transform: rotate(126deg);
            transform: rotate(198deg);
        }

        .wheel-wrapper {
            background-color: none;
            width: 600px;
            height: 600px;
            position: relative;
            margin: auto auto;
            overflow: hidden;
            transition: transform 0.4s ease;
        }

        @-webkit-keyframes wheel-rotate {
            from {
                -webkit-transform: rotate(0deg) translate(-50%, -50%);
                -moz-transform: rotate(0deg) translate(-50%, -50%);
                -o-transform: rotate(0deg) translate(-50%, -50%);
                -ms-transform: rotate(0deg) translate(-50%, -50%);
                transform: rotate(0deg) translate(-50%, -50%);
            }
            to {
                -webkit-transform: rotate(360deg) translate(-50%, -50%);
                -moz-transform: rotate(360deg) translate(-50%, -50%);
                -o-transform: rotate(360deg) translate(-50%, -50%);
                -ms-transform: rotate(360deg) translate(-50%, -50%);
                transform: rotate(360deg) translate(-50%, -50%);
            }
        }

        @-moz-keyframes wheel-rotate {
            from {
                -webkit-transform: rotate(0deg) translate(-50%, -50%);
                -moz-transform: rotate(0deg) translate(-50%, -50%);
                -o-transform: rotate(0deg) translate(-50%, -50%);
                -ms-transform: rotate(0deg) translate(-50%, -50%);
                transform: rotate(0deg) translate(-50%, -50%);
            }
            to {
                -webkit-transform: rotate(360deg) translate(-50%, -50%);
                -moz-transform: rotate(360deg) translate(-50%, -50%);
                -o-transform: rotate(360deg) translate(-50%, -50%);
                -ms-transform: rotate(360deg) translate(-50%, -50%);
                transform: rotate(360deg) translate(-50%, -50%);
            }
        }

        @-o-keyframes wheel-rotate {
            from {
                -webkit-transform: rotate(0deg) translate(-50%, -50%);
                -moz-transform: rotate(0deg) translate(-50%, -50%);
                -o-transform: rotate(0deg) translate(-50%, -50%);
                -ms-transform: rotate(0deg) translate(-50%, -50%);
                transform: rotate(0deg) translate(-50%, -50%);
            }
            to {
                -webkit-transform: rotate(360deg) translate(-50%, -50%);
                -moz-transform: rotate(360deg) translate(-50%, -50%);
                -o-transform: rotate(360deg) translate(-50%, -50%);
                -ms-transform: rotate(360deg) translate(-50%, -50%);
                transform: rotate(360deg) translate(-50%, -50%);
            }
        }

        @keyframes wheel-rotate {
            from {
                -webkit-transform: rotate(0deg) translate(-50%, -50%);
                -moz-transform: rotate(0deg) translate(-50%, -50%);
                -o-transform: rotate(0deg) translate(-50%, -50%);
                -ms-transform: rotate(0deg) translate(-50%, -50%);
                transform: rotate(0deg) translate(-50%, -50%);
            }
            to {
                -webkit-transform: rotate(360deg) translate(-50%, -50%);
                -moz-transform: rotate(360deg) translate(-50%, -50%);
                -o-transform: rotate(360deg) translate(-50%, -50%);
                -ms-transform: rotate(360deg) translate(-50%, -50%);
                transform: rotate(360deg) translate(-50%, -50%);
            }
        }

        @-webkit-keyframes icon-rotate {
            from {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
            to {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                transform: rotate(0deg);
            }
        }

        @-moz-keyframes icon-rotate {
            from {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
            to {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                transform: rotate(0deg);
            }
        }

        @-o-keyframes icon-rotate {
            from {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
            to {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                transform: rotate(0deg);
            }
        }

        @keyframes icon-rotate {
            from {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
            to {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                transform: rotate(0deg);
            }
        }
    </style>
    <script src="{{ asset('js/particles.min.js') }}"></script>
</head>
<body>
<div id="particles-js"></div>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
                @endauth
        </div>
    @endif
    <div class="content">
        <div class="title m-b-md">
            <h2 class="heading">苗果笔记，用数据记录每一粒种子精彩的一生。</h2>
        </div>

    </div>
    <script>
        particlesJS("particles-js", {
            "particles": {
                "number": {
                    "value": 88,
                    "density": {
                        "enable": true,
                        "value_area": 700
                    }
                },
                "color": {
                    "value": ["#aa73ff", "#f8c210", "#83d238", "#33b1f8"]
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 15
                    },
                    "image": {
                        "src": "img/github.svg",
                        "width": 100,
                        "height": 100
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": false,
                    "anim": {
                        "enable": false,
                        "speed": 1.5,
                        "opacity_min": 0.15,
                        "sync": false
                    }
                },
                "size": {
                    "value": 2.5,
                    "random": false,
                    "anim": {
                        "enable": true,
                        "speed": 2,
                        "size_min": 0.15,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 110,
                    "color": "#f85e13",
                    "opacity": 0.25,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 1.6,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "bounce",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": false,
                        "mode": "repulse"
                    },
                    "onclick": {
                        "enable": false,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 400,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 400,
                        "size": 40,
                        "duration": 2,
                        "opacity": 8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 200,
                        "duration": 0.4
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true
        });
    </script>
    <script type="text/javascript">
        const heading = document.querySelector('.heading');
        heading.innerHTML = wrapWithSpan(heading.textContent);

        function wrapWithSpan(word) {
            return [...word].map(letter => `<span>${letter}</span>`).join('');
        }
    </script>
</div>
</body>
</html>
