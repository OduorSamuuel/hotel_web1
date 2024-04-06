<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <link rel="stylesheet" href="{{ asset('assets/css/room.css') }}">
</head>
<body>
    <div class="container">
        <div>
            <!-- Assuming $room is the variable passed from the controller -->
            <img src="{{ asset($room->image_data) }}" alt="Room Image" class="room-image">
        </div>

        <div class="details">
            <h1>{{ $room->RoomType }} Room</h1>
            <p><strong>Price:</strong> ${{ $room->PricePerNight }} per night</p>
            <p><strong>Capacity:</strong> {{ $room->NoofAdults }} adults</p>

            <div class="amenities">
                <h2>Amenities</h2>
                <ul>

                    @php
                        $amenities = explode(',', $room->Amenities);
                    @endphp


                    @foreach ($amenities as $amenity)
                        <li>{{ $amenity }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Hidden form for posting data -->
            <form action="{{ route('check_availability') }}" method="post" id="hiddenForm" style="display: none;">
                @csrf
                <input type="hidden" name="check_in" value="{{ $checkInDate ?? '' }}">
                <input type="hidden" name="check_out" value="{{ $checkOutDate ?? '' }}">
                <input type="hidden" name="adults" value="{{ $adults ?? '' }}">
                <input type="hidden" name="child" value="{{ $child ?? '' }}">
                <input type="hidden" name="rooms" value="{{ $rooms ?? '' }}">
                <input type="submit" value="check availability" class="btn" name="check_availability">
            </form>
            <form  action="{{ route('payment' ) }}" method="post"  >
    @csrf

  <input type="hidden" name="roomId" id="mpesa-roomId" value="{{ $roomId }}">
    <input type="hidden" name="check_in" value="{{ $formData['check_in'] ?? '' }}">
    <input type="hidden" name="check_out" value="{{ $formData['check_out'] ?? '' }}">
    <input type="hidden" name="adults" value="{{ $formData['adults'] ?? '' }}">
    <input type="hidden" name="child" value="{{ $formData['child'] ?? '' }}">
    <input type="hidden" name="rooms" value="{{ $formData['rooms'] ?? '' }}">
    <input type="hidden" name="PricePerNight" value="{{ $PricePerNight }}">

    <input type="submit" value="Reserve Now" class="reservation-btn">

</form>

       
        </div>
    </div>
<!-- SweetAlert CDN links -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var reserveNowButton = document.getElementById('reserveNow');

        if (reserveNowButton) {
            reserveNowButton.addEventListener('click', function (event) {
                event.preventDefault();

                var checkInInput = document.querySelector('input[name="check_in"]');
                var checkOutInput = document.querySelector('input[name="check_out"]');

                if (checkInInput && checkOutInput && checkInInput.value && checkOutInput.value) {
                    // The form fields are present and not empty, submit the form
                    document.forms['hiddenForm'].submit();
                } else {

                    Swal.fire({
                        title: 'Enter Check-In and Check-Out Dates',
                        html: '<form id="popupForm">' +
                            '<label for="check_in">Check-In:</label>' +
                            '<input type="date" id="check_in" name="check_in" required>' +
                            '<label for="check_out">Check-Out:</label>' +
                            '<input type="date" id="check_out" name="check_out" required>' +
                            '</form>',
                        showCancelButton: true,
                        confirmButtonText: 'Submit',
                        cancelButtonText: 'Cancel',
                        showLoaderOnConfirm: true,
                        preConfirm: function () {
                            return new Promise(function (resolve) {
                                resolve({
                                    check_in: document.getElementById('check_in').value,
                                    check_out: document.getElementById('check_out').value
                                });
                            });
                        },
                        allowOutsideClick: false
                    }).then(function (result) {
                        if (result.isConfirmed) {

                            document.querySelector('input[name="check_in"]').value = result.value.check_in;
                            document.querySelector('input[name="check_out"]').value = result.value.check_out;

                            document.forms['hiddenForm'].submit();
                        }
                    });
                }
            });
        }
    });
</script>


</body>
</html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/swee
