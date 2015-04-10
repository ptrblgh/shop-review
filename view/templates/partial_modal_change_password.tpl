<div class="modal fade bs-modal-sm" id="change-psw-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="bs-example bs-example-tabs">
                <ul id="myTab" class="nav nav-tabs">
                  <li class="active"><a href="#change-psw" data-toggle="tab">Change password</a></li>
                </ul>
            </div>
            <div class="modal-body">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in text-center" id="change-psw">
                        <form name="form-change-psw" id="form-change-psw" method="post" action ="/user/change-psw">
                            <div class="form-group">
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="change-psw-psw">Current password</label>
                                    <input type="password" name="change_psw_current_psw" id="change-psw-psw" class="form-control" placeholder="Current password" />
                                    <span class="form-control-feedback glyphicon glyphicon-lock"></span>
                                </div>
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="change-psw-psw">New password</label>
                                    <input type="password" name="change_psw_psw" id="change-psw-psw" class="form-control" placeholder="New password" />
                                    <span class="form-control-feedback glyphicon glyphicon-lock"></span>
                                </div>
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="change-psw-psw2">Re-enter new password</label>
                                    <input type="password" name="change_psw_psw2" id="change-psw-psw2" class="form-control" placeholder="New password again" />
                                    <span class="form-control-feedback glyphicon glyphicon-lock"></span>
                                </div>
                                <div class="name-group">
                                    <input type="text" name="change_psw_csrf_token" id="change-psw-csrf-token" value="{if isset($change_psw_csrf_token)}{$change_psw_csrf_token}{/if}" />
                                    <input type="text" name="change_psw_name" id="change-psw-name" class="form-control" placeholder="E-mail" />
                                </div>
                                <div class="form-group text-center">
                                    <button type="button" name="change-psw-btn" id="change-psw-btn" class="btn btn-success">Change and Logout</button>
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