<!-- admin.edit-rooms.blade.php -->

@extends('admin.layout')


    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Edit Rooms</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table" >
                        <div class="card-body booking_card">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="table-responsive" style="background-color:#593bdb;  " >
                                @foreach($rooms as $roomz)
                                    <div class="card mb-3">
                                  
                                        <div class="card-body">
                                        <form method="post" action="{{ route('rooms.update', ['RoomID' => $roomz->RoomId]) }}">
                                                @csrf
                                                @method('PUT')

                                                <div class="row formtype">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Room ID:</label>
                                                            <input type="text" class="form-control" id="RoomID" name="RoomID" value="{{ $roomz->RoomId }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Room Number:</label>
                                                            <input type="text" class="form-control" id="RoomNumber" name="RoomNumber" value="{{ $roomz->RoomNumber }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Room Type:</label>
                                                            <input type="text" class="form-control" id="RoomType" name="RoomType" value="{{ $roomz->RoomType }}">
                                                        </div>
                                                       </div>
                                                       <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Image Data:</label>
                                                            <input type="text" class="form-control" id="image_data" name="image_data" value="{{ $roomz->image_data }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Price Per Night:</label>
                                                            <input type="text" class="form-control" id="PricePerNight" name="PricePerNight" value="{{ $roomz->PricePerNight }}">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Status	:</label>
                                                            <input type="text" class="form-control" id="Status" name="Status" value="{{ $roomz->Status	 }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>NoofAdults		:</label>
                                                            <input type="text" class="form-control" id="NoofAdults" name="NoofAdults" value="{{ $roomz->NoofAdults		 }}">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Meals			:</label>
                                                            <input type="text" class="form-control" id="Meals" name="Meals" value="{{ $roomz->Meals			 }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Amenities:</label>
                                                            <input type="text" class="form-control" id="Amenities" name="Amenities" value="{{ $roomz->Amenities}}">
                                                        </div>
                                                      </div>
                                                    </div>
                                                    


                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                           <!-- <button type="submit" class="btn btn-primary">Update Room</button>-->
                                                            <div>
                                                            <input type="submit" value="Update" class="btn btn-primary">
                                                            </div>
                                                        </div>
                                                    </div>

</form>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            {{-- Delete Room Form --}}
                                                            <form action="{{ route('rooms.destroy', ['RoomID' => $roomz->RoomId]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this room?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Delete Room</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                      
                                    </div>
                                @endforeach

                            </div>
                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@include('admin.endlayout')
