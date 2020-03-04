<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\helpers\Common as CommonHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Custom Theme files -->
    <link href="/css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
    <!-- shop css -->
    <link href="/css/shop.css" type="text/css" rel="stylesheet" media="all">
    <!-- gallery desoslide -->
    <link rel="stylesheet" href="/css/animate.min.css">
    <link rel="stylesheet" href="/css/jquery.desoslide.css">
    <!-- gallery desoslide -->
    <link href="/css/style.css" type="text/css" rel="stylesheet" media="all">
    <link href="/css/font-awesome.css" rel="stylesheet">
    <!-- font-awesome icons -->
    <!-- //Custom Theme files -->
    <!-- online-fonts -->
    <!-- logo -->
    <link href="//fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">
    <!-- titles -->
    <link href="//fonts.googleapis.com/css?family=Merriweather+Sans:300,300i,400,400i,700,700i,800,800i" rel="stylesheet">
    <!-- body -->
    <link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <!-- //online-fonts -->
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<?php $this->beginBody() ?>

<div id="home">
    <!-- header -->
    <!-- navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="main-nav">
            <div class="container">

                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Chronicle</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <h1>
                        <a class="navbar-brand" href="/">Chronicle</a>
                    </h1>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse nav-right">
                    <?php
                        echo Nav::widget([
                            'options' => ['class' => 'nav navbar-nav navbar-left cl-effect-15'],
                            'items' => [
                                ['label' => 'Home', 'url' => ['/']],
                                ['label' => 'About', 'url' => ['/about']],
                                ['label' => 'Contact', 'url' => ['/contact']],
                            ],
                        ]);
                    ?>
                </div>
                <!-- /.navbar-collapse -->
                <div class="clearfix"></div>
            </div>
            <!-- /.container -->
        </div>
    </nav>
    <!-- //navbar ends here -->

    <!-- banner -->
    <?php if (CommonHelper::isHomePage()): ?>
        <div class="banner-bg-agileits">
            <!-- banner-text -->
            <div class="banner-text">
                <div class="container">
                    <p class="b-txt">the</p>
                    <h2 class="title">
                        Library
                    </h2>
                    <ul class="banner-txt">
                        <li>share.</li>
                        <li> explore. </li>
                        <li>amplify.</li>
                    </ul>
                </div>
            </div>
            <!-- //banner-text -->
        </div>
    <?php else: ?>
        <div class="banner-bg-inner">
            <!-- banner-text -->
            <div class="banner-text-inner">
                <div class="container">
                    <h2 class="title-inner">
                        world of reading
                    </h2>

                </div>
            </div>
            <!-- //banner-text -->
        </div>
    <?php endif; ?>
    <!-- //banner -->

    <?php if (YII_ENV_TEST): ?>
        <div style="display: none;">
            <?= Alert::widget(); ?>
            <h1><?= Html::encode($this->title) ?></h1>
            <?php
                NavBar::begin([
                    'brandLabel' => Yii::$app->name,
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar-inverse navbar-fixed-top',
                    ],
                ]);
                $menuItems = [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                ];

                if (Yii::$app->user->isGuest) {
                    $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
                } else {
                    $menuItems[] = '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>';
                }

                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => $menuItems,
                ]);
                NavBar::end();
            ?>
        </div>
    <?php endif; ?>

    <?= $content ?>

    <!-- footer -->
    <div class="footer-bottom section">
        <div class="container">
            <!-- newsletter -->
            <div class="subscribe-main section-w3layouts text-center">
                <h4 class="rad-txt">
                    <span class="abtxt1">keep yourself</span>
                    <span class="abtext">updated</span>
                </h4>
                <h5>subscribe to our newsletter to stay up-to-date with our projects.</h5>
                <div class="subscribe-form">
                    <form action="#" method="post" class="subscribe_form">
                        <div class="email-news">
                            <input type="email" placeholder="Email" required="">
                        </div>
                        <div class="sub-news">
                            <input type="submit" value="subscribe">
                        </div>
                    </form>
                    <div class="clearfix"> </div>
                </div>
                <p>We respect your privacy.No spam ever!</p>
            </div>
            <!-- //newsletter ends here -->
            <!-- footer grids-->
            <div class="footer-cpy">
                <!-- footer-grid1 -->
                <div class="col-md-3 col-sm-6 footer-logo">
                    <h3>
                        <a href="/">Chronicle</a>
                    </h3>
                    <h4>about us</h4>
                    <p>Vallis Molestie Arcu Morbi Dapibus Suscipit Ante Sit Efficitur Eu estie Arcu Mor Anestie Ate Vesti.</p>
                </div>
                <!-- //footer-grid1 -->
                <!-- footer-grid2 -->
                <div class="col-md-3 col-sm-6 footer-nav text-center">
                    <h4>navigation</h4>
                    <ul>
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <a href="<?=Url::to(['/about']);?>">About us</a>
                        </li>
                        <li>
                            <a href="<?=Url::to(['/contact']);?>">contact us</a>
                        </li>
                    </ul>
                </div>
                <!-- //footer-grid2 -->
                <!-- footer-grid3 -->
                <div class="col-md-3 col-sm-6 blog-footer">
                    <h4>latest from blog</h4>
                    <div class="blog1">
                        <div class="col-md-3 col-sm-3 col-xs-2 bl1">
                            <a href="#">
                                <img src="/images/b1.jpg" alt="" class="img-responsive" />
                            </a>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-10 bl2">
                            <a href="#">Dapibus Suscipit Ante Sit by instagram</a>
                            <p>February 15, 2018</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="blog1">
                        <div class="col-md-3 col-sm-3 col-xs-2 bl1">
                            <a href="#">
                                <img src="/images/b2.jpg" alt="" class="img-responsive" />
                            </a>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-10 bl2">
                            <a href="#">Dapibus Suscipit Ante Sit by instagram</a>
                            <p>February 20, 2018</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- //footer-grid3 -->
                <!-- footer-grid4 -->
                <div class="col-md-3 col-sm-6 contact-foot text-right">
                    <h4>contact us</h4>
                    <ul>
                        <li>
                            <span class="fa fa-home"></span>
                            1185 Burlington
                            <br> Canada.
                        </li>
                        <li>
                            <span class="fa fa-phone"></span>
                            +12 345 678
                        </li>
                        <li>
                            <span class="fa fa-envelope"></span>
                            <a href="mailto:info@example.com">mail@chronicle.com</a>
                        </li>
                    </ul>
                </div>
                <!-- //footer-grid4 -->
                <div class="clearfix"></div>
            </div>
            <!-- //footer-grids -->
            <!-- footer social -->
            <div class="footer-social text-center">
                <h4>stay connected</h4>
                <ul>
                    <li>
                        <a href="#">
                            <span class="fa fa-facebook icon_facebook"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="fa fa-twitter icon_twitter"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="fa fa-dribbble icon_dribbble"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="fa fa-google-plus icon_g_plus"></span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- //footer social -->
        </div>
        <!-- //footer container -->
    </div>
    <!-- //footer -->
    <div class="cpy-right">
        <p>© <?=date('Y');?> Chronicle. All rights reserved | Design by
            <a href="http://w3layouts.com"> W3layouts.</a>
        </p>
    </div>
