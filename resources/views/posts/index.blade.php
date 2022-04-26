
@extends('layouts.master')

@section('content_header')
    <h3>Posts</h3>
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
                            <th>title</th>
                            <th>Content</th>
                            <th>Likes</th>
                            <th>Operation</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td>{{$post->content}}</td>
                                <td>{{count($post->likes)}}</td>

                                <td>
                                    <form action="{{route('posts.delete' , $post['id'])}}" style="display: inline-block;margin-left: 4px" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger border-0"> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>



                    </table>
                    {{$posts->links()}}
                </div>

            </div>

        </div>



    </div>

@stop
