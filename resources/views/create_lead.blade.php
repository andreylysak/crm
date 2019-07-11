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
            <li aria-current="page">Create lead</li>
        </ol>
    </nav>
    <h2>Create lead</h2>
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">
                            <p>Create lead</p>
                        </div>
                    </div>
                    <div class="card-body">
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
                            <form action="{{route('store_lead')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                </div>
                                <div class="form-group">
                                <!--
                                //Lead statuses ids
                                //первичный контакт - 28810621
                                //переговоры - 28810624
                                //принимают решение - 28810627
                                //согласование договора - 28810630
                                //успешно реализовано - 142
                                //закрыто и не реализовано - 143
                                -->
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="28810621">Первичный контакт</option>
                                        <option value="28810624">Переговоры</option>
                                        <option value="28810627">Принимают решение</option>
                                        <option value="28810630">Согласование договора</option>
                                        <option value="142">Успешно реализовано</option>
                                        <option value="143">Закрыто и не реализовано</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Budget</label>
                                    <input type="text" name="budget" class="form-control" placeholder="Budget">
                                </div>
                                <div class="form-group">
                                    <label>Contact</label>
                                    <select name="contact" class="form-control">
                                        @foreach($contacts as $item)
                                            <option value="{{$item->crm_id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
