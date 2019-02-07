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
              @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <h4>List Of Diseases</h4>
                <hr>
                <!-- display the list of patients -->
                <table class="table">
                  <thead>
                    <th>ID</th>
                    <th>Disease</th>
                    <th>Date Added</th>
                    <th>Option</th>
                  </thead>
                  <tbody>
                    @foreach($diseases as $disease)
                    <tr>
                      <td>{{ $disease->disease_id }}</td>
                      <td>{{ $disease->disease_name }}</td>
                      <td>{{ $disease->created_at }}</td>
                      <td>
                        <button type="button"
                                class="btn btn-primary btn-sm"
                                name="button"
                                id='view-history' title="click this button to view more detail">
                                view details
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
