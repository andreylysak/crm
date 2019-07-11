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
    <h2>Edit contact</h2>
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">
                            <p>Edit contact ID: @if($item_exists){{$contact->id}}@endif</p>
                        </div>
                        <div class="card-header-buttons">
                            <form action="{{route('delete_contact')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="@if($item_exists){{$contact->id}}@endif">
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
                                <div class="create-form">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form action="{{route('update_contact')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$contact->id}}">
                                    <input type="hidden" name="crm_id" value="{{$contact->crm_id}}">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{$contact->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{$contact->email}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{$contact->phone}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Position</label>
                                        <input type="text" name="position" class="form-control" placeholder="Position" value="{{$contact->position}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control" placeholder="Address" value="{{$contact->address}}">
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Leads</label>
                                        <input type="text" name="" class="form-control" value="{{$contact->leads}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect2">Leads</label>
                                        <select multiple name="leads[]" class="form-control" id="exampleFormControlSelect2">
                                            @foreach($leads as $item)
                                                <option>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div> -->
                                    <div class="form-group">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Created at</th>
                                                    <td>{{$contact->created_at}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Updated at</th>
                                                    <td>{{$contact->updated_at}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
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
