@include('admin.layout')
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12 mt-5">
							<h3 class="page-title mt-3">Welcome to Blimey Hotel Dashboard</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item active">Dashboard</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-3 col-sm-6 col-12">
						<div class="card board1 fill">
							<div class="card-body">
								<div class="dash-widget-header">
									<div>
										<h3 class="card_widget_header">${{ $totalBookings }}</h3>
										<h6 class="text-muted">Total Booking</h6> </div>
									<div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus">
									<path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
									<circle cx="8.5" cy="7" r="4"></circle>
									<line x1="20" y1="8" x2="20" y2="14"></line>
									<line x1="23" y1="11" x2="17" y2="11"></line>
									</svg></span> </div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12">
						<div class="card board1 fill">
							<div class="card-body">
								<div class="dash-widget-header">
									<div>
										<h3 class="card_widget_header">${{ $totalRooms }}</h3>
										<h6 class="text-muted">Available Rooms</h6> </div>
									<div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
									<line x1="12" y1="1" x2="12" y2="23"></line>
									<path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
									</svg></span> </div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-12 col-lg-6">
						<div class="card card-chart">
							<div class="card-header">
								<h4 class="card-title">Guests</h4> </div>
							<div class="card-body">
								<div id="line-chart"></div>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-lg-6">
						<div class="card card-chart">
							<div class="card-header">
								<h4 class="card-title">ROOMS BOOKED</h4> </div>
							<div class="card-body">
								<div id="donut-chart"></div>
							</div>
						</div>
					</div>
				</div>
				
	</div>
	<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
	<script src="{{asset('assets/js_admin/jquery-3.5.1.min.js')}}"></script>
	<script src="{{asset('assets/js_admin/popper.min.js')}}"></script>
	<script src="{{asset('assets/js_admin/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>
	<script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>
	<script src="{{asset('assets/js_admin/chart.morris.js')}}"></script>
	<script src="{{asset('assets/js_admin/script.js')}}"></script>

	


	<script>
    // Assuming 'roomData' is available in the Blade view
    var roomData = @json($roomData);

    if (roomData.length > 0) {
        // Assuming 'RoomType' and 'count' are the properties for the room type and count
        var formattedData = roomData.map(function(item) {
            return {
                label: item.RoomType,
                value: item.count
            };
        });

        Morris.Donut({
			element: 'donut-chart',
            data: formattedData,
            backgroundColor: '#fff', 
            labelColor: '#333', 
            colors: ['#3498db', '#e74c3c', '#2ecc71', '#f39c12'], 
            resize: true,
            redraw: true
        });
    }
</script>

<script>
    var dailyBookings = @json($dailyBookings);

    if (dailyBookings.length > 0) {
        var formattedData = [];
        for (var i = 0; i < dailyBookings.length; i++) {
            formattedData.push({
                date: dailyBookings[i].date,
                count: dailyBookings[i].count
            });
        }

		Morris.Line({
    element: 'line-chart',
    data: formattedData,
    xkey: 'date',
    ykeys: ['count'],
    labels: ['Bookings'],
    lineColors: ['#3498db'], 
    lineWidth: '3px',
    pointSize: 4,
    pointFillColors: ['#ffffff'],
    pointStrokeColors: ['#3498db'],
    hideHover: 'auto',
    gridTextColor: '#555',
    gridStrokeWidth: 0.3,
    gridLineColor: '#ddd',
    resize: true,
    redraw: true
});


    }
</script>
</body>

</html>