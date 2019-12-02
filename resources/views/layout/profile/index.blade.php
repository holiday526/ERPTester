@extends('mainlayout')

@section('content')
    <div class="container-fluid">
        <h1 class="my-4 font-weight-light">
            User Profile
        </h1>
        <?php
            $s_user = explode("{", (string)$user);
            $c_user = "{".$s_user[1]."{".$s_user[2];
            $c_user = explode(":", (string)$c_user);
            $id =  str_replace($c_user[1][0], "", str_replace(',"name"', "", $c_user[2]));
            $name = str_replace($c_user[3][0], "", str_replace('","email"', "", $c_user[3]));
            $email = str_replace($c_user[4][0], "", 
                str_replace('","email_verified_at"', "", $c_user[4]));
            $createAt = str_replace($c_user[6][0], "", 
                str_replace('":null,"created_at"', "", $c_user[6]));

        ?>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-borderless">
                    <tbody>
                        <tr>
                            <td scope="row">ID</td>
                            <td>{{ $id }}</td>
                        </tr>
                        <tr>
                            <td scope="row">Name</td>
                            <td>{{ $name }}</td>
                        </tr>
                        <tr>
                            <td scope="row">Email</td>
                            <td>{{ $email }}</td>
                        </tr>
                        <tr>
                            <td scope="row">Create Date</td>
                            <td>{{ $createAt }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection