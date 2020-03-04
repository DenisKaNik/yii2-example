<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\LoginForm */

use common\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
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
                    <a href="/site/login">sign in & sign up</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--//breadcrumbs ends here-->
<!-- signin and signup form -->
<div class="login-form section text-center">
    <div class="container">
        <h4 class="rad-txt">
            <span class="abtxt1">Sign in</span>
            <span class="abtext">sign up</span>
        </h4>

        <?= Alert::widget(); ?>

        <div id="loginbox" style="margin-top:30px;" class="mainbox  loginbox">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Sign In</div>
                    <div class="fpassword">
                        <a href="/site/request-password-reset">Forgot password?</a>
                    </div>
                </div>
                <div style="padding-top:30px" class="panel-body">
                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                    <?php $form = ActiveForm::begin(['id' => 'loginform', 'class' => 'form-horizontal']); ?>
                        <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </span>

                            <?php if (YII_ENV_TEST): ?>
                                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                            <?php else: ?>
                                <input id="login-username" type="text" class="form-control" name="LoginForm[username]" value="" placeholder="username or email" required="">
                            <?php endif; ?>

                        </div>

                        <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-lock"></i>
                                    </span>

                            <?php if (YII_ENV_TEST): ?>
                                <?= $form->field($model, 'password')->passwordInput() ?>
                            <?php else: ?>
                                <input id="login-password" type="password" class="form-control" name="LoginForm[password]" placeholder="password" required="">
                            <?php endif; ?>

                        </div>
                        <div class="input-group">
                            <div class="checkbox">

                                <?php if (YII_ENV_TEST): ?>
                                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                                <?php else: ?>
                                    <label>
                                        <input id="login-remember" type="checkbox" name="LoginForm[rememberMe]" value="1"> Remember me
                                    </label>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->

                            <?php if (YII_ENV_TEST): ?>
                                <div class="form-group">
                                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                                </div>
                            <?php else: ?>
                                <div class="col-sm-12 controls">
                                    <a id="btn-login" href="#" class="btn btn-success">Login </a>
                                </div>
                            <?php endif; ?>

                        </div>
                        <div style="margin-top:60px" class="form-group">
                            <div class="col-md-12 control">
                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                    Don't have an account!
                                    <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                        Sign Up Here
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox loginbox">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Sign Up</div>
                    <div style="float:right; font-size: 85%; position: relative; top:-10px">
                        <a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a>
                    </div>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['id' => 'form-signup', 'class' => 'form-horizontal']); ?>
                        <div id="signupalert" style="display:none" class="alert alert-danger">
                            <p>Error:</p>
                            <span></span>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-3 control-label">Email</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" name="email" placeholder="Email Address" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-3 control-label">First Name</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" name="firstname" placeholder="First Name" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-3 control-label">Last Name</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" name="lastname" placeholder="Last Name" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-3 control-label">Password</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="password" class="form-control" name="passwd" placeholder="Password" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- Button -->
                            <div class="signup-btn">
                                <button id="btn-signup" type="button" class="btn btn-info">
                                    <i class="icon-hand-right"></i> &nbsp; Sign Up</button>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--//signin and signup form ends here-->
