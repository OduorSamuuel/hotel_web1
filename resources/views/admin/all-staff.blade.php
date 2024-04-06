<!-- resources/views/all-client.blade.php -->

@include('admin.layout')

<style>
    .container {
        margin: 0 auto; /* Center the container horizontally */
        max-width: 800px; /* Adjust the max-width as needed */
        margin-top: 100px;
    }

    /* Add additional styles as needed for centering vertically */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
</style>

<div class="container">
    <h1>All Staff</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staff as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('admin.endlayout')
