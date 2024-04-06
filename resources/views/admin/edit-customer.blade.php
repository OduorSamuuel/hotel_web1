@include('admin.layout')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">EDIT USERS</h4>
                        <a href="{{ route('all-customer') }}" class="btn btn-primary float-right veiwbutton">View all users</a>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body booking_card">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary"
                                                onclick="editUser('{{ $user->id }}')">Edit</button>
                                            <button type="button" class="btn btn-danger"
                                                onclick="deleteUser('{{ $user->id }}')">Delete</button>
                                        </td>
                                    </tr>
                                    <tr style="display: none;" id="updateRow_{{ $user->id }}">
                                        <td colspan="3">
                                            <form method="post"
                                                action="{{ route('updateUser', ['id' => $user->id ]) }}"
                                                id="updateForm_{{ $user->id }}">
                                                @csrf
                                                @method('PATCH')
                                                <!-- Display user details for editing -->
                                                <div class="form-group">
                                                    <label for="email">Email:</label>
                                                    <input type="text" class="form-control" name="email"
                                                        id="editEmail_{{ $user->id }}" value="{{ $user->email }}"
                                                        required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="role">Role:</label>
                                                    <input type="text" class="form-control" name="role"
                                                        id="editRole_{{ $user->id }}" value="{{ $user->role }}"
                                                        required>
                                                </div>

                                                <button type="button" class="btn btn-danger"
                                                    onclick="deleteUser('{{ $user->id }}')">Delete</button>

                                                <!-- Save button inside the form for each user -->
                                                <button type="button" class="btn btn-primary"
                                                    onclick="saveUser('{{ $user->id }}')">Save</button>
                                            </form>
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

<script>
    function editUser(userId) {
        console.log('editUser function called');

        // Toggle the visibility of the edit form
        document.getElementById('updateRow_' + userId).style.display = 'table-row';
    }

    function saveUser(userId) {
        console.log('saveUser function called for user ID: ' + userId);

        // Trigger the form submission
        document.getElementById('updateForm_' + userId).submit();
    }

    function deleteUser(userId) {
        console.log('deleteUser function called');

        if (confirm('Are you sure you want to delete this user?')) {
            // If the user confirms the deletion, redirect to the delete route
            window.location.href = '/deleteUser/' + userId;
        }
    }
</script>

@include('admin.endlayout')
