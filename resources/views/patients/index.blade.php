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
                <div class="card-header">Patient's Dashboard</div>
              @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <h4>List Of Patients</h4>
                <hr>
                <!-- display the list of patients -->
                <table class="table">
                  <thead>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date Registered</th>
                    <th>Option</th>
                  </thead>
                  <tbody>
                    @foreach($patients as $patient)
                    <tr>
                      <td>{{ $patient->name }}</td>
                      <td>{{ $patient->email }}</td>
                      <td>{{ $patient->phone }}</td>
                      <td>{{ $patient->created_at }}</td>
                      <td>
                        <button type="button"
                                class="btn btn-primary btn-sm"
                                name="button"
                                id='view-history'>
                                view history
                        </button>
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
