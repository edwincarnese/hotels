<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ config('app.name') }}</title>

    <!-- Favicons-->
    {{-- <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"> --}}
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Gochi+Hand|Montserrat:300,400,700" rel="stylesheet">

    <!-- COMMON CSS -->
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/vendors.css') }}" rel="stylesheet">

	<!-- CUSTOM CSS -->
	<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

	@yield('css')
</head>

<body>
    <div id="preloader">
        <div class="sk-spinner sk-spinner-wave">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
    </div>

    <div class="layer"></div>
    <!-- Mobile menu overlay mask -->

    @include('partials.header')
	
	<main>
        @yield('content')
	</main>
    
    @include('partials.footer')

	<div id="toTop"></div>
	
	<div class="search-overlay-menu">
		<span class="search-overlay-close"><i class="icon_set_1_icon-77"></i></span>
		<form role="search" id="searchform" method="get">
			<input value="" name="q" type="search" placeholder="Search..." />
			<button type="submit"><i class="icon_set_1_icon-78"></i>
			</button>
		</form>
	</div>
	
	<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
		<div class="small-dialog-header">
			<h3>Sign In</h3>
		</div>
		<form method="POST" action="{{ route('login') }}">
			@csrf
			<div class="sign-in-wrapper">
				{{-- <a href="#0" class="social_bt facebook">Login with Facebook</a>
				<a href="#0" class="social_bt google">Login with Google</a>
				<div class="divider"><span>Or</span></div> --}}
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
					<i class="icon_mail_alt"></i>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required>
					<i class="icon_lock_alt"></i>
				</div>
				{{-- <div class="clearfix add_bottom_15">
					<div class="checkboxes float-left">
						<input id="remember-me" type="checkbox" name="check">
						<label for="remember-me">Remember Me</label>
					</div>
					<div class="float-right"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
				</div> --}}
				<div class="text-center"><input type="submit" value="Log In" class="btn_login"></div>
				<div class="text-center">
					Don’t have an account? <a href="/register">Sign up</a>
				</div>
				<div id="forgot_pw">
					<div class="form-group">
						<label>Please confirm login email below</label>
						<input type="email" class="form-control" name="email_forgot" id="email_forgot">
						<i class="icon_mail_alt"></i>
					</div>
					<p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
					<div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
				</div>
			</div>
		</form>
		<!--form -->
	</div>

	<div class="modal fade" id="myReview" tabindex="-1" role="dialog" aria-labelledby="myReviewLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myReviewLabel">Write your review</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<form method="post" action="{{ route('user.review') }}">
						@csrf
						<input type="hidden" name="tour_id" value="{{ $tour_id ?? '' }}">
						<input type="hidden" name="unit_id" value="{{ $unit_id ?? '' }}">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Rate:</label>	&nbsp;
									<input type="radio" name="rate" value="5">&nbsp;<label>5&nbsp;<img  style= "width:20px; height:20px;  position: absolute; top:0%;" src="{{ asset('assets/img/star.png') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
									<input type="radio" name="rate" value="4">&nbsp;<label>4&nbsp;<img  style= "width:20px; height:20px;  position: absolute; top:0%;" src="{{ asset('assets/img/star.png') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
									<input type="radio" name="rate" value="3">&nbsp;<label>3&nbsp;<img  style= "width:20px; height:20px;  position: absolute; top:0%;" src="{{ asset('assets/img/star.png') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
									<input type="radio" name="rate" value="2">&nbsp;<label>2&nbsp;<img  style= "width:20px; height:20px;  position: absolute; top:0%;" src="{{ asset('assets/img/star.png') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
									<input type="radio" name="rate" value="1">&nbsp;<label>1&nbsp;<img  style= "width:20px; height:20px;  position: absolute; top:0%;" src="{{ asset('assets/img/star.png') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
								
									{{-- <select class="form-control" name="rate" required>									
										<option value="">Please review></option>
										<option value="Low">Low</option>
										<option value="Sufficient">Sufficient</option>
										<option value="Good">Good</option>
										<option value="Excellent">Excellent</option>
										<option value="Superb">Super</option>
										<option value="Not rated">I don't know</option>
									</select> --}}
								</div>
							</div>
						</div>
						<div class="form-group">
							<textarea name="message" id="review_text" class="form-control" style="height:100px" placeholder="Write your review" required></textarea>
						</div>
						<button type="submit" class="btn_1">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>

    <script src="{{ asset('assets/js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/common_scripts_min.js') }}"></script>
    <script src="{{ asset('assets/js/functions.js') }}"></script>
	
	{{-- <script src="{{ asset('assets/js/notify_func.js') }}"></script> --}}
	@yield('js')
</body>

</html>