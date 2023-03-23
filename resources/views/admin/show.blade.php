@extends('admin.layouts.main')
@section('content')
<div class="container">
    <div class="table-wrapper" style="margin-top:10%; margin-left:12%">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Manage <b>Post</b></h2>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        <span class="custom-checkbox">
                            <input type="checkbox" id="selectAll">
                            <label for="selectAll"></label>
                        </span>
                    </th>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>image</th>
                    <th>user</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($post as $post )
                <tr>
                    <td>
                        <span class="custom-checkbox">
                            <input type="checkbox" id="checkbox1" name="options[]" value="1">
                            <label for="checkbox1"></label>
                        </span>
                    </td>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description }}</td>
                    <td>@foreach($post->categories as $categories)
                        {{$categories->name}}
                        @endforeach
                    </td>
                    <td>
                        <img src="{{asset('uploads/post/'.$post->image) }}" alt="" width="70px" height="70px">
                    </td>
                    <td>{{$post->user->name}}</td>
                    <td>
                        <a name="" id="" class="btn btn-primary btn-sm" href="{{ asset('pedit/'.$post->id) }}"
                            role="button">Edit</a>
                        <a name="" id="" class="btn btn-danger btn-sm" href="{{ asset('pdelete/'.$post->id) }}"
                            role="button">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
