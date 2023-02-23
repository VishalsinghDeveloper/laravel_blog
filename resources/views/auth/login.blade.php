@extends('layouts.main')
@section('content')
<section class="h-100 bg-image">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h1 class="text-uppercase text-center mb-5">Login</h1>
              @if (Session::has('error'))
              <p class="text-danger">{{ Session::get('error') }}</p>
          @endif
          @if (Session::has('success'))
              <p class="text-success">{{ Session::get('success') }}</p>
          @endif
              <form method="post" action="">
                @csrf

                <div class="form-outline mb-4">
                    <input type="email"  name="email"class="form-control form-control-lg" />
                    <label class="form-label" >Your Email</label>
                    <span class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" name="password"class="form-control form-control-lg" />
                    <label class="form-label">Password</label>
                    <span class="text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                  </div>
                <p class="text-center text-muted mt-5 mb-0">Have Didn't an account? <a href="{{route('register') }}"
                    class="fw-bold text-body"><u>Register here</u></a></p>

                    <div class="text-center mt-5">
                        <input type="submit" class="btn btn-primary" value=" Login " />
                    </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
