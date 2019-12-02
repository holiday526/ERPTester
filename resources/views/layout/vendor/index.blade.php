@extends('mainlayout')

@section('content')
    <div class="container-fluid">
        <h1 class="my-4 font-weight-light">
            Vendors
            <a href="{{ '/vendors/create' }}" class="float-right btn btn-info">Create</a>
        </h1>
            <div class="card-body">
            <div class="table-responsive">
            @if (count($vendors))
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Create Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendors as $vendor)
                            <tr>
                                {!! Form::open(["action" => "API\VendorsController@updateFromWeb", "method" => "POST"])!!}
                                {{Form::hidden('id', $vendor['id'], ['class' => 'form-conrol', 'placeholder' => 'Item Description', 'required'])}}
                                <th scope="row">{{ $vendor['id'] }}</th>
                                <td scope="row">{{Form::text('name', $vendor['name'], ['class' => 'form-conrol', 'placeholder' => 'Vendor Name', 'required'])}}</td>
                                <td scope="row">{{ $vendor['created_at'] }}</td>

                                <td scope="row">{{Form::submit('Update', ["class"=>"btn btn-info"])}}</td>
                                {!! Form::close() !!}
                                <td scope="row"><a href="{{ '/vendors/delete/'.$vendor['id'] }}" class="btn btn-danger">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            @else
                <h2 class="my-4 font-weight-bold">There is no vendor</h2>
            @endif
        </div>
        </div>
    </div>
@endsection