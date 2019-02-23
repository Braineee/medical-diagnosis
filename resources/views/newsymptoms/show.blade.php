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
                      <span><a href="/newsymptoms/" class="btn btn-sm btn-outline-primary">Go back</a></span>
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
                  <h4>Case ID: {{ $case_id }}</h4>
                  <hr>
                  <h6><b>Symptoms:</b></h6>
                  <ol>
                    @foreach ($symptoms as $symptom)
                      <li>{{ $symptom->level_name }} level of {{ $symptom->symptom_name }}</li>
                    @endforeach
                  </ol>
                  <br>
                  <h6><b>Select disease to add to this symptoms:</b></h6>
                  <form method="POST" action="{{ route('newSymptoms.registerDieseaseSymptom') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="disease" class="col-md-4 col-form-label text-md-right">{{ __('Select disease') }}</label>
                        <div class="col-md-6">
                            <select id="disease" class="form-control{{ $errors->has('disease') ? ' is-invalid' : '' }}" name="disease" required>
                              <option value="">Select a Disease</option>
                              @foreach($diseases as $disease)
                              <option value="{{ $disease->disease_id }}">{{ $disease->disease_name }}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('disease'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('disease') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" name="case_id" value="{{ $case_id }}">
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-md">
                                {{ __('Add this symptoms to this disease') }}
                            </button>
                        </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
