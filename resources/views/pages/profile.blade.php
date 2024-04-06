<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #edit-profile {
            display: none;
        }
        .image1{
width: 260px;
        }
    </style>
</head>

<body>
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Profile
        </h4>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#view-profile">View Profile</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#edit-profile">Edit Profile</a>
                        <a class="list-group-item list-group-item-action" href="{{ route('home') }}">Back to Home Page</a>
                        <!-- Add other tabs as needed -->
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="view-profile">
                       <div class="card-body media align-items-center">
    <img src="{{ $profile->photo_path ?? 'assets/images/avatar.png' }}" alt class="image1">
    <div class="media-body ml-4">
        @if ($profile)
            <h5 class="font-weight-bold">{{ $profile->name }}</h5>
            <p class="mb-2">
                <strong>Email:</strong> {{ $profile->email }}
            </p>
            <p class="mb-2">
                <strong>Date of Birth:</strong> {{ $profile->dob }}
            </p>
            <p class="mb-2">
                <strong>Phone:</strong> {{ $profile->phone_no }}
            </p>
            <p class="mb-2">
                <strong>Country:</strong> {{ $profile->country }}
            </p>
            <p class="mb-2">
                <strong>Bio:</strong> {{ $profile->bio }}
            </p>
        @else
            <p class="text-danger">Profile not found. Please create your profile.</p>
            <!-- For example: <a href="{{ route('create-profile') }}">Create Profile</a> -->
        @endif
    </div>
</div>

                            <hr class="border-light m-0">
                            <!-- Remove the form since we are displaying the profile -->
                        </div>
                        <div class="tab-pane fade" id="edit-profile">
                            <!-- Add the form for editing the profile -->
                            <form action="{{ route('update-profile') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <form action="{{ route('update-profile') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label class="form-label">Name</label>
            <input type="text" class="form-control mb-1" name="name" placeholder="Full name" value="{{ $profile->name ?? '' }}">
        </div>
        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $profile->email ?? '' }}">
        </div>
        <div class="form-group">
            <label class="form-label">Date of birth</label>
            <input type="date" class="form-control" name="dob" value="{{ $profile->dob ?? '' }}">
        </div>
        <div class="form-group">
            <label class="form-label">Phone</label>
            <input type="tel" class="form-control" name="phone_no" placeholder="Phone number" value="{{ $profile->phone_no ?? '' }}">
        </div>
        <div class="form-group">
            <label class="form-label">Country</label>
            <select class="custom-select" name="country">
                <option selected>{{ $profile->country ?? '' }}</option>
                <option>Kenya</option>
                <option>Tanzania</option>
                <option>Uganda</option>
                <option>Rwanda</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Bio</label>
            <textarea class="form-control" name="bio" rows="5" placeholder="Bio here">{{ $profile->bio ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Profile Image</label>
            <input type="file" class="form-control-file" name="photo">
        </div>
    </div>
    <div class="text-right mt-3">
        <input type="submit" class="next-1 next" value="Save changes" name="update-profile">
        <a href="{{ route('home') }}" class="btn btn-default">Cancel</a>
    </div>
                            



    </form>

                              


                        </div>
                        <!-- Add other tab panes as needed -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Remove the submit button and cancel link as they are not needed for viewing profile -->
    </div>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function () {
        // Show the "Edit Profile" tab when clicked
        $('.list-group-item[href="#edit-profile"]').on('click', function () {
            $('#view-profile').hide();
            $('#edit-profile').show();
        });

        // Show the "View Profile" tab when clicked
        $('.list-group-item[href="#view-profile"]').on('click', function () {
            $('#edit-profile').hide();
            $('#view-profile').show();
        });

    
        $('#create-profile-link').on('click', function () {
            $('#view-profile').hide();
            $('#edit-profile').show();
        });
    });
</script>

</body>

</html>