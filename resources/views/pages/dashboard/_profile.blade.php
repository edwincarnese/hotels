<form method="POST" action="{{ route('dashboard.update.profile') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <h4>Your profile</h4>
            <ul id="profile_summary">
                <li>EMAIL <span>{{ Auth::user()->email }}</span>
                </li>
                <li>First name <span>{{ Auth::user()->firstname }}</span>
                </li>
                <li>Last name <span>{{ Auth::user()->lastname }}</span>
                </li>
                <li>Phone number <span>{{ Auth::user()->phone }}</span>
                </li>
                <li>Street address <span>{{ Auth::user()->address }}</span>
                </li>
                <li>Town/City <span>{{ Auth::user()->city }}</span>
                </li>
                <li>Zip code <span>{{ Auth::user()->zip }}</span>
                </li>
                <li>Country <span>{{ Auth::user()->country }}</span>
                </li>
            </ul>
        </div>
        <div class="col-md-6">
            <p>
                @if(Auth::user()->photo)
                    <img src="{{ asset('storage/'.Auth::user()->photo) }}" width="250" class="img-fluid styled profile_pic">
                @else
                    <img src="{{ asset('assets/img/tourist_guide_pic.jpg') }}" class="img-fluid styled profile_pic">
                @endif
            </p>
        </div>
    </div>
    <!-- End row -->

    <div class="divider"></div>

    <div class="row">
        <div class="col-md-12">
            <h4>Edit profile</h4>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>First name</label>
                <input class="form-control" name="firstname" value="{{ Auth::user()->firstname }}" type="text" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Last name</label>
                <input class="form-control" name="lastname" value="{{ Auth::user()->lastname }}" type="text" required>
            </div>
        </div>
    </div>
    <!-- End row -->

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Phone number</label>
                <input class="form-control" name="phone" value="{{ Auth::user()->phone }}" type="text">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Company name</label>
                <input class="form-control" name="company" value="{{ Auth::user()->company }}" type="text">
            </div>
        </div>
    </div>
    <!-- End row -->

    <hr>
    <div class="row">
        <div class="col-md-12">
            <h4>Edit address</h4>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Street address</label>
                <input class="form-control" name="address" value="{{ Auth::user()->address }}" type="text">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>City/Town</label>
                <input class="form-control" name="city" value="{{ Auth::user()->city }}" type="text">
            </div>
        </div>
    </div>
    <!-- End row -->

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Zip code</label> 
                <input class="form-control" name="zip_code" value="{{ Auth::user()->zip_code }}" type="text">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Country</label>
                <input class="form-control" name="country" value="{{ Auth::user()->country }}" type="text">
            </div>
        </div>
    </div>
    <!-- End row -->

    @if(Auth::user()->role != 3)
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h4>Edit Description</h4>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>About</label>
                    <textarea class="form-control" name="about" value="{{ Auth::user()->about }}" rows="5"></textarea>
                </div>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-12">
                <h4>Edit Facilities</h4>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <ul class="other-features">
                        <li>
                            <input type="checkbox" id="air_condition" name="facilities[]" value="Air Conditioning">
                            <label for="air_condition">Air Conditioning</label>
                        </li>
                        <li>
                            <input type="checkbox" id="bedding" name="facilities[]" value="Bedding">
                            <label for="bedding">Bedding</label>
                        </li>
                        <li>
                            <input type="checkbox" id="balcony" name="facilities[]" value="Balcony">
                            <label for="balcony">Balcony</label>
                        </li>
                        <li>
                            <input type="checkbox" id="cable_tv" name="facilities[]" value="Cable TV">
                            <label for="cable_tv">Cable TV</label>
                        </li>
                        <li>
                            <input type="checkbox" id="internet" name="facilities[]" value="Internet">
                            <label for="internet">Internet</label>
                        </li>
                        <li>
                            <input type="checkbox" id="parking" name="facilities[]" value="Parking">
                            <label for="parking">Parking</label>
                        </li>
                        <li>
                            <input type="checkbox" id="lift" name="facilities[]" value="Lift">
                            <label for="lift">Lift</label>
                        </li>
                        <li>
                            <input type="checkbox" id="pool" name="facilities[]" value="Pool">
                            <label for="pool">Pool</label>
                        </li>
                        <li>
                            <input type="checkbox" id="dishwasher" name="facilities[]" value="Dishwasher">
                            <label for="dishwasher">Dishwasher</label>
                        </li>
                        <li>
                            <input type="checkbox" id="toaster" name="facilities[]" value="Toaster">
                            <label for="toaster">Toaster</label>
                        </li>
                        <li>
                            <input type="checkbox" id="gym" name="facilities[]" value="Gym">
                            <label for="gym">Gym</label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endif

    @if(Auth::user()->role != 3)
        <h4>Payment Withdrawal</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Gcash</label>
                    <input class="form-control" type="text" name="gcash" value="{{ Auth::user()->gcash }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>PayPal</label>
                    <input class="form-control" type="text" name="paypal" value="{{ Auth::user()->paypal }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Bank</label>
                    <textarea class="form-control" name="bank" value="{{ Auth::user()->bank }}" rows="5"></textarea>
                </div>
            </div>
        </div>
    @endif

    <hr>
    <h4>Upload profile photo</h4>
    <div class="form-inline upload_1">
        <div class="form-group">
            <input type="file" name="photo" accept="image/*">
        </div>
    </div>

    @if(Auth::user()->role != 3)
        <h4>Upload Valid ID</h4>
        <div class="form-inline upload_1">
            <div class="form-group">
                <input type="file" name="valid_id" accept="image/*">
            </div>
        </div>
        <h4>Upload Business Permit</h4>
        <div class="form-inline upload_1">
            <div class="form-group">
                <input type="file" name="business_permit" accept="image/*">
            </div>
        </div>
    @endif

    <hr>
    <button type="submit" class="btn_1 green">Update Profile</button>
</form>