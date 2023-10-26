@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Transaction ID: {{ $transaction_id }}</h1>


    <table class="table table-striped my-3">
        <thead>
            <tr >
                <th>ID</th>
                <th>Product / Packet Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $transactionProduct)
            <tr>
                <td>{{ $transactionProduct->product->id }}</td>
                <td>{{ $transactionProduct->product->name }}</td>
                <td>{{ $transactionProduct->quantity }}</td>
                <td>${{ $transactionProduct->quantity * $transactionProduct->product->price }}</td>
            </tr>
            @endforeach
        </tbody>
        <tbody>
            @foreach ($packets as $transactionPacket)
            <tr>
                <td>{{ $transactionPacket->packet->id }}</td>
                <td>{{ $transactionPacket->packet->name }}</td>
                <td>{{ $transactionPacket->quantity }}</td>
                <td>${{ $transactionPacket->quantity * $transactionPacket->packet->price }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>

<script>
     function submitBranchForm() {
            document.getElementById('branch-form').submit();
        }
</script>
@endsection
