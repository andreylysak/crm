@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Account Amo CRM</h2>
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">
                            <p>Account Amo CRM</p>
                        </div>
                        <div class="card-header-buttons">
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="mb-4">{{$account['accounts'][0]['name']}}</h3>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row" style="width: 200px;">ID</th>
                                    <td>{{$account['accounts'][0]['id']}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Name</th>
                                    <td>{{$account['accounts'][0]['name']}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Subdomain</th>
                                    <td>{{$account['accounts'][0]['subdomain']}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Language</th>
                                    <td>{{$account['accounts'][0]['language']}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Timezone</th>
                                    <td>{{$account['accounts'][0]['timezone']}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">User ID</th>
                                    <td>{{$account['user']['id']}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
