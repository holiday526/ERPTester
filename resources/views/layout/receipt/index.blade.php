@extends('mainlayout')

@section('content')
    <div class="container-fluid">
        <h1 class="my-4 font-weight-light">
            Receipts List
            <span class="my-2 float-sm-right"
                  style="font-size: 25px !important;">Receipt count: {{ count($receipts) }}</span>
        </h1>
        @if (count($receipts))
            <h4 class="my-4 font-weight-light">
                Expense
            </h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Receipt ID</th>
                        <th scope="col">Receipt Type</th>
                        <th scope="col">Receipt Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($receipts as $receipt)
                        @if ($receipt['expense'])
                        <tr>
                            <th scope="row">{{ $receipt['id'] }}</th>
                            <td scope="row">{{ $receipt_type_name[$receipt['receipt_type_id']] }}</td>
                            <td scope="row">{{ $receipt['receipt_date'] }}</td>
                            <td scope="row"><a href="{{ '/receipt/'.$receipt['id'] }}" class="btn btn-info">View</a></td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <h4 class="my-4 font-weight-light">
                Earn
            </h4>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Receipt ID</th>
                    <th scope="col">Receipt Type</th>
                    <th scope="col">Receipt Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($receipts as $receipt)
                    @if (!$receipt['expense'])
                    <tr>
                        <th scope="row">{{ $receipt['id'] }}</th>
                        <td scope="row">{{ $receipt_type_name[$receipt['receipt_type_id']] }}</td>
                        <td scope="row">{{ $receipt['receipt_date'] }}</td>
                        <td scope="row"><a href="{{ '/receipt/'.$receipt['id'] }}" class="btn btn-info">View</a></td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>

        @else
            <h2 class="my-4 font-weight-bold">There is no receipt</h2>
        @endif
    </div>
@endsection