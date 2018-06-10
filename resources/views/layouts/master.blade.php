<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>苗果小程序</title>
    {{--<link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">--}}
    {{--<link rel="stylesheet" href="https://images.veg.kim/css/element-ui.css">--}}
    <link rel="stylesheet" href="/css/app.css">
    <style media="screen" type="text/css">
        #appLoading {
            width: 100%;
            height: 100%;
            background: url("https://images.veg.kim/pc/index-background.jpg") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            min-height: 1200px;
        }
        #appLoading h7 {
            color: #f06307;
            margin: 30px 0;
        }
        .explain h2 {
            color: #4f5356;
        }
        .explain p {
            font-size: 18px;
            color: #4f5356;
        }
    </style>
</head>
<body>
<div id="appLoading">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid px-0">
            <div class="navbar-header">
                <a href="/" class="navbar-brand" exact>
                    <img src="/images-pc/logo-pc.png" alt="苗果" width="110" height="42">
                </a>
                <span><img src="https://images.veg.kim/pc/Spinner-1s-200px.gif" alt="loading" width="42" height="42"></span>
            </div>
        </div>
    </nav>
    <div class="col-12 w-100per m-b-100 overflow-auto">
        <div class="w-1200 py-5 m-auto">
            <p class="text-sm text-center letter-10  m-b-45">
            </p>
            <h2 class=" text-center">
                </h2>

            <div class="my-0">
                <div class="fl flex-4 text-center explain">
                    <a class="inline-block m-auto shop" href="#"><img
                                class="hoverImg" style="width:288px;"
                                src="https://images.veg.kim/pc/home-code-big.png">
                    </a>
                    <h5 class="text-secondary pt-2 mb-0">微信扫一扫</h5>
                    <h2 class="pt-5 mx-5 text-center">
                        专业种苗共享服务平台
                    </h2>
                    <p class="text-center mx-5 mt-3">
                        充分利用微信在农户中的普及率，帮助育苗厂建立与农户直接互动连接，全面赋能苗场微信运营能力，搭建用户共享桥梁。
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
<div id="app" style="display: none">
    <app></app>
</div>
<script src="/js/app.js"></script>
{{--<script src="https://unpkg.com/element-ui/lib/index.js"></script>--}}
{{--<script src="https://images.veg.kim/js/element-ui.js"></script>--}}

</body>
</html>
