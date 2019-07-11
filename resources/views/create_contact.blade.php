@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create contact</h2>
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">
                            <p>Create contact</p>
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
                            <form action="{{route('store_contact')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone">
                                </div>
                                <div class="form-group">
                                    <label>Position</label>
                                    <input type="text" name="position" class="form-control" placeholder="Position">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Leads</label>
                                    <select multiple name="leads[]" class="form-control" id="exampleFormControlSelect2">
                                        @foreach($leads as $item)
                                            <option>{{$item->name}}</option>
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
