<!-- breadcrumbs -->
<div class="crumbs text-center">
    <div class="container">
        <div class="row">
            <ul class="btn-group btn-breadcrumb bc-list">
                <li class="btn btn1">
                    <a href="/">
                        <i class="glyphicon glyphicon-home"></i>
                    </a>
                </li>
                <li class="btn btn2">
                    <a href="/books">books catalogue</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--//breadcrumbs ends here-->
<!-- Shop -->
<div class="innerf-pages section">
    <div class="container-cart">
        <!-- product left -->
        <div class="side-bar col-md-3" style="background: #fff; border: none;">
            <!--  -->
        </div>
        <!-- //product left -->
        <!-- product right -->
        <div class="left-ads-display col-md-9">
            <div class="wrapper_top_shop">
                <!-- product-sec1 -->
                <div class="product-sec1">

                    <?php if ($dataProvider->getModels()): ?>

                        <?php foreach ($dataProvider->getModels() as $book): ?>
                            <?= $this->render('_book', [
                                'book' => $book,
                            ]); ?>
                        <?php endforeach; ?>

                    <?php else: ?>

                        <div>Books not found.</div>

                    <?php endif; ?>

                </div>

                <!-- //product-sec1 -->
            </div>
        </div>
        <div class="clearfix"></div>

    </div>
</div>
<!--// Shop -->
