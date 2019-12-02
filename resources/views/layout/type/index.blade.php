@extends('mainlayout')

@section('content')
    <div class="container-fluid">
        <h1 class="my-4 font-weight-light">
            Receipt Type
            <a href="{{ '/type/create' }}" class="float-right btn btn-info">Create</a>
        </h1>
        <div class="card-body">
            <div class="table-responsive">
                @if (count($types))
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Create Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($types as $type)
                            <tr>
                                {!! Form::open(["action" => "API\ReceiptTypesController@updateFromWeb", "method" => "POST"])!!}
                                {{Form::hidden('id', $type['id'], ['class' => 'form-conrol', 'placeholder' => 'Item Description', 'required'])}}
                                <th scope="row">{{ $type['id'] }}</th>
                                <td scope="row">{{Form::text('description', $type['description'], ['class' => 'form-conrol', 'placeholder' => 'Vendor Name', 'required'])}}</td>
                                <td scope="row">{{ $type['created_at'] }}</td>

                                <td scope="row">{{Form::submit('Update', ["class"=>"btn btn-info"])}}</td>
                                {!! Form::close() !!}
                                <td scope="row"><a href="{{ '/type/delete/'.$type['id'] }}" class="btn btn-danger">Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                @else
                    <h2 class="my-4 font-weight-bold">There is no receipt types</h2>
                @endif
            </div>
        </div>
    </div>
@endsection