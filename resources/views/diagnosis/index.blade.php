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
                      <span class="pull-right"><a href="/home" class="btn btn-sm btn-outline-primary">Go Back</a></span>
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
                <h6><b>Info:</b></h6>
                <p>In order to diagnose yourself, select the level of any of the symptoms you feel that is listed below.</p>
                <hr>
                <!-- display the list of patients -->
                <table class="table">
                  <thead>
                    <th>#</th>
                    <th>Symptoms</th>
                    <th>Level at which you experience this symptom</th>
                    <th>Description</th>
                  </thead>
                  <tbody>
                    @foreach($symptoms as $symptom)
                    <tr>
                      <td><input type="checkbox" name="checkbox{{ $symptom->symptom_id }}" disabled></td>
                      <th>{{ $symptom->symptom_name }}&ensp;::</th>
                      <td>
                        <select class="form-control level" data-id="{{ $symptom->symptom_id }}">
                          <option value="">Select level of this symptom</option>
                          @foreach($levels as $level)
                          <option value="{{ $level->level_id }}">{{ $level->level_name }}</option>
                          @endforeach
                        </select>
                      </td>
                      <td>{{ $symptom->description }}</td>
                    </tr>
                    @endforeach
                    <tr>
                      <td><input type="checkbox" class="{{ $symptom->symptom_id }}"></td>
                      <th>Others&ensp;::</th>
                      <td>
                        I can not find the symptoms i am looking for.
                        <!--select class="form-control level" data-id="{{ $symptom->symptom_id }}">
                          <option value="">Select level of this symptom</option>
                          @foreach($levels as $level)
                          <option value="{{ $level->level_id }}">{{ $level->level_name }}</option>
                          @endforeach
                        </select-->
                      </td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
                <br>
                <hr>
                <p class="text-danger">NB: Before clicking the proceed button ensure that you have selected all symptoms you are currently feeling.</p>
                <a href="/diagnosis/preview_symptoms" class="btn btn-lg btn-primary btn-block"> Proceed with diagnosis </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
