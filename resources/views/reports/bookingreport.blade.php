
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">

                    </div>
                </div>
            </div>
        </div>

        <header style="background-color: #8b5cf6; padding: 20px; color: #fff; text-align: center; height: 120px;">

            <h1 style="font-size: 2em; margin: 0;">Blimley Hotel - Booking Report</h1>

        </header>

        <!-- User Report Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead style="background-color: #8b5cf6; color: #fff;">
                <tr>
                    <th>Booking ID</th>
                    <th>Room ID</th>
                    <th>User ID</th>
                    <th>Check-In Date</th>
                    <th>Adult</th>
                    <th>Children</th>
                    <th>Check-Out Date</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->BookingID }}</td>
                        <td>{{ $user->RoomID }}</td>
                        <td>{{ $user->UserID }}</td>
                        <td>{{ $user->CheckInDate }}</td>
                        <td>{{ $user->Adult }}</td>
                        <td>{{ $user->Children }}</td>
                        <td>{{ $user->CheckOutDate }}</td>
                        <td>{{ $user->TotalPrice }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

