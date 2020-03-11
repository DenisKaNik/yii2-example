<?php

/**
 * @var $book \library\entities\Library\Book\Book
 */

use library\helpers\BookHelper;

?>
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
                    <a href="/books">Product Catalogue</a>
                </li>
                <li class="btn btn3">
                    <a href="/book/<?=$book->slug;?>">Single product</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--//breadcrumbs ends here-->

<!-- Single -->
<div class="innerf-pages section">
    <div class="container">
        <div class="col-md-4 single-right-left ">
            <div class="grid images_3_of_2">
                <div class="flexslider1">
                    <ul class="slides">
                        <li data-thumb="/images/s1.jpg">
                            <div class="thumb-image">
                                <img src="/images/lib8.jpg" data-imagezoom="true" alt=" " class="img-responsive"> </div>
                        </li>
                        <li data-thumb="/images/s2.jpg">
                            <div class="thumb-image">
                                <img src="/images/s2.jpg" data-imagezoom="true" alt=" " class="img-responsive"> </div>
                        </li>
                        <li data-thumb="/images/s3.png">
                            <div class="thumb-image">
                                <img src="/images/s3.png" data-imagezoom="true" alt=" " class="img-responsive"> </div>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
        <div class="col-md-8 single-right-left simpleCart_shelfItem">
            <h3><?=$book->name;?></h3>
            <p><?=BookHelper::listAuthors($book);?></p>
            <div class="desc_single">
                <h5>Description</h5>
                <p><?=$book->description;?></p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>

<?= $this->render('_relateds', [
    'book' => $book,
]); ?>

<!--// Single -->