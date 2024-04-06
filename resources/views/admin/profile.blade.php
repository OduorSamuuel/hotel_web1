@include('admin.layout')
<<<<<<< HEAD
=======
	<div class="main-wrapper">
	
	
	
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header mt-5">
					<div class="row">
						<div class="col">
							<h3 class="page-title">Profile</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href='admin/home'>Dashboard</a></li>
								<li class="breadcrumb-item active">Profile</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="profile-header">
							<div class="row align-items-center">
								<div class="col-auto profile-image">
            <img class="rounded-circle" alt="User Image" src="{{ $profile->photo_path ?? 'assets/images/avatar.png' }}">
        </div>
								
							</div>
						</div>
						<div class="profile-menu">
							<ul class="nav nav-tabs nav-tabs-solid">
								<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a> </li>
								
							</ul>
						</div>
						<div class="tab-content profile-tab-cont">
							<div class="tab-pane fade show active" id="per_details_tab">
								<div class="row">
									<div class="col-lg-6">
										<div class="card">
											<div class="card-body">
												<h5 class="card-title d-flex justify-content-between">
													<span>Personal Details</span>
													<a class="edit-link" data-toggle="modal" href="#edit_personal_details"><i class="fa fa-edit mr-1"></i>Edit</a>
													</h5>
													
													@if (isset($profile))
												<div class="row mt-5">
													<p class="col-sm-3 text-sm-right mb-0 mb-sm-3">Name:</p>
													<p class="col-sm-9">{{ $profile->name }}</p>
												</div>
												<div class="row">
													<p class="col-sm-3 text-sm-right mb-0 mb-sm-3">Email: </p>
													<p class="col-sm-9">{{ $profile->email }}</p>
												</div>
											
												
												<div class="row">
													<p class="col-sm-3 text-sm-right mb-0 mb-sm-3">Tel No:</p>
													<p class="col-sm-9">{{ $profile->phone_no }}</p>
												</div>
												<div class="row">
													<p class="col-sm-3 text-sm-right mb-0">Country:</p>
													<p class="col-sm-9 ">{{ $profile->country }}</p>
												</div>
												
												@else
												<p class="text-danger">Admin profile not found.</p>
												<!-- For example: <a href="{{ route('create-profile') }}">Create Profile</a> -->
											@endif
											</div>
										</div>
										<div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
											<div class="modal-dialog modal-dialog-centered" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">Personal Details</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
													</div>
													<div class="modal-body">
														<form action="{{ route('update-profile') }}" method="post" enctype="multipart/form-data">
														@csrf
															<div class="row form-row">
																<div class="col-12">
																	<div class="form-group">
																		<label>Name</label>
																		<input type="text" class="form-control" name="name"value="{{ $profile->name ?? '' }}">
</div>
																</div>
																<div class="col-12">
																	<div class="form-group">
																		<label>Email</label>
																		<input type="email" class="form-control"name="email" value="{{ $profile->email ?? '' }}"> </div>
																</div>
															
										
																<div class="col-12">
																	<div class="form-group">
																		<label>Phone No</label>
																		<input type="text" class="form-control" name="phone_no" value="{{ $profile->phone_no ?? '' }}">
</div>
																
																<div class="col-12">
																	<h5 class="form-title"><span>Address</span></h5> </div>
												
																<div class="col-12">
																	<div class="form-group">
																		<label>Country</label>
																		<input type="text" class="form-control" name="country" value="{{ $profile->country ?? '' }}"> </div>
																</div>
																
															</div>
															<div class="form-group col-12">
																<button type="submit" class="btn btn-primary btn-block" name="update-profile">Save Changes</button>
															</div>
															</form>
													</div>
												</div>
											</div>
										</div>
									</div>
		
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/select2.min.js"></script>
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
	<script src="assets/js/script.js"></script>
	
</body>

>>>>>>> 6ca0b8eba86fc7cc6b5392781c34039d14d60461
@include('admin.endlayout')