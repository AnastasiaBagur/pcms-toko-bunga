@extends('layouts.app')

@section('content')
<h2>Data Transaksi</h2>

@foreach ($transactions as $trx)
    <h3>{{ $trx->customer_name }} - {{ $trx->payment_status }}</h3>
    <ul>
        @foreach ($trx->details as $detail)
            <li>
                {{ $detail->product->name }} - 
                Qty: {{ $detail->quantity }} - 
                Rp {{ $detail->price }}
            </li>
        @endforeach
    </ul>
@endforeach
@endsection
