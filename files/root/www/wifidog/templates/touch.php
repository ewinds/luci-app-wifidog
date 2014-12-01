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
    <div class="content">
        <div class="swipe" id="slider">
            <div class="swipe-wrap">
                <div>
                    <img src="/assets/images/1.jpg">
                </div>
                <div>
                    <img src="/assets/images/2.jpg">
                </div>
            </div>
            <ul class="redbar">
                <li class="homeicon-redbar">
            </ul>
        </div>
        <?php if (isset($mac)): ?>
            <form accept-charset="UTF-8" action="/users" class="new_user" id="user-form" method="post">
                <div style="display:none">
                    <input name="utf8" type="hidden" value="&#x2713;" />
                </div>
                <ul class="table-view table-view-agree">
                    <li class="table-view-cell">
                        <p>为了向您提供安全可靠的免费Wi-Fi服务，用户首次使用需获取<b>手机短信验证码</b>注册</li>
                    <li class="table-view-cell">
                        <input id="user_phone" name="phone" placeholder="请输入手机号" type="text" />
                        <input id="user_mac" name="mac" type="hidden" value="<?= $mac ?>" />
                    </li>
                    <li class="table-view-cell">
                        <div class="media-body">同意<a href="#serviceModal">《万罗热点用户协议》</a>
                        </div>
                        <div class="toggle active" id="agree">
                            <div class="toggle-handle"></div>
                        </div>
                    </li>
                </ul>
            </form>
            <div class="content-padded">
                <button class="btn btn-block btn-positive" id="getCode"><span id="waiting"></span> 获取验证码</button>
            </div>
        <?php else: ?>
            <ul class="table-view table-view-agree">
                <li class="table-view-cell">
                    <p>欢迎您再次使用万罗热点，享受免费Wi-Fi服务</p>
                </li>
                <li class="table-view-cell">
                    <div class="media-body">同意<a href="#serviceModal">《万罗热点用户协议》</a>
                    </div>
                    <div class="toggle active" id="agree">
                        <div class="toggle-handle"></div>
                    </div>
                </li>
            </ul>
            <div class="content-padded">
                <button class="btn btn-positive btn-block" href="/portal/touch" id="connect">一键上网</button>
            </div>
        <?php endif; ?>
    </div>
    <div class="modal" id="serviceModal">
        <header class="bar bar-nav"><a href="#serviceModal"><span class="icon icon-left-nav pull-left"></span><h1 class="title">万罗热点用户协议</h1></a>
        </header>
        <div class="content">
            <div class="content-padded">
                <p>免费无线宽带上网服务（以下简称“服务”）是由大连万罗创亿科技有限公司（以下简称“万罗创亿”）在热点场地供应商的有线网络之上提供的无线上网服务。请阅读以下免费无线宽带上网服务的条款与细则，使用者须遵守本服务条款与细则才可以享用本服务。</p>
                <p>1.使用者在使用本服务时应遵守国家法律、法规、规章等相关规定，不得利用本服务危害国家安全、泄露国家秘密，不得侵犯国家社会集体的和公民的合法权益，不得利用本服务制作、复制和传播下列信息：（1）煽动抗拒、破坏宪法和法律、行政法规实施的；（2）煽动颠覆国家政权，推翻社会主义制度的；（3）煽动分裂国家、破坏国家统一的；（4）煽动民族仇恨、民族歧视，破坏民族团结的；（5）捏造或者歪曲事实，散布谣言，扰乱社会秩序的；（6）宣扬封建迷信、淫秽、色情、赌博、暴力、凶杀、恐怖、教唆犯罪的；（7）公然侮辱他人或者捏造事实诽谤他人的，或者进行其他恶意攻击的；（8）损害国家机关信誉的；（9）其他违反宪法和法律行政法规的；（10）进行商业广告行为的。</p>
                <p>2.使用者在使用本服务时的所有行为，均应符合国家法律法规等相关规定及本服务相关规定，符合社会公序良俗，并不侵犯任何第三方主体的合法权益，否则使用者自行承担因此产生的一切法律后果，且万罗创亿因此受到的损失，有权向其追偿。</p>
                <p>3.本服务允许使用者通过任何支持Wi-Fi的手机、笔记本电脑或设备来使用由万罗创亿所提供的无线宽带网络登入互联网。使用者必须使用可以支持Wi-Fi的手机或笔记本电脑及相关软件。使用者有责任确保本服务与其手机、笔记本电脑或设备来配合使用。</p>
                <p>4.万罗创亿有权随时修改、提升或终止本服务。</p>
                <p>5.使用者已清楚明白及同意下列各项：（1）服务须根据指定的设定用法去运作，并且只适用于安装好的相关设备及软件。（2）本服务的提供将会透漏使用者认证网络时所提供的资料及所在地资料，有关资料的使用及保存，均受万罗创亿的标准隐私政策所限。（3）使用者可根据万罗创亿所订立的条款，在指定的热点免费享用无线宽带上网服务；万罗创亿有权在使用者使用免费无线宽带上网服务期间加插广告；万罗创亿有权利随时更改使用者每天可享用的免费无线宽带上网服务时间。（4）热点场地供应商、万罗创亿不会对于使用无线网络以外的有关费用负责、追讨以及赔偿（包括任何关于暂停服务或无线上网连线中断或服务质量而导致使用者的损失），亦无义务向使用者或任何第三者负责，不管此类损失是否是直接或间接的任何类型，包括盈利、损失、利润或任何基于合同法、民事侵权法、成文法律或其他方面的结果性的损失（包括疏忽）。（5）使用者凡是延迟未能履行全部或者部分条款与细则而造成的损失或损害，第三方所为（包括但不限于网络运营商、资讯服务内容提供者及设备供应商）等各种因素的过失导致造成的损失或损害，不可抗力因素（该事件包括但不限于：地震、台风、火灾、水灾、战争、罢工、暴动、黑客攻击、运营商技术故障或政策变化或任何其他自然人或人为造成的灾难等）所造成的损失或损害，热点场地供应商、万罗创亿均毋须负责。</p>
                <p>6.无线网络于该服务覆盖的使用及连线情况，热点场地供应商、万罗创亿将不会对服务质量或服务网络作任何担保。如该服务受到万罗创亿无法控制的因素影响，万罗创亿在此表明保留权利终止此服务。</p>
            </div>
        </div>
    </div>
    <div class="bar bar-standard bar-footer"><a class="icon icon-gear pull-right btn-click" href="http://wanluo.tv">万罗热点驱动</a>
    </div>
    <script type="text/javascript">
        Zepto(function($) {
            $('img').unveil();
            $('.swipe img').trigger("unveil");

            var amount = $('.swipe-wrap div').length;
            $('.redbar li').css({
                'width': 320 / amount
            });

            var swipeBanners = new Swipe($('#slider')[0], {
                callback: function(index, e) {
                    var amount = $('.swipe-wrap div').length / 2;
                    $('.redbar li').css({
                        'left': 320 * (index % amount) / amount,
                        'width': 320 / amount
                    });
                },
                auto: 3000,
                continuous: true
            });

            $('#agree').on('tap', function() {
                $('input').blur();
            });

            $('#getCode').on('tap', function() {
                $('input').blur();

                if ($(this).hasClass('disabled')) {
                    return false;
                }

                var mobile = $('#user_phone').val();
                if (mobile.length == 0) {
                    alert("请输入手机号码");
                    return false;
                }

                var pattern = /^[0-9]{11}$/;
                if (!pattern.exec(mobile)) {
                    alert("请输入有效的手机号码");
                    return false;
                }

                if (!$('#agree').hasClass('active')) {
                    alert("不同意用户协议，您将不能接入网络");
                    return false;
                }

                $('#waiting').waiting({
                    className: 'waiting-circles',
                    elements: 8,
                    radius: 10,
                    auto: true
                });

                $.ajax({
                  type: 'post',
                  url: '/users',
                  // data to be added to query string:
                  data: { phone: mobile, mac: $('#user_mac').val() },
                  // type of data we are expecting in return:
                  dataType: 'json',
                  timeout: 300,
                  context: $('body'),
                  success: function(data){
                    // Supposing this JSON payload was received:
                    //   {"project": {"id": 42, "html": "<div>..." }}
                    // append the HTML to context object.
                    // this.append(data.project.html)
                    if (data.error == '') {
                        window.location.href = '/portal/touch';
                    }
                  },
                  error: function(xhr, type){
                    alert('请稍后再试!')
                  }
                });
            });

            $('#connect').on('tap', function(e) {
                e.preventDefault();

                if (!$('#agree').hasClass('active')) {
                    alert("不同意用户协议，您将不能接入网络");
                } else {
                    window.location.href = $(this).attr("href")
                }
            });

            $('#access-user-form').on('submit', function() {
                $('#waiting').waiting({
                    className: 'waiting-circles',
                    elements: 8,
                    radius: 10,
                    auto: true
                });
            });
        });
    </script>
</body>

</html>