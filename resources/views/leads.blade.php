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
            <li aria-current="page">Leads</li>
        </ol>
    </nav>
    <h2>Leads</h2>
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">
                            <p>Leads</p>
                        </div>
                        <div class="card-header-buttons">
                            <a href="{{url('/admin/leads/create')}}" class="btn btn-primary">Create new</a>
                            <form action="{{route('import_leads')}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-warning load-data-button">Import data from Amo CRM</button>
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
                        <table class="table table-bordered" id="leadsTable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">unid</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Budget</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leads as $item)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->crm_id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->status_name}}</td>
                                    <td>{{$item->budget}}</td>
                                    <td>{{$item->main_contact}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{url('/admin/leads/view/'.$item->id)}}" class="btn btn-primary">View</a>
                                            <a href="{{url('/admin/leads/edit/'.$item->id)}}" class="btn btn-success">Edit</a>
                                            <form action="{{route('delete_lead')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="crm_id" value="{{$item->crm_id}}">
                                                <button type="submit" class="btn btn-danger delete-item-btn">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
