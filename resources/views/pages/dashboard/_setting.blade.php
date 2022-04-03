
<div class="row">
    <div class="col-md-12 add_bottom_30">
        <form method="POST" action="{{ route('dashboard.update.password') }}">
            <h4>Change your password</h4>
            <div class="form-group">
                <label>Old password</label>
                <input class="form-control" name="current_password" type="password">
            </div>
            <div class="form-group">
                <label>New password</label>
                <input class="form-control" name="password" type="password">
            </div>
            <div class="form-group">
                <label>Confirm new password</label>
                <input class="form-control" name="new_confirm_password" type="password">
            </div>
            <button type="submit" class="btn_1 green">Update Password</button>
        </form>
    </div>
    {{-- <div class="col-md-6 add_bottom_30">
        <form method="POST">
            <h4>Change your email</h4>
            <div class="form-group">
                <label>Old email</label>
                <input class="form-control" name="old_password" type="text">
            </div>
            <div class="form-group">
                <label>New email</label>
                <input class="form-control" name="new_password" type="text">
            </div>
            <div class="form-group">
                <label>Confirm new email</label>
                <input class="form-control" name="confirm_new_password" type="text">
            </div>
            <button type="submit" class="btn_1 green">Update Email</button>
        </form>
    </div> --}}
</div>
<!-- End row -->