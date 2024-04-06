<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Blimey Hotel</title>
	<link rel="stylesheet" href="{{asset('assets/css_admin/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css_admin/feathericon.min.css')}}">
	<link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">
	<link rel="stylesheet" href="{{asset('assets/plugins/morris/morris.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css_admin/style.css') }}"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" /> 
</head>

<body>
	<div class="main-wrapper">
		<div class="header">
			<div class="header-left">
				<a href="{{ route('all-customer')}}" class="logo"> <i class="fas fa-hotel"></i>BLIMEY HOTEL</span> </a>
			</div>
		


			<a href="javascript:void(0);" id="toggle_btn"> <i class="fa-solid fa-bars"></i> </a>
			<ul class="nav user-menu">
			
			<li class="nav-item dropdown has-arrow">
    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
        <span class="user-img"><i class="fas fa-hotel"></i>BLIMEY HOTEL</span>
    </a>
    <div class="dropdown-menu">
        <div class="user-header">
            <div class="avatar avatar-sm"></div>
            <div class="user-text">
                <h6>Hello,</h6>
                <p class="text-muted mb-0">Administrator</p>
            </div>
        </div>
        <a class="dropdown-item" href="{{ route('admin-profile') }}">My Profile</a>
		<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
    </div>
</li>




			</ul>
			
		</div>
		<div class="sidebar" id="sidebar">
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul>
					<li class="active"> <a href=" "><i class=" fas fa-tachometer-alt"></i> DASHBOARD </a> 
							<li class="list-divider"></li>
						<li class="submenu"> <a href="#"><i class="fas fa-suitcase"></i> <span> Booking </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="{{ route('all-booking') }}"> All Booking </a></li>
								<li><a href="{{ route('edit-booking') }}"> Edit Booking </a></li>

							</ul>
						</li>
						<li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Users </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
	<li><a href="{{ route('all-customer') }}"> All Users </a></li>
								<!--<li><a href="{{ route('edit-booking') }}"> Edit Booking </a></li>-->
								<li><a href="{{ route('all-client')}}"> Clients </a></li>
								<li><a href="{{ route('all-staff')}}"> Staff </a></li>
							</ul>
						</li>
						<li class="submenu"> <a href="#"><i class="fas fa-key"></i> <span> Rooms </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="{{ route('all-rooms')}}">All Rooms </a></li>
								<li><a href="{{ route('rooms.editAll') }}"> Edit Rooms </a></li>

							<li><a href="{{ route('room.create')}}"> Add Rooms </a></li>
							</ul>
						</li>
						
						
					
						
				
						
						
						<li> <a href="{{ route('admin.calendar')}}"><i class="fas fa-calendar-alt"></i> <span>Calendar</span></a> </li>
					
					
						<li class="submenu"> <a href="#"><i class="fa-solid fa-file"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="{{ route('booking-reports')}}">Booking Reports </a></li>
								<li><a href="">All users reports </a></li>
							</ul>
						</li>
						<li class="list-divider"></li>
						
						<li class="list-divider"></li>
					
						</li>
					</ul>
				</div>
			</div>
		</div>