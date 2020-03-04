<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<div class="section contact" id="contact">
    <div class="container">
        <h4 class="rad-txt text-center">
            <span class="abtxt1">error</span>
            <span class="abtext">page</span>
        </h4>
        <!-- contact details -->
        <div class="contact-bottom">
            <h6><?= Html::encode($this->title) ?></h6>

            <div class="alert alert-danger">
                <?= nl2br(Html::encode($message)) ?>
            </div>

            <!-- contact details left -->
            <div class="col-md-6 col-sm-6">
                <div class="contact-left">
                    <div class="address">
                        <p>
                            The above error occurred while the Web server was processing your request.
                        </p>
                    </div>
                    <div class="address address-mdl">
                        <p>
                            Please contact us if you think this is a server error. Thank you.
                        </p>
                    </div>
                </div>
            </div>
            <!-- //contact details left -->
                <div class="clearfix"></div>
            </div>
            <!-- //contact-details right -->
            <div class="clearfix"></div>
        </div>
        <!-- //contact details ends here -->
    </div>
</div>
