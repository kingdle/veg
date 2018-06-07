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
        #appLoading { width: 100%; height: 100%;}
        #appLoading h7{
            color: #f06307;
        }
    </style>
</head>
<body>
<div id="appLoading">
    <div class="col-12 w-100per m-b-100 overflow-auto">
        <div class="w-1200 py-5 m-auto">
            <h2 class=" text-center">
                苗果服务在您身边</h2>
            <p class="text-sm text-center letter-10  m-b-45">
                专业种苗服务平台，探索农业生产数据，赋予农户辨别市场变化的能力。</p>
            <div class="my-0">
                <div class="fl flex-4 text-center">
                    <a class="inline-block m-auto shop" href="#"><img
                                class="hoverImg" style="width:288px;"
                                src="https://images.veg.kim/pc/home-code.png">
                    </a>
                    <h6 class="text-secondary pt-2 mb-0">微信扫这个码就能找到我们</h6>
                    <h7 class="pt-2 mb-0">更多服务加载中...</h7>
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
