@extends('layout.master')
@section('content')
<div class="container">
    <h5>Transaction History</h5>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Transaction Time</th>
                <th scope="col">Car Name</th>
                <th scope="col">User</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Price</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @if(count($transactions)==0)
                <tr>
                    <td colspan=8>
                        <p>
                            No data
                        </p>
                    </td>
                </tr>
            @else
                @foreach ($transactions as $t)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $t->created_at }}</td>
                    <td>{{ $t->car_name}}</td>
                    <td>{{ $t->name}}</td>
                    <td>{{ $t->start_reserve}}</td>
                    <td>{{ $t->end_reserve}}</td>
                    <td>{{ $t->price}}</td>


                    @php
                        $long_reserve = (int)( ( (strtotime($t->end_reserve) - strtotime($t->start_reserve)) / 86400+1)*$t->price);
                    @endphp
                    <td>{{ $long_reserve}}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
