@extends('admin.layouts.main')
@section('content')
    <div class="container">
        <div class="table-wrapper" style="margin-top:10%; margin-left:12%">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage <b>Post</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('category') }}" class="btn btn-primary"><span>Add New category</span></a>
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
                        <th>name</th>
                        <th>Description</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $cat )
                    <tr>


                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                <label for="checkbox1"></label>
                            </span>
                        </td>
                        <td>{{ $cat->id }}</td>
                        <td>{{ $cat->name }}</td>
                        <td>{{ $cat->description }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
