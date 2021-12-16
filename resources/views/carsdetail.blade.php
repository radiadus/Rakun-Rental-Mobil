@extends('layout.master')
@section('content')

<div class="container">
    <img src="/storage/cars/{{$cars->image}}" alt="..." height="300">
    <h5><b>{{$cars->car_name}}</b></h5>
    <p>Harga sewa mulai dari Rp{{$cars->price}} / hari</p>
    <p>Pilih Tanggal Sewa Mobil</p>
    <form action="/reservasi" method="POST">
    @csrf
        <input type="hidden" value={{auth()->user()->id}} name="user_id">
        <input type="hidden" value={{$cars->id}} name="car_id">
        <p>Tanggal Sewa</p>
        <input type="date" name="tgl_sewa" required>
        <p>Tanggal Pengembalian</p>
        <input type="date" name="tgl_kembali" required>
        <br>
        <br>
        <a href="">
            <button type="submit">
                SEWA
            </button>
        </a>
    </form>
</div>

@endsection
