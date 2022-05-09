@extends('layouts.app')

@section('content')
<section class="parallax-window" 
style="background-image: url({{ asset('assets/img/admin-top.jpg') }});"
data-parallax="scroll" data-image-src="img/hotels_bg.jpg" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-1">
        <div class="animated fadeInDown">
            <h1>Create Your Account</h1>
            <p>List your hotels and tours with us.</p>
            <p>Also you can book with our hotels.</p>
        </div>
    </div>
</section>
<!-- End section -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="#">Register</a>
            </li>
        </ul>
    </div>
</div>
<!-- Position -->

<div class="container margin_60">
    <div class="row">
        <div class="col-md-12 add_bottom_30">
            <h4 class="text-center">Create new account</h4>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        <input type="hidden" value="{{ Request::get('lister') ?? 2 }}" name="role">
                        @csrf
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input class="form-control" name="firstname" type="text" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" name="lastname" type="text" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" type="email" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>New password</label>
                                    <input class="form-control" name="password" type="password" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm new password</label>
                                    <input class="form-control" name="password_confirmation" type="password" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn_1 green btn-block">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
