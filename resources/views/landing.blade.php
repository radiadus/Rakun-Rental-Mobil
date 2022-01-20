@extends('layout.master')
@section('content')
    @if ($message = Session::get('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
            {{$message}}
        </div>
    </div>
    @endif
    <div class="ps-3 pt-2">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('Background_mobil.png') }}" alt="" height="50%" width="50%">
        </div>
    </div>
    <div>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @if (Auth::user()->is_admin==0)
                    @foreach ($cars as $c)
                        @if ($c->available==1)
                            <div class="col">
                                <div class="card">
                                    <img src="/storage/cars/{{$c->image}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>{{$c->car_name}}</b></h5>
                                        <p class="card-text">Harga sewa mulai dari Rp{{$c->price}} / hari</p>
                                        <a href="/sewa/{{$c->id}}">
                                            <button>
                                                Sewa sekarang
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    @foreach ($cars as $c)
                        <div class="col">
                            <div class="card">
                                <img src="/storage/cars/{{$c->image}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><b>{{$c->car_name}}</b></h5>
                                    <p class="card-text">Harga sewa mulai dari Rp{{$c->price}} / hari</p>
                                    @if ($c->available==0)
                                        <p class="card-text text-danger">Status: Tidak Tersedia</p>
                                        <a href="/available/{{$c->id}}">
                                            <button class="btn btn-success">
                                                Ubah Tersedia
                                            </button>
                                        </a>
                                    @else
                                        <p class="card-text text-success">Status: Tersedia</p>
                                        <a href="/notavailable/{{$c->id}}">
                                            <button class="btn btn-danger">
                                                Ubah Tidak Tersedia
                                            </button>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

              </div>
        </div>
    </div>
@endsection
