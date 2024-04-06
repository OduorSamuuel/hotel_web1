<!-- resources/views/add-room.blade.php -->

@include('admin.layout')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Add Room</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">

            @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form method="post" action="{{ route('room.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row formtype">
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Room Number</label>
                                <input class="form-control" type="text" name="RoomNumber">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Room Type</label>
                                <select class="form-control" name="RoomType">
                                    <option>Double</option>
                                    <option>Executive</option>
                                    <option>Suite</option>
                                   
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Image Data</label>
                                <input type="file" name="image_data" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Price Per Night</label>
                                <input type="text" class="form-control" name="PricePerNight">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="Status">
                                   <option>Booked</option>
                                   <option>Not Booked</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>No of Adults</label>
                                <input type="number" class="form-control" name="NoofAdults">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Meals</label>
                                <select class="form-control" name="Meals">
                                    <option>Select</option>
                                    <option>Free Breakfast</option>
                                    <option>Free Lunch</option>
                                    <option>Free Dinner</option>
                                    <option>Free Breakfast & Dinner</option>
                                    <option>Free Welcome Drink</option>
                                    <option>No Free Food</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Amenities Details</label>
                                <textarea class="form-control" rows="5" name="Amenities"></textarea>
                            </div>
                        </div>
                  <div>
                  <input type="submit" value="Add Room" class="btn btn-primary buttonedit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.endlayout')
