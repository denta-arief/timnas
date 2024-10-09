@extends('layouts.app')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="col-md-4">
            <!-- Profile Picture Section -->
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ $user->profile_picture ?? asset('images/default.jpg') }}" 
                         alt="Profile Picture" 
                         class="img-fluid img-circle profile_img mb-3" 
                         style="width: 150px; height: 150px;">
                    
                    <h3>{{ $user->name ?? 'Guest' }}</h3>
                    <p class="text-muted">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Profile Information Section -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Profile Details</h4>
                </div>
                <div class="card-body">
                    <!-- Update Profile Form -->
                    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="name" id="username" class="form-control" value="{{ $user->name }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email (read-only)</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="telegram_username">Telegram Username</label>
                            <input type="text" name="telegram_username" id="telegram_username" class="form-control" value="{{ $user->telegram_username }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="profile_picture">Change Profile Picture</label>
                            <input type="file" name="profile_picture" id="profile_picture" class="form-control-file">
                        </div>

                        <button type="submit" class="btn btn-success">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
