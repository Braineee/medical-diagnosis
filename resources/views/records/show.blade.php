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
                      <span class="pull-right"><a href="/patients" class="btn btn-sm btn-outline-primary">Go Back</a></span>
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

                <h4>Patient medical history ({{ $patient_records->first()->name }})</h4>
                <hr>
                <!-- display the list of patients -->
                <table class="table">
                  <thead>
                    <th>Date</th>
                    <th>Disease diagnosed</th>
                    <th>Symptoms</th>
                    <!--th>Date Registered</th-->
                    <th>Option</th>
                  </thead>
                  <tbody>
                    @foreach($patient_records as $record)
                    <tr>
                      <td>{{ $record->created_at }}</td>
                      <td>{{ $record->disease_name }}</td>
                      <td>{{ $record->symptoms }}</td>
                      <td>
                        <a href="/records/view_details/{{ $record->patient_record_id }}" class="btn btn-primary btn-sm">view details</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
