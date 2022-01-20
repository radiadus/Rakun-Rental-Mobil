<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rakun Rental Mobil</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
        @guest
          <a class="navbar-brand text-white" href="/">Rakun Rental Mobil</a>
        @endguest
        @auth
        <a class="navbar-brand text-white" href="/landing">Rakun Rental Mobil</a>
        @endauth
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            {{-- Kiri --}}
            <ul class="navbar-nav" >
              <li class="nav-item">
                @guest
                    <a class="nav-link active text-white" aria-current="page" href="/">Home</a>
                @endguest
                @auth
                    <a class="nav-link active text-white" aria-current="page" href="/landing">Home</a>
                @endauth
              </li>
            </ul>
            {{-- Kanan --}}
            @guest
                <ul class="navbar-nav ms-auto text-center">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/register">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/login">Login</a>
                </li>
                </ul>
            @endguest

            @auth
                <div class="navbar-nav ms-auto text-center">
                    <ul class="navbar-nav ms-auto text-center">
                        <li class="nav-item d-flex align-items-center text-white">
                            <div class="dropdown">
                                <button class="btn btn-transparant text-white dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Welcome back, {{ auth()->user()->name }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="/edit">Edit Profile</a></li>
                                    <li>
                                        <form action="/logout" method="POST">
                                            @csrf
                                                <button type="submit" class="dropdown-item">
                                                        Logout
                                                </button>
                                        </form>
                                    </li>
                                    @if (Auth::user()->is_admin==0)
                                        <li><a class="dropdown-item" href="/history">Transaction History</a></li>
                                    @endif
                                    @if (Auth::user()->is_admin==1)
                                        <li><a class="dropdown-item" href="/userlist">User List</a></li>
                                        <li><a class="dropdown-item" href="/alltransactionlist">Transaction List</a></li>
                                    @endif
                                </ul>
                            </div>
                            @if (auth()->user()->local_avatar!=Null)
                                <img src="/storage/profile/{{auth()->user()->local_avatar}}" alt="" height="35" width="35" class="ms-2">
                            @elseif(auth()->user()->avatar!=Null)
                                <img src={{auth()->user()->avatar}} alt="" height="35" width="35" class="ms-2">
                            @else
                                <img src="{{ asset('beggingraccoon.png') }}" alt="" height="35" width="35" class="ms-2">
                            @endif

                        </li>
                        {{-- <li class="nav-item ms-2">
                            <form action="/edit" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-primary text-white">Edit Profile</button>
                            </form>
                        </li>
                        <li class="nav-item ms-2">
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary text-white">Logout</button>
                            </form>
                        </li> --}}
                    </ul>
                </div>
            @endauth
          </div>
        </div>
      </nav>
      @yield('content')
      {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> --}}
</body>
</html>
