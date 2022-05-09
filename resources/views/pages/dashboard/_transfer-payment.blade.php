@extends('layouts.app')

@section('css')
<!-- SPECIFIC CSS -->
<link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="img/admin_top.jpg" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>Hello {{ Auth::user()->firstname }}!</h1>
                <p>Start managing your account.</p>
            </div>
        </div>
    </section>

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="#">Dashboard</a>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="margin_60 container">
        <div class="row">
            <div class="col-6">
                <h4>Transfer Payment</h4>
            </div>
            <div class="col-6">
                <a href="{{ route('dashboard.index') }}" class="btn_1 float-right text-white">Cancel</a>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('dashboard.transaction.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $transaction->id }}" name="id">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Price</label>
                                <input class="form-control" name="price" value="{{ $transaction->price }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Business Tax</label>
                                <input class="form-control" name="price" value="{{ $transaction->business_tax }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Payment to Transfer</label>
                                <input class="form-control" name="price" value="{{ $transaction->payment }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Mark Status as Paid</label>
                                <select class="form-control" name="is_paid">
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                Owner: {{ $user->firstname }} {{ $user->lastname }}
                            </p>
                        </div>
                        <div class="col-md-12">
                            <p>
                                Gcash: {{ $user->gcash }}
                            </p>
                        </div>
                        <div class="col-md-12">
                            <p>
                                PayPal: {{ $user->paypal }}
                            </p>
                        </div>
                        <div class="col-md-12">
                            <p>
                                Bank: {{ $user->bank }}
                            </p>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Payment Method</label>
                                <select class="form-control" name="mode_of_payment">
                                    <option value="Gcash: {{ $user->gcash }}">Gcash</option>
                                    <option value="PayPal: {{ $user->paypal }}">PayPal</option>
                                    <option value="Bank {{ $user->bank }}">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn-block btn_1 green">Transfer Payment</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection