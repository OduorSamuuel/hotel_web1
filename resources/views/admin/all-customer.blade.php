@include('admin.layout')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">ALL USERS</h4>
                        <a href="{{ route('edit-customer') }}" class="btn btn-primary float-right veiwbutton">Edit Users</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body booking_card">
                        <div class="table-responsive">
                            <table class="datatable table table-stripped table table-hover table-center mb-0">
                                <!-- ... your existing table structure ... -->
        <thead>
            <tr>
            <th style="padding-right: 20px;">ID</th>

                <th style="padding-right: 20px;">Email</th>
                <th style="padding-right: 20px;">Is Verified</th>
                <th style="padding-right: 20px;">Role</th>
                <th style="padding-right: 20px;">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                <td>{{ $user->id }}</td>

                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_verified }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                       

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
    </div>
</div>
</div>
</div>



@include('admin.endlayout')
