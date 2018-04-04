<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>苗果笔记</title>
    <link rel="stylesheet" href="/css/app.css">
    <style>
        a {
            color: #6c757d;
            text-decoration: none;
            background-color: transparent;
            -webkit-text-decoration-skip: objects;
        }

        a:hover {
            color: #495057;
            text-decoration: underline;
        }
        .navbar {
            padding: 0.5rem 1.25rem;
            margin-bottom: 1rem;
            background-color: rgba(255, 255, 255, 0.8);
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }
        .navbar-right {
            display: block;
        }
        .navbar-right li{
            float: left;
            display: block;
            padding:0 5px;

        }
    </style>
</head>
<body>
<div id="app">
    <app></app>
</div>
<script src="/js/app.js"></script>
</body>
</html>
