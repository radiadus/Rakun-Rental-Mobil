@extends('layout.master')
@section('content')
<div class="container">
    <h5>User List</h5>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            @if (count($users)==0)
                <tr>
                    <td colspan=3>
                        <p>
                            No data
                        </p>
                    </td>
                </tr>
            @else
                @foreach ($users as $u)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
