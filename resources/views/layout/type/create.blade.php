@extends('mainlayout')

@section('content')
    <div class="container-fluid">
        <h1 class="my-4 font-weight-light">
            Create Receipt Type
        </h1>
            <div class="card-body">
            <div class="table-responsive">
                {!! Form::open(["action" => "API\ReceiptTypesController@createType", "method" => "POST"]) !!}
                <table class="table">
                    <tbody>
                        <tr>
                            <td scope="row">Type Description</td>
                            <td scope="row">{{Form::text('description', '', ['class' => 'form-conrol', 'placeholder' => 'Type Description', 'required'])}}</td>
                            <td scope="row">{{Form::submit('Create', ['class' => 'btn btn-info'])}}</td>
                        </tr>
                    </tbody>
                </table>
                {!! Form::close() !!}
        </div>
        </div>
    </div>
@endsection