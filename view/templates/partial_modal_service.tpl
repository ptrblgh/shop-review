<div class="modal fade bs-modal-sm" id="service-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="bs-example bs-example-tabs">
                <ul id="myTab" class="nav nav-tabs">
                  <li class="active"><a href="#login" data-toggle="tab">Log In</a></li>
                  <li class=""><a href="#register" data-toggle="tab">Register</a></li>
                  <li class=""><a href="#forgot" data-toggle="tab">Forgot</a></li>
                </ul>
            </div>
            <div class="modal-body">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in text-center" id="login">
                        <form name="form-login" id="form-login" method="post" action ="/user/login">
                            <div class="form-group">
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="login-username">Username</label>
                                    <input type="text" name="login_username" id="login-username" class="form-control" placeholder="Username" />
                                    <span class="form-control-feedback glyphicon glyphicon-user"></span>
                                </div>
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="login-psw">Password</label>
                                    <input type="password" name="login_psw" id="login-psw" class="form-control" placeholder="Password" />
                                    <span class="form-control-feedback glyphicon glyphicon-lock"></span>
                                </div>
                                <div class="form-group">
                                    <label class="" for="rememberme">
                                        <input type="checkbox" name="rememberme" id="rememberme" value="Remember me"> Remember me
                                    </label>
                                </div>
                                <div class="name-group">
                                    <input type="text" name="login-name" id="login-name" class="form-control" placeholder="E-mail" />
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="button" name="login-btn" id="login-btn" class="btn btn-success">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade text-center" id="register">
                        <form name="form-register" id="form-register" method="post" action ="/user/register">
                            <div class="form-group">
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="register-username">Username</label>
                                    <input type="text" name="register_username" id="register-username" class="form-control" placeholder="Username" />
                                    <span class="form-control-feedback glyphicon glyphicon-user"></span>
                                </div>
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="register-psw">Password</label>
                                    <input type="password" name="register_psw" id="register-psw" class="form-control" placeholder="Password" />
                                    <span class="form-control-feedback glyphicon glyphicon-lock"></span>
                                </div>
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="register-psw2">Re-enter password</label>
                                    <input type="password" name="register_psw2" id="register-psw2" class="form-control" placeholder="Password" />
                                    <span class="form-control-feedback glyphicon glyphicon-lock"></span>
                                </div>
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="register-email">E-mail</label>
                                    <input type="text" name="register_email" id="register-email" class="form-control" placeholder="E-mail" />
                                    <span class="form-control-feedback glyphicon glyphicon-envelope"></span>
                                </div>
                                <div class="name-group">
                                    <input type="text" name="register_name" id="register-name" class="form-control" placeholder="E-mail" />
                                </div>
                                <div class="form-group text-center">
                                    <button type="button" name="register-btn" id="register-btn" class="btn btn-success">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade text-center" id="forgot">
                        <form name="form-forgot" id="form-forgot" method="post" action ="/user/forgot">
                            <div class="form-group">
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="forgot-email">E-mail</label>
                                    <input type="text" name="forgot_email" id="forgot-email" class="form-control" placeholder="E-mail" />
                                    <span class="form-control-feedback glyphicon glyphicon-envelope"></span>
                                </div>
                                <div class="name-group">
                                    <input type="text" name="forgot-name" id="forgot-name" class="form-control" placeholder="E-mail" />
                                </div>
                                <div class="form-group text-center">
                                    <button type="button" name="forgot-btn" id="forgot-btn" class="btn btn-success">New password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /#service-modal -->
