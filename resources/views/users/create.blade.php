@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create User</h1>
        <form action="{{ route('users.store') }}" method="post">
            @csrf  {{-- chèn token bảo mật CSRF vào biểu mẫu, giúp bảo vệ ứng dụng của bạn khỏi các tấn công --}}
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email</label>
              <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            ``
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Address</label>
                <textarea name="address" id="" cols="30" rows="5" class="form-control">{{ old('address') }}</textarea>
            </div>
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
