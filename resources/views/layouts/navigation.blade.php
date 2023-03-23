<div class="m-4">
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">
                {{-- <img src="/examples/images/logo.svg" height="28" alt="CoolBrand"> --}}
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                @if(Auth::guest())
                <div class="navbar-nav ms-auto">
                    <a href="{{route('login') }}" class="nav-item nav-link">Login</a>
                    <a href="{{route('register')}}" class="nav-item nav-link">Register</a>
                </div>
                @else
                <div class="navbar-nav">
                    <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
                    <a href="#" class="nav-item nav-link">About</a>
                    <a href="#" class="nav-item nav-link">Contect</a>
                </div>
                <div class="navbar-nav ms-auto">
                    <p class="nav-item nav-link">Hey,<b>{{ Auth::user()->name }}</b></p>
                    <a href="{{ route('logout') }}" class="nav-item nav-link">Logout</a>
                </div>
                @endif
            </div>
        </div>
    </nav>
</div>
