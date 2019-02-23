@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
              @if(Auth::user()->group_id == '1')
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-6">
                      Patient's Dashboard
                    </div>
                    <div class="col-md-6 text-right">
                      <span><a href="/home/" class="btn btn-sm btn-outline-primary">Go back</a></span>
                    </div>
                  </div>
                </div>
              @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  <h4>{{ $patient->name }}</h4>
                  <hr>
                  <h6><b>Details:</b></h6>
                  <ol>
                      <li> Username: {{ $patient->username }}</li>
                      <li> Sex: {{ $patient->sex }}</li>
                      <li> Email: {{ $patient->email }}</li>
                      <li> Phone: {{ $patient->phone }}</li>
                  </ol>
                  <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
