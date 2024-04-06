@include('admin.layout')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Edit Booking</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body booking_card">
                        <div class="table-responsive">

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @foreach($bookings as $booking)
                                <form method="post" action="{{ route('update.booking', ['id' => $booking->BookingID ]) }}" id="updateForm_{{ $booking->BookingID }}">
                                    @csrf
                                    @method('PUT')
                                  
                                    <div class="row formtype">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Booking ID:</label>
                                                <input type="text" class="form-control" id="BookingID" name="BookingID" value="{{ $booking->BookingID }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Room ID:</label>
                                                <input type="text" class="form-control" id="RoomID" name="RoomID" value="{{ $booking->RoomID }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>User ID:</label>
                                                <input type="text" class="form-control" id="UserID" name="UserID" value="{{ $booking->UserID }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Check-In Date:</label>
                                                <input type="date" class="form-control" id="CheckInDate" name="CheckInDate" value="{{ $booking->CheckInDate }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Adult:</label>
                                                <input type="number" class="form-control" id="Adult" name="Adult" value="{{ $booking->Adult }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Children:</label>
                                                <input type="number" class="form-control" id="Children" name="Children" value="{{ $booking->Children }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Check-Out Date:</label>
                                                <input type="date" class="form-control" id="CheckOutDate" name="CheckOutDate" value="{{ $booking->CheckOutDate }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Total Price:</label>
                                                <input type="text" class="form-control" id="TotalPrice" name="TotalPrice" value="{{ $booking->TotalPrice }}">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Booking</button>
                                </form>

                                {{-- Delete Booking Form --}}
                                <form action="{{ route('delete.booking', ['id' => $booking->BookingID]) }}" method="post" class="mt-3" onsubmit="return confirm('Are you sure you want to delete this booking?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete Booking</button>
                                </form>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.endlayout')
