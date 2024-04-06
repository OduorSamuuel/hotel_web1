@extends('admin.layout')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Blimley Hotel - User Report</h4>
                    </div>
                </div>
            </div>
        </div>

        <header style="background-color: #8b5cf6; padding: 20px; color: #fff; text-align: center; height: 120px;">
            <img src="{{ asset('images/Blimley Logo.png') }}" alt="Blimley Hotel Logo" style="width: 100px; height: auto; margin-bottom: 10px;">
            <h1 style="font-size: 2em; margin: 0;">Blimley Hotel - User Report</h1>
        </header>

        <!-- User Report Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead style="background-color: #8b5cf6; color: #fff;">
                <tr>
                    <th>User ID</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Phone Number</th>
                    <th>Country</th>
                    <th>Bio</th>
                    <th>Photo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usersWithProfiles as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->dob }}</td>
                        <td>{{ $user->phone_no }}</td>
                        <td>{{ $user->country }}</td>
                        <td>{{ $user->bio }}</td>
                        <td>
                            @if($user->photo_path)
                                <img src="{{ asset($user->photo_path) }}" alt="User Photo" style="width: 50px; height: auto;">
                            @else
                                No Photo
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@include('admin.endlayout')
