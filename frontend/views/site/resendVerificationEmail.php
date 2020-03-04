<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model frontend\models\ResetPasswordForm */

use common\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Resend verification email';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (YII_ENV_TEST): ?>
    <h1><?= Html::encode($this->title) ?></h1>
<?php endif; ?>

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
                    <a href="/site/resend-verification-email"><?= Html::encode($this->title) ?></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--//breadcrumbs ends here-->

<div class="login-form section text-center">
    <div class="container">
        <h4 class="rad-txt">
            <span class="abtxt1">Resend</span>
            <span class="abtext">verification email</span>
        </h4>

        <?= Alert::widget(); ?>

        <p>Please fill out your email. A verification email will be sent there.</p>

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

                    <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form', 'class' => 'form-horizontal']); ?>
                        <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-user"></i>
                                        </span>

                            <?php if (YII_ENV_TEST): ?>
                                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
                            <?php else: ?>
                                <input id="login-username" type="text" class="form-control" name="ResetPasswordForm[username]" value="" placeholder="username or email" required="">
                            <?php endif; ?>
                        </div>

                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->

                            <?php if (YII_ENV_TEST): ?>
                                <div class="form-group">
                                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                                </div>
                            <?php else: ?>
                                <div class="col-sm-12 controls">
                                    <a id="btn-login" href="#" class="btn btn-success">Send </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
