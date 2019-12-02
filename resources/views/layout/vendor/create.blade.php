@extends('mainlayout')

@section('content')
    <div class="container-fluid">
        <h1 class="my-4 font-weight-light">
            Create Vendor
        </h1>
            <div class="card-body">
            <div class="table-responsive">
                {!! Form::open(["action" => "API\VendorsController@createUser", "method" => "POST"]) !!}
                <table class="table">
                    <tbody>
                        <tr>
                            <td scope="row">Vendor Name</td>
                            <td scope="row">{{Form::text('name', '', ['class' => 'form-conrol', 'placeholder' => 'Vendor Name', 'required'])}}</td>
                            <td scope="row">{{Form::submit('Create', ['class' => 'btn btn-info'])}}</td>
                        </tr>
                    </tbody>
                </table>
                {!! Form::close() !!}
        </div>
        </div>
    </div>
@endsection