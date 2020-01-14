<form id="reset_password_form" data="{{ $user->slug }}">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Reset Password</h4>
  </div>
  <div class="modal-body">
    <label>{{$user->firstname}} {{$user->middlename}} {{$user->lastname}}</label>
    <hr class="no-margin">
    <div class="row">
      {!! __form::textbox(
          '12 username', 'username', 'text', 'Username *', 'Username', $user->username, 'username', '', ''
      ) !!}
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="checkbox">
          <label>
            <input type="checkbox" class="change_pass_chk"> Change Password
          </label>
        </div>
      </div>
    </div>
    <div class="password_container">
      <div class="row">
        {!! __form::textbox_password_btn(
          '12 password', '', 'Password *', 'Password', '', 'password', '', 'disabled="disabled"'
        ) !!}
      </div>
      <div class="row"> 
        {!! __form::textbox_password_btn(
          '12 password_confirmation', '', 'Confirm Password *', 'Confirm Password', '', 'password_confirmation', '', 'disabled="disabled"'
        ) !!}
      </div>  
    </div>

    <hr>
    <div class="row"> 
      {!! __form::textbox_password_btn(
        '12 user_password', 'user_password', 'Enter your password to continue:', 'Enter your password', '', 'user_password', '', ''
      ) !!}
    </div> 
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary update_account_btn"><i class="fa fa-save fa-fw"></i> Save</button>
  </div>
</form>