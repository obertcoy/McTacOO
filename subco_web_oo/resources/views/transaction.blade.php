@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Transaction History</h1>
    @if($branches != null)

    <form id="branch-form" class="my-3" action="{{ route('transaction') }}" method="GET">
        <div class="form-group flex-row">
            <label for="branch_id">Branch</label>
            <select class="form-control" id="branch_id" name="branch_id" onchange="submitBranchForm()">
                @foreach ($branches as $branch)
                <option value="{{ $branch->id }}" @if ($branch->id == $selectedBranchID) selected @endif>{{ $branch->name }}</option>

                @endforeach
            </select>
        </div>
    </form>


    @endif
    @if (count($productTransactions) > 0)

    <table class="table table-striped">
        <thead>
            <tr >
                <th>Transaction ID</th>
                <th>Branch</th>
                <th>Payment Method</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productTransactions as $transaction)
            <tr onclick="window.location='{{ route('transaction-detail', $transaction->id) }}'">
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->branch->name }}</td>
                <td>{{ $transaction->payment->name }}</td>
                <td>{{ $transaction->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No transactions found.</p>
    @endif
</div>

<script>
     function submitBranchForm() {
            document.getElementById('branch-form').submit();
        }
</script>
@endsection
