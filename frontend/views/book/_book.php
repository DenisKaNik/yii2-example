<?php

/**
 * @var $book \library\entities\Library\Book\Book
 */

use library\helpers\BookHelper;

?>

<div class="col-md-3 product-men">
    <div class="product-chr-info chr">
        <div class="thumbnail">
            <a href="/book/<?=$book->slug;?>">
                <img src="/images/lib<?=rand(1,8);?>.jpg" alt="">
            </a>
        </div>
        <div class="caption">
            <h4><?=$book->name;?></h4>
            <p><?=BookHelper::listAuthors($book);?></p>
            <div class="matrlf-mid">
                <div>ISBN: <?=$book->isbn;?></div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
</div>