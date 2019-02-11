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
                      <span><a href="/home" class="btn btn-sm btn-outline-primary">Go back</a></span>
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

                <h4>List Of new symptoms</h4>
                <br>
                <!-- display the list of symptoms -->
                <table class="table">
                  <thead>
                    <th>Case ID</th>
                    <th>Symptom</th>
                    <!--th>Date Added</th-->
                    <th>Option</th>
                  </thead>
                  <tbody>
                    @foreach($newSymptoms as $new_symptom)
                      <tr>
                      @foreach($new_symptom as $key1 => $value1)
                          <td>{{ $key1 }}</td>
                          <td>
                            @foreach($value1 as $value2)
                              @foreach($value2 as $key => $value)
                                {{ $value }}-{{ $key }},
                              @endforeach
                            @endforeach
                          </td>
                          <td>
                            <a href="/newsymptoms/{{ $key1 }}" class="btn btn-sm btn-primary" title="Click this button to view more detail">Add disease to this symptoms</a>
                          </td>
                        </tr>
                      @endforeach
                    @endforeach
                  </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
