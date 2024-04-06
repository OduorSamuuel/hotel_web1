<!-- resources/views/all-bookings.blade.php -->

@include('admin.layout')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Bookings made</h4>
                        <a href="{{ route('add.booking') }}" class="btn btn-primary float-right veiwbutton">Add Booking</a>




                        <div class="col">

                <form action="" method="GET">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by BookingID">
                        <button type="submit" class="btn btn-primary">Search</button>
                  
            </form>
        </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body booking_card">
                        <div class="table-responsive">
                            <table class="datatable table table-stripped table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>RoomID</th>
                                        <th>UserID</th>
                                        <th>Arrival Date</th>
                                        <th>Adult</th>
                                        <th>Children</th>
                                        <th>Depature Date</th>
                                        <th>Total Price</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    @foreach($bookings as $booking)

                                                                      
                                    <td>{{ $booking->BookingID }}</td>
                                            <td>{{ $booking->RoomID }}</td>
                                            <td>{{ $booking->UserID }}</td>
                                            <td>{{ $booking->CheckInDate }}</td>
                                            <td>{{ $booking->Adult}}</td>
                                            <td>{{ $booking->Children }}</td>
                                            <td>{{ $booking->CheckOutDate}}</td>
                                            <td>{{ $booking->TotalPrice }}</td>
                                        
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v ellipse_color"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="{{ route('edit.booking', $booking->BookingID) }}"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a> 
                                                
                                                <form action="{{ route('delete.booking', ['id' => $booking->BookingID]) }}" method="POST">

                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item" data-toggle="modal" data-target="#delete_asset">
                        <i class="fas fa-trash-alt m-r-5"></i> Delete
                    </button>
                </form>

                                            </div>
                                        </td>
                                    </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add the search form -->
   <!-- <div class="row">
        <div class="col-sm-12">
            <form action="" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search..." name="query">
                    <span class="input-group-btn">
                        <button class="btn btn-secondary" type="submit">Search</button>
                    </span>
                </div>
            </form>
        </div>
    </div> -->
</div>

@include('admin.endlayout')
