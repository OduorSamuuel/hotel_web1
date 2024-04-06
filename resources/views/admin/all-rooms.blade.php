@include('admin.layout')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">ALL ROOMS</h4>
                        <div class="col">
            <form action="" method="GET">
                @csrf
                <div class="input-group">
        <input type="text" name="search" class="form-control" id="search-input" placeholder="Search by Room ID, Room Type, or Status">
    
                       
                  
            </form>
        </div>
    </div>
</div>
                        </div>
                </div>
                
            </div>
        </div>
    @if($rooms && count($rooms) > 0)
        <div class="table-responsive">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body booking_card">
                        <div class="table-responsive">
                        <table class="datatable table table-stripped table table-hover table-center mb-0" id="rooms-table">
        <!-- Assuming this is your table structure -->
<table class="datatable table table-stripped table table-hover table-center mb-0" id="rooms-table">
    <thead>
        <tr>
            <th>Room ID</th>
            <th>Room Number</th>
            <th>Room Type</th>
            <th>Image</th>
            <th>Price Per Night</th>
            <th>Status</th>
            <th>No of Adults</th>
            <th>Meals</th>
            <th>Amenities</th>
        </tr>
    </thead>
    <tbody id="table-body">
        <!-- This is where your table rows will be dynamically added -->
        @if($rooms && count($rooms) > 0)
            @foreach($rooms as $room)
                <tr>
                    <td>{{ $room->RoomId }}</td>
                    <td>{{ $room->RoomNumber }}</td>
                    <td>{{ $room->RoomType }}</td>
                    <td>
                        @if($room->image_data)
                            <img src="{{ asset($room->image_data) }}" alt="Room Image" width="50">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $room->PricePerNight }}</td>
                    <td>{{ $room->Status }}</td>
                    <td>{{ $room->NoofAdults }}</td>
                    <td>{{ $room->Meals }}</td>
                    <td>{{ $room->Amenities }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">No rooms found</td>
            </tr>
        @endif
    </tbody>
</table>

        </div>
    @else
        <p>No rooms found</p>
    @endif
</div>
</div>
                </div>
            </div>
        </div>
        </div>
                </div>

 <script>
    function fetchAllRooms() {
        fetch("{{ route('all-rooms') }}")
            .then(response => response.json())
            .then(data => {
                let rooms = data.rooms;
                updateTable(rooms);
            })
            .catch(error => {
                console.error(error);
            });
    }

    function updateTable(rooms) {
    let tableBody = $('#table-body');
    tableBody.empty();

    if (rooms && rooms.length > 0) {
        rooms.forEach(room => {
            // Log the image_data value to the console
            console.log('Image Data:', room.image_data);

            let row = `
                <tr>
                    <td>${room.RoomId}</td>
                    <td>${room.RoomNumber}</td>
                    <td>${room.RoomType}</td>
                    <td>
                    ${room.image_data ? `<img src="{{ asset('${room.image_data}') }}" alt="Room Image" width="50">` : 'No Image'}
                    </td>
                    <td>${room.PricePerNight}</td>
                    <td>${room.Status}</td>
                    <td>${room.NoofAdults}</td>
                    <td>${room.Meals}</td>
                    <td>${room.Amenities}</td>
                </tr>`;
            tableBody.append(row);
        });
    } else {
        let noResultsRow = '<tr><td colspan="9">No matching rooms found.</td></tr>';
        tableBody.append(noResultsRow);
    }
}

    document.getElementById('search-input').addEventListener('input', function () {
        let search = this.value;

        if (!search) {
            fetchAllRooms();
            return;
        }

        fetch(`{{ route('search.rooms') }}?search=${search}`)
            .then(response => response.json())
            .then(data => {
                let rooms = data.rooms;
                updateTable(rooms);
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>

@include('admin.endlayout')
