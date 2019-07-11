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
                <a href="{{ url('/admin/contacts') }}">Contacts</a>
                <span class="breadcrumbs__separator" aria-hidden="true">
                    <svg class="breadcrumbs-icon" viewBox="0 0 16 16"><g stroke-width="1" stroke="currentColor"><polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></g></svg>
                </span>
            </li>
            <li aria-current="page">@if($item_exists){{$contact->id}}@endif</li>
        </ol>
    </nav>
    <h2>Contacts</h2>
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">
                            <p>View contact ID: @if($item_exists){{$contact->id}}@endif</p>
                        </div>
                        <div class="card-header-buttons">
                            @if($item_exists)
                            <a href="{{url('admin/contacts/edit/'.$contact->id)}}" class="btn btn-primary"">Edit</a>
                            @endif
                            <form action="{{route('delete_contact')}}" method="post">
                                @csrf
                                <input type="hidden" name="crm_id" value="@if($item_exists){{$contact->crm_id}}@endif">
                                <button type="submit" class="btn btn-danger load-data-button">Delete contact</button>
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
                                <h3 class="mb-4">{{$contact->name}}</h3>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width: 200px;">ID</th>
                                            <td>{{$contact->id}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">crm_id</th>
                                            <td>{{$contact->crm_id}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Name</th>
                                            <td>{{$contact->name}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>{{$contact->email}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Phone</th>
                                            <td>{{$contact->phone}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Address</th>
                                            <td>{{$contact->address}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Position</th>
                                            <td>{{$contact->position}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Contact leads</th>
                                            <td>
                                                @foreach($contact_leads as $item)
                                                    <p><a href="{{url('/admin/leads/view/'.$item['id'])}}">{{$item['name']}}</a></p>
                                                @endforeach
                                            </td>
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
