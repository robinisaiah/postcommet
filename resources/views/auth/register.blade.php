@extends('layout');
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Register</h3>
                </div>
                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action = "{{ route('register.store')}}" method = 'POST'>
                        @csrf
                        <div class="mb-3">
                            <label for="text" class="form-label">Name</label>
                            <input type="text" class="form-control" id="text" name ="name" placeholder="Enter Name">
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label">Phone no.</label>
                            <input type="number" class="form-control" id="number" name ="phone_no" placeholder="Enter Phone No">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name ="email"placeholder="Enter email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name ="password" placeholder="Enter Password">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="password_confirmation" placeholder="Reenter the Password">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p><a href="/login">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
  @endsection
