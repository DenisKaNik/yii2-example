<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use common\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
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
                    <a href="/site/request-password-reset"><?= Html::encode($this->title) ?></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--//breadcrumbs ends here-->

<div class="login-form section text-center">
    <div class="container">
        <h4 class="rad-txt">
            <span class="abtxt1">Request</span>
            <span class="abtext">password reset</span>
        </h4>

        <?= Alert::widget(); ?>

        <p>Please fill out your email. A link to reset password will be sent there.</p>

        <div id="loginbox" style="margin-top:30px;" class="mainbox  loginbox">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title"><?= Html::encode($this->title) ?></div>
                    <div class="fpassword">
                        <a href="/site/login">Sign In</a>
                    </div>
                </div>
                <div style="padding-top:30px" class="panel-body">
                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                    <?php $form = ActiveForm::begin(['id' => 'loginform', 'class' => 'form-horizontal']); ?>
                    <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </span>
                        <input id="login-username" type="text" class="form-control" name="ResetPasswordForm[email]" value="" placeholder="username or email" required="">
                    </div>

                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <a id="btn-login" href="#" class="btn btn-success">Send </a>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
