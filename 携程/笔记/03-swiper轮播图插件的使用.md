# swiper轮播图插件的基本使用

1. 首先加载插件，需要用到的文件有swiper.min.js和swiper.min.css文件
```html
<!DOCTYPE html>
<html>
<head>
    <!-- swiper轮播插件 -->
    <link rel="stylesheet" href="./lib/swiper/css/swiper.min.css">
    <script src="./lib/swiper/js/swiper.min.js"></script>
</head>
<body>
    
</body>
</html>

2. 实现html的主体结构
```html
<!DOCTYPE html>
<html>
<head>
    <!-- swiper轮播插件 -->
    <link rel="stylesheet" href="./lib/swiper/css/swiper.min.css">
    <script src="./lib/swiper/js/swiper.min.js"></script>
</head>
<body>
    <!-- 轮播图的div-->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">第一屏</div>
            <div class="swiper-slide">第二屏</div>
            <div class="swiper-slide">第三屏</div>
        </div>
        <!-- 如果需要分页器 -->
        <div class="swiper-pagination"></div>
    </div>
</body>
</html>

3. 调用js让轮播图插件生效
```html
<!DOCTYPE html>
<html>
<head>
    <!-- swiper轮播插件 -->
    <link rel="stylesheet" href="./lib/swiper/css/swiper.min.css">
    <script src="./lib/swiper/js/swiper.min.js"></script>
</head>
<body>
    <!-- 轮播图的div-->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">第一屏</div>
            <div class="swiper-slide">第二屏</div>
            <div class="swiper-slide">第三屏</div>
        </div>
        <!-- 如果需要分页器 -->
        <div class="swiper-pagination"></div>
    </div>

    <script>
        var swiper = new Swiper('.swiper-container', {
            pagination: {
            el: '.swiper-pagination',
            },
        });
    </script>
</body>
</html>
```


