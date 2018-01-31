<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <meta name="keywords" content="@yield('title', config('app.name', 'Laravel'))">
    <meta name="description" content="@yield('title', config('app.name', 'Laravel'))">

</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeIn">
    <div class="sweet-alert" style="display:block;">
        <div class="sa-icon sa-error">
            <span class="sa-x-mark animateXMark">
                <span class="sa-line sa-left"></span>
                <span class="sa-line sa-right"></span>
            </span>
		</div>
        <h2>{{ $message }}</h2>
        <p>页面将会自动跳转，等待时间：<b id="wait">{{$wait}}</b><a id="href" style="display:none" href="{{$url}}">点击跳转</a></p>
    </div>
</div>
<script type="text/javascript">
    (function(){
        var wait = document.getElementById('wait'),href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time <= 0) {
                top.location.href = href;
                clearInterval(interval);
            };
        }, 1000);
    })();
</script>
</body>
</html>
