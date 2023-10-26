    @extends('layouts.app')
    @section('content')
        <div class="container-fluid h-100">

            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">{{ __('Profile') }}</div>

                        <div class="card-body p-4 mb-4">
                            <div class="d-flex justify-content-end flex-column text-end ">
                                <h4>Membership Level: {{ $user->membership->level }}</h4>
                                <h6>Current Points: {{ $user->membership_points }} /
                                    {{ $user->membership->required_points }}</h6>
                            </div>
                            <form action={{ route('edit-profile') }} method="POST">
                                @csrf
                                <div class="form-row my-3 row ">
                                    <div class="form-group col-md-6 ">
                                        <label for="inputEmail4">Name</label>
                                        <input type="text" class="form-control" id="inputEmail4" placeholder="Name"
                                            name="name" value={{ old('name', $user->name) }}>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputText4">Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            id="inpuText4" placeholder="Username" name='username'
                                            value={{ old('username', $user->username) }}>
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="inputEmail">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="inputEmail" placeholder="Email" name='email'
                                        value={{ old('email', $user->email) }}>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label for="inputPassword">Password</label>
                                    <input type="password" class="form-control" disabled id="inputPassword"
                                        placeholder="Password" name='password' value={{ $user->password }}>
                                </div>
                                <div class="form-group w-100">
                                    <div class="d-flex justify-content-center ">
                                        <button type="submit" class="btn btn-primary w-25 ">Save Profile</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success fixed-bottom ">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    @endsection
