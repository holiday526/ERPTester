@extends('mainlayout')

@section('content')
    <div class="container-fluid">
        <h1 class="my-4 font-weight-light">
            Create Vendor
        </h1>
        <div class="card-body">
            <div class="table-responsive">
                {!! Form::open(["action" => "API\ReceiptsController@createReceipt", "method" => "POST"]) !!}
                <table class="table">
                    <tbody>
                    <tr>
                        <td scope="row">Description</td>
                        <td scope="row">{{Form::text('description', '', ['class' => 'form-conrol', 'placeholder' => 'Description', 'required'])}}</td>
                    </tr>
                    <tr>
                        <td scope="row">Remarks</td>
                        <td scope="row">{{Form::text('remarks', '', ['class' => 'form-conrol', 'placeholder' => 'Remarks', 'required'])}}</td>
                    </tr>
                    <tr>
                        <td scope="row">Receipt Type</td>
                        <td scope="row">{{Form::select('receipt_type_id', $types, ['class' => 'form-conrol','required'])}}</td>
                    </tr>
                    <tr>
                        <td scope="row">Vendor</td>
                        <td scope="row">{{Form::select('vendor', $vendors, ['class' => 'form-conrol','required'])}}</td>
                    </tr>
                    <tr>
                        <td scope="row">Receipt Date</td>
                        <td scope="row">{{Form::date('receipt_date', '', ['class' => 'form-conrol', 'required'])}}</td>
                    </tr>


                    <td scope="row">{{Form::submit('Create', ['class' => 'btn btn-info'])}}</td>
                    </tbody>
                </table>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection