<div class="row">
    <div class="col-md-12 add_bottom_30">
        <form method="POST" action="{{ route('dashboard.update.password') }}">
            @csrf
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
</div>