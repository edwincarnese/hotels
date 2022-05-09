<div class="row">
    <div class="col-6">
        <h4>List of Approval</h4>
    </div>
</div>
{{-- <hr> --}}
<div class="strip_booking">
    <div class="row">
        @foreach($users_approval as $user)
            <div class="col-lg-2 col-md-2">
                @if($user->photo)
                    <img src="{{ asset('storage/'.$user->photo) }}" class="img-fluid styled profile_pic mt-0">
                @else
                    <img src="{{ asset('assets/img/tourist_guide_pic.jpg') }}" class="img-fluid styled profile_pic mt-0">
                @endif
            </div>
            <div class="col-lg-6 col-md-5">
                <h3 class="tours_booking">{{ $user->firstname }} {{ $user->lastname }}</h3>
                <p class="mt-4">Email {{ $user->email }}</p>
            </div>
            <div class="col-lg-2 col-md-3">
                <ul class="info_booking">
                    <li><strong>Registered on</strong>
                        {{ $user->created_at }}
                    </li>
                    @if($user->phone)
                        <li><strong>Phone</strong>
                            {{ $user->phone }}
                        </li>
                    @endif
                    @if($user->valid_id)
                        <li><strong>Valid ID</strong>
                            <a class="btn_2" href="{{ asset('storage/'.$user->valid_id) }}" target="_blank">View Valid ID</a>
                        </li>
                    @endif
                    @if($user->business_permit)
                        <li><strong>Business Permit</strong>
                            <a class="btn_2" href="{{ asset('storage/'.$user->business_permit) }}" target="_blank">View Business Permit</a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col-lg-2 col-md-2">
                <div class="booking_buttons">
                    <form class="mb-1" action="{{ route('dashboard.user.approval.store', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn_2 btn-block">Approve</button>
                    </form>
                    <form action="{{ route('dashboard.user.approval.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn_3 btn-block">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <!-- End row -->
</div>
<!-- End strip booking -->