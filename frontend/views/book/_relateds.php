<?php

/**
 * @var $book \library\entities\Library\Book\Book
 */

?>

<!-- /new_arrivals -->
<?php if ($book->relatedAssignments): ?>
    <div class="section singlep_btm">
        <div class="container">
            <div class="new_arrivals">
                <h4 class="rad-txt">
                    <span class="abtxt1">related</span>
                    <span class="abtext">books</span>
                </h4>

                <?php foreach ($book->relatedAssignmentsActive as $related): ?>
                    <div class="swiper-slide">
                        <?= $this->render('_book', [
                            'book' => $related,
                        ]); ?>
                    </div>
                <?php endforeach; ?>

                <div class="clearfix"></div>
            </div>
            <!--//new_arrivals-->
            <div class="clearfix"></div>

        </div>
    </div>
<?php endif; ?>