</div>
<!-- //home -->
<!-- js -->
    <script src="/js/jquery-2.2.3.min.js"></script>
<!-- //js -->
<!-- dropdown nav -->
<script>
    $(document).ready(function () {
        $(".dropdown").hover(
            function () {
                $('.dropdown-menu', this).stop(true, true).slideDown("fast");
                $(this).toggleClass('open');
            },
            function () {
                $('.dropdown-menu', this).stop(true, true).slideUp("fast");
                $(this).toggleClass('open');
            }
        );
    });
</script>
<!-- //dropdown nav -->
<!--search jQuery-->
<script src="/js/main.js"></script>
<!--search jQuery-->
<!-- cart-js -->
<script src="/js/minicart.js"></script>
<script>
    chr.render();

    chr.cart.on('new_checkout', function (evt) {
        var items, len, i;

        if (this.subtotal() > 0) {
            items = this.items();

            for (i = 0, len = items.length; i < len; i++) {}
        }
    });
</script>
<!-- //cart-js -->
<?php if (Url::current() == '/about'): ?>
    <!-- gallery desoslide -->
    <script src="/js/jquery.desoslide.min.js"></script>
    <script src="/js/demo.js"></script>
    <!-- gallery desoslide -->
<?php endif; ?>
<!-- Scrolling Nav JavaScript -->
<script src="/js/scrolling-nav.js"></script>
<!-- //fixed-scroll-nav-js -->
<!-- start-smooth-scrolling -->
<script src="/js/move-top.js"></script>
<script src="/js/easing.js"></script>
<script>
    jQuery(document).ready(function ($) {
        $(".scroll").click(function (event) {
            event.preventDefault();

            $('html,body').animate({
                scrollTop: $(this.hash).offset().top
            }, 1000);
        });
    });
</script>
<!-- //end-smooth-scrolling -->

<?php if (Url::current() == '/about'): ?>
    <!-- smooth-scrolling-of-move-up -->
    <script>
        $(document).ready(function () {
            /*
            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear'
            };
            */

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <script src="/js/SmoothScroll.min.js"></script>
    <!-- //smooth-scrolling-of-move-up -->

    <!-- about bottom grid Numscroller -->
    <script src="/js/numscroller-1.0.js"></script>
    <!-- //about bottom grid Numscroller -->
<?php endif; ?>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/js/bootstrap.js"></script>

<?php if (Url::current() != '/about'): ?>
    <?php $this->endBody() ?>
<?php endif; ?>

</body>
</html>
<?php $this->endPage() ?>
