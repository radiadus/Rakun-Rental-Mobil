@extends('layout.master')
@section('content')
<div class="container">
    <form action="/edit" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        @if (auth()->user()->local_avatar!=Null)
            <img src="/storage/profile/{{auth()->user()->local_avatar}}" alt="" height="100" width="100">
        @elseif(auth()->user()->avatar!=Null)
            <img src={{auth()->user()->avatar}} alt="" height="100" width="100">
        @else
            <img src="{{ asset('beggingraccoon.png') }}" alt="" height="100" width="100">
        @endif
        <br>
        {{ auth()->user()->name }}
        <br>
        Ubah Foto Profil
        <input type="file" id="PhotoProfile" name="foto">
        <br>
        <div class="mb-3">
            <label for="NIK" class="form-label">NIK</label>
            <br>
            @if(auth()->user()->nik==NULL)
                <input type="text" class="form-control" id="NIK" name='nik'>
            @else
                <input type="text" class="form-control" id="NIK" name='nik' value={{auth()->user()->nik}}>
            @endif

        </div>
        <div class="mb-3">
            <label for="TanggalLahir" class="form-label">Tanggal Lahir</label>
            <br>
            @if(auth()->user()->tgl_lahir==NULL)
            <input type="date" class="form-control" id="TanggalLahir" name='tgl_lahir'>
            @else
            <input type="date" class="form-control" id="TanggalLahir" name='tgl_lahir' value={{auth()->user()->tgl_lahir}}>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

@endsection
