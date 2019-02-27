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
                      <span class="pull-right"><a href="/records/{{ $patient_record_details->first()->id }}" class="btn btn-sm btn-outline-primary">Go Back</a></span>
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
                      <span class="pull-right"><a href="/records/{{ $patient_record_details->first()->id }}" class="btn btn-sm btn-outline-primary">Go Back</a></span>
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

                <h4>Diagnosis details</h4>
                <hr>
                <h6><b>Patient Infomation:</b></h6>
                <ul>
                  <li><b>Name:</b> {{ $patient_name }} </li>
                  <li><b>Sex:</b> {{ $patient_sex }} </li>
                  <li><b>Email:</b> {{ $patient_email }} </li>
                  <li><b>Phone:</b> {{ $patient_phone }} </li>
                </ul>
                <hr>
                <h6><b>Symptoms:</b></h6>
                <p>{{ $patient_record_details->first()->symptoms }}<p>
                <hr>
                <h6><b>Summary of diagnosis:</b></h6>
                <p>On <b>{{ $date_of_diagnosis }}</b> patient was diagnosed of <b class="text-danger">{{ $disease_diagnosed }}</b> based on the symptoms provide above.</p>
                <hr>
                <h6><b>Treatement prescribed:</b></h6>
                <p>{{ $patient_record_details->first()->treatment }}</b></p>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection
