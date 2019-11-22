@extends('mainlayout')

@section('content')
    <div class="container-fluid">
        <span><a class="btn btn-primary my-2 float-sm-right" href="/receipt">Back to receipt</a></span>
        <h4 class="card-header">
            Receipt ID: {{$receipt['id']}}
        </h4>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-borderless">
                    <thead class="thead-inverse">
                        <tr>
                            <th class="w-40">Description</th>
                            <th class="w-60">{{$receipt['description']}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">remarks</td>
                            <td>{{ $receipt['remarks'] }}</td>
                        </tr>
                        <tr>
                            <td scope="row">Receipt Type</td>
                            <td>{{ \App\ReceiptType::find($receipt['receipt_type_id'])['description'] }}</td>
                        </tr>
                        <tr>
                            <td scope="row">User Create</td>
                            <td>{{ \App\User::find($receipt['user_id'])['name'] }}</td>
                        </tr>
                        <tr>
                            <td scope="row">Vendor</td>
                            <td>{{ \App\Vendor::find($receipt['vendor_id'])['name'] }}</td>
                        </tr>
                        <tr>
                            <td scope="row">Expense</td>
                            <td>{{ $receipt['expense'] ? "Expense" : "Earn" }}</td>
                        </tr>
                        <tr>
                            <td>Receipt Date</td>
                            <td>{{ $receipt['receipt_date'] }}</td>
                        </tr>
                        <tr>
                            <td>Receipt Item</td>
                            <td></td>
                        </tr>
                        @foreach ($receipt['receipt_item'] as $item)
                            <tr>
                                <td class="text-right">{{ $item['description'] }}</td>
                                <td class="text-center">{{ $item['data'] }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="text-right font-weight-bold">Total {{ $receipt['expense'] ? "Expense" : "Earn" }}</td>
                            <td class="text-center font-weight-bold">{{ $total_value }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection