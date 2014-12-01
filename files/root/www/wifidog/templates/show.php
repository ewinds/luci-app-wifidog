<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <title><?= $title ?></title>
    <link href="/assets/portal.css" media="all" rel="stylesheet" />
    <script src="/assets/portal.min.js"></script>
</head>

<body>
    <header class="bar bar-nav">
        <h1 class="title"><?= $title ?></h1>
    </header>
    <div class="bar bar-standard bar-footer"><a class="icon icon-gear pull-right btn-click" href="http://wanluo.tv">万罗热点驱动</a>
    </div>
    <div class="content" id="ads">
        <form class="hidden">
            <input id="url" type="text" value="http://www.kanxinqi.com/shorturl.php?shorturl=qst67h" />
        </form>
        <ul class="table-view no-margin">
            <li class="table-view-cell no-nav"><span class="icon icon-info media-object pull-left"></span>
                <div class="media-body" id="counter">正在连接免费Wi-Fi网络，
                    <br /><span class="counter"></span>秒后点击完成上网</div>
            </li>
        </ul>
        <div class="swipe" id="slider">
            <div class="swipe-wrap">
                <div><img alt="Loader" data-src="http://wanluouploadimg.qiniudn.com/o_1921o9cdelbd1cs81lio6671k1a9.jpg" src="/assets/loader.gif" />
                </div>
            </div>
            <ul class="redbar">
                <li class="homeicon-redbar"></li>
            </ul>
        </div>
    </div>
    <div class="content hidden" id="success">
        <ul class="table-view no-margin-top">
            <li class="table-view-cell media"><span class="icon icon-check icon-circle media-object pull-left"></span>
                <div class="media-body">您已经成功接入免费Wi-Fi网络</div>
            </li>
            <li class="table-view-cell media">
                <a class="navigate-right btn-click" href="http://weixin.qq.com/r/BXTWzt-EyIK3rZut9yEX"><img alt="Wanluo icon" class="media-object pull-left" src="http://dlwlcy-img.qiniudn.com/wanluo_icon.png" />
                    <div class="media-body">欢迎关注我们
                        <p>打开微信，添加朋友中查找微信号：wanluoredian</p>
                        <p>或扫描以下二维码</p>
                        <p><img alt="Qrcode for gh e30d40ef8dcc 430" src="http://dlwlcy-img.qiniudn.com/qrcode_for_gh_e30d40ef8dcc_430.jpg" />
                        </p>
                    </div>
                </a>
            </li>
            <li class="table-view-cell media"><img alt="Loader" class="media-object pull-left" src="/assets/loader.gif" />
                <div class="media-body">正在为您跳转。。。</div>
            </li>
        </ul>
    </div>
    <div class="content hidden" id="uv">
        <iframe data-src="http://www.kanxinqi.com/shorturl.php?shorturl=qst67h"></iframe>
        <iframe data-src="http://www.kanxinqi.com/shorturl.php?shorturl=hta72u"></iframe>
        <iframe data-src="/cnzz/<?= $id ?>"></iframe>
    </div>
    <script type="text/javascript">
        Zepto(function($) {
            $('img').unveil(200, function() {
                $(this).load(function() {
                    campo.swipe.load();
                });
            });
            $('.swipe img').trigger("unveil");
        });
    </script>
</body>

</html>