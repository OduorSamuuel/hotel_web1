<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Rooms</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="style.js"></script>
</head>
<body>
<header class="header">

<a href="#" class="logo"> <i class="fas fa-hotel"></i> hotel </a>

<nav class="navbar">
   <a href="{{ route('home') }}">home</a>

</nav>

<div id="menu-btn" class="fas fa-bars"></div>

</header>
<section class="rooms">
        <div class="container">
        <h2>Available Rooms</h2>
     

@if (count($availableRooms) > 0)
    <div class="row">
        @foreach ($availableRooms as $room)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset($room->image_data) }}" class="card-img-top" alt="Room Image" style="width: 100%; height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $room->RoomType }}</h5>
                        <p class="card-text">Price: ${{ $room->PricePerNight }}/night</p>
                        

                        <a href="{{ route('room.details', ['roomId' => $room->RoomId]) }}" class="btn btn-primary">Reserve me</a>
                                        </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>No available rooms for the selected dates and criteria.</p>
@endif


            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>