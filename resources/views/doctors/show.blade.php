@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
              @if(Auth::user()->group_id == '2')
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-6">
                      Doctor's Dashboard
                    </div>
                    <div class="col-md-6 text-right">
                      <span class="pull-right"><a href="/home" class="btn btn-sm btn-outline-primary">Go Back</a></span>
                    </div>
                  </div>
                </div>
              @else
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-6">
                      Patient's Dashboard
                    </div>
                    <div class="col-md-6 text-right">
                      <span class="pull-right"><a href="/doctors" class="btn btn-sm btn-outline-primary">Go Back</a></span>
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

                  <h4>{{ $doctor->name }}</h4>
                  <hr>
                  <h6><b>Details:</b></h6>
                  <ol>
                      <li> Username: {{ $doctor->username }}</li>
                      <li> Sex: {{ $doctor->sex }}</li>
                      <li> Email: {{ $doctor->email }}</li>
                      <li> Phone: {{ $doctor->phone }}</li>
                  </ol>
                  <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
