@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="text-center mb-4">You are logged in!</p>

                    <div class="card-deck">
                        <div class="card text-center" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Contacts</h5>
                                <h4 class="card-text mb-3">{{$count_contacts}} contacts</h4>
                                <a href="{{url('admin/contacts')}}" class="btn btn-primary">View contacts</a>
                            </div>
                        </div>
                        <div class="card text-center" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Leads</h5>
                                <h4 class="card-text mb-3">{{$count_leads}} leads</h4>
                                <a href="{{url('admin/leads')}}" class="btn btn-primary">View leads</a>
                            </div>
                        </div>
                        <div class="card text-center" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Users</h5>
                                <h4 class="card-text mb-3">{{$count_users}} users</h4>
                                <a href="{{url('admin/users')}}" class="btn btn-primary">View users</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
