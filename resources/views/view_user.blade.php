@extends('layouts.app')

@section('content')
<div class="container">
    <nav class="breadcrumbs" aria-label="Breadcrumbs">
        <ol class="breadcrumbs__list">
            <li>
                <a href="{{ url('/') }}">Home</a>
                <span class="breadcrumbs__separator" aria-hidden="true">
                    <svg class="breadcrumbs-icon" viewBox="0 0 16 16"><g stroke-width="1" stroke="currentColor"><polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></g></svg>
                </span>
            </li>
            <li>
                <a href="{{ url('/admin/users') }}">Users</a>
                <span class="breadcrumbs__separator" aria-hidden="true">
                    <svg class="breadcrumbs-icon" viewBox="0 0 16 16"><g stroke-width="1" stroke="currentColor"><polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></g></svg>
                </span>
            </li>
            <li aria-current="page">@if($item_exists){{$user->id}}@endif</li>
        </ol>
    </nav>
    <h2>View user</h2>
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">
                            <p>View user ID: @if($item_exists){{$user->id}}@endif</p>
                        </div>
                        <div class="card-header-buttons">
                            @if($item_exists)
                            <a href="{{url('admin/users/edit/'.$user->id)}}" class="btn btn-primary"">Edit</a>
                            @endif
                            <form action="{{route('delete_user')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="@if($item_exists){{$user->id}}@endif">
                                <button type="submit" class="btn btn-danger load-data-button">Delete user</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="item-information">
                            @if ($item_exists)
                                <h3 class="mb-4">{{$user->name}}</h3>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width: 200px;">ID</th>
                                            <td>{{$user->id}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Name</th>
                                            <td>{{$user->name}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>{{$user->email}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Role</th>
                                            <td>{{$user->roles[0]->name}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Created at</th>
                                            <td>{{$user->created_at}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Updated at</th>
                                            <td>{{$user->updated_at}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                no item found
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
