@extends('mainlayout')

@section('content')
    <div class="container-fluid">
        <span><a class="btn btn-primary my-2 float-sm-right" href="/receipt">Back to receipt</a></span>
        <h4 class="card-header">
            Receipt ID: {{$receipt['id']}}
        </h4>
        {!! Form::open(["action" => "API\ReceiptsController@updateFromWeb", "method" => "POST"])!!}
        {{Form::hidden('receipt_id', $receipt['id'], ['class' => 'form-conrol', 'placeholder' => 'Item Description', 'required'])}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-borderless">
                    <thead class="thead-inverse">
                    <tr>
                        <th class="w-40">Description</th>
                        <th class="w-60">{{Form::text('description', $receipt['description'], ['class' => 'form-conrol', 'placeholder' => 'Vendor Name', 'required'])}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td scope="row">remarks</td>
                        <td>{{Form::text('remarks', $receipt['remarks'], ['class' => 'form-conrol', 'placeholder' => 'Vendor Name', 'required'])}}</td>
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
                        <td>
                            @if ($receipt['expense'])
                                {{ Form::radio('expense', '1' , true) }} Expense
                                {{ Form::radio('expense', '0' , false) }} Earn
                            @else
                                {{ Form::radio('expense', '1' , false) }} Expense
                                {{ Form::radio('expense', '0' , true) }} Earn
                            @endif
                        </td>


                    </tr>
                    <tr>
                        <td>Receipt Date</td>
                        <td>{{ $receipt['receipt_date'] }}</td>
                    </tr>
                    <tr>
                        <td>
                            {{Form::submit('Modify', ["class"=>"btn btn-info"])}}
                            {!! Form::close() !!}
                        </td>
                    </tr>

                    <tr>
                        <td>Receipt Item</td>
                        <td></td>
                    </tr>
                    @foreach ($receipt['receipt_item'] as $item)
                        <tr>
                            <td class="text-right">{{ $item['description'] }}</td>
                            <td class="text-center">{{ $item['data'] }}</td>
                            <td class="text-right">
                            <td scope="row"><a href="{{ '/receipt/delete/item/'.$receipt['id'].'/'.$item['id'] }}" class="btn btn-danger">Delete</a></td>
                            </td>
                        </tr>
                    @endforeach
                    {!! Form::open(["action" => "API\ReceiptItemsController@addItemToRequest", "method" => "POST"])!!}
                    {{Form::hidden('receipt_id', $receipt['id'], ['class' => 'form-conrol', 'placeholder' => 'Item Description', 'required'])}}
                    <tr>
                        <td class="text-right">
                            {{Form::text('description', '', ['class' => 'form-conrol', 'placeholder' => 'Item Description', 'required'])}}
                        </td>
                        <td class="text-center">
                            {{Form::number('price', '', ['class' => 'form-conrol', 'placeholder' => 'Price', 'required'])}}
                        </td>
                        <td class="text-right">
                        <td scope="row">
                            {{Form::submit('Add', ["class"=>"btn btn-info"])}}
                            {!! Form::close() !!}
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-weight-bold">Total {{ $receipt['expense'] ? "Expense" : "Earn" }}</td>
                        <td class="text-center font-weight-bold">{{ $total_value }}</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ '/receipt/delete/'.$receipt['id'] }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection