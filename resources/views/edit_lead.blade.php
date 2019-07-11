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
                <a href="{{ url('/admin/leads') }}">Leads</a>
                <span class="breadcrumbs__separator" aria-hidden="true">
                    <svg class="breadcrumbs-icon" viewBox="0 0 16 16"><g stroke-width="1" stroke="currentColor"><polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></g></svg>
                </span>
            </li>
            <li aria-current="page">@if($item_exists){{$lead->id}}@endif</li>
        </ol>
    </nav>
    <h2>Edit lead</h2>
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">
                            <p>Edit lead ID: @if($item_exists){{$lead->id}}@endif</p>
                        </div>
                        <div class="card-header-buttons">
                            <form action="{{route('delete_lead')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="@if($item_exists){{$lead->id}}@endif">
                                <button type="submit" class="btn btn-danger load-data-button">Delete lead</button>
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
                                <h3 class="mb-4">{{$lead->name}}</h3>
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
                                <form action="{{route('update_lead')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$lead->id}}">
                                    <input type="hidden" name="crm_id" value="{{$lead->crm_id}}">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{$lead->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="28810621" @if($lead->status == '28810621') selected @endif>Первичный контакт</option>
                                            <option value="28810624" @if($lead->status == '28810624') selected @endif>Переговоры</option>
                                            <option value="28810627" @if($lead->status == '28810627') selected @endif>Принимают решение</option>
                                            <option value="28810630" @if($lead->status == '28810630') selected @endif>Согласование договора</option>
                                            <option value="142" @if($lead->status == '142') selected @endif>Успешно реализовано</option>
                                            <option value="143" @if($lead->status == '143') selected @endif>Закрыто и не реализовано</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Budget</label>
                                        <input type="text" name="budget" class="form-control" placeholder="Budget" value="{{$lead->budget}}">
                                    </div>
                                    <div class="form-group">
                                        <table class="table table-bordered">
                                            <tbody>
                                                @if(!empty($main_contact))
                                                <tr>
                                                    <th scope="row">Main contact</th>
                                                    <td>
                                                        <a href="{{url('/admin/contacts/view/'.$main_contact->id)}}">{{$main_contact->name}}</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Contacts</th>
                                                    <td>
                                                        @foreach($contacts as $item)
                                                            <p><a href="{{url('/admin/contacts/view/'.$item->id)}}">{{$item->name}}</a></p>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <th scope="row">Created at</th>
                                                    <td>{{$lead->created_at}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Updated at</th>
                                                    <td>{{$lead->updated_at}}</td>
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
