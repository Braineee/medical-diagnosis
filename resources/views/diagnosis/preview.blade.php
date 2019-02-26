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
                      <span class="pull-right"><a href="/diagnosis" class="btn btn-sm btn-outline-primary">Go Back</a></span>
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

                <h4>Preview selected symptoms for diagnosis</h4>
                <hr>
                <h6><b>Infomation:</b></h6>
                <p>Please kindly preview all symptoms you have previously selected and ensure that they are acurate as this would help in diagnosing you.</p>
                <br>
                <h6><b>Symptoms:</b></h6>
                <p>From the previous selection you made it was deemed that:<p>
                <ol>
                  @foreach ($selected_symptoms as $symptom)
                    <li>You are experiencing a <b>{{ $symptom['level_name'] }}</b> level of <b>{{ $symptom['symptom_name'] }}</b></li>
                  @endforeach
                </ol>
                <p>Please click on the "Go Back" button above if you need to make any changes or click on the "Diagnose me now" button to continue with your diagnosis.</p>
                <hr>
                <br>
                <div class="diagnosis_result text-center">

                </div>
                <br>
                <button class="btn btn-md btn-danger btn-block btn-lg diagnose_me"><b>Diagnose me now</b></button>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection
