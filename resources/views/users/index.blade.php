
@extends('layouts.master')

@section('content_header')
    <h3>Users</h3>
@endsection


@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Operation</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <a href="{{route('users.edit' , $user['id'])}}">Edit</a>
                                    <form action="{{route('users.delete' , $user['id'])}}" style="display: inline-block;margin-left: 4px" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger border-0"> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>

                    </table>
                    {{$users->links()}}
                </div>

            </div>

        </div>



    </div>

@stop
