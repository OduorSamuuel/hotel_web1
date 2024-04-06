@include('admin.layout')

    <div class="container">
        <h2>Add Booking</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('bookings.store') }}" method="post">
            @csrf
            <label for="room_id">Room ID:</label>
            <input type="number" name="room_id" required>

            <label for="user_id">User ID:</label>
            <input type="number" name="user_id" required>

            <label for="check_in_date">Check-In Date:</label>
            <input type="date" name="check_in_date" required>

            <label for="adult">Adults:</label>
            <input type="number" name="adult" required>

            <label for="children">Children:</label>
            <input type="number" name="children" required>

            <label for="check_out_date">Check-Out Date:</label>
            <input type="date" name="check_out_date" required>

            <label for="total_price">Total Price:</label>
            <input type="number" name="total_price" step="0.01" required>

            <button type="submit">Add Booking</button>
        </form>
    </div>




@include('admin.endlayout')
