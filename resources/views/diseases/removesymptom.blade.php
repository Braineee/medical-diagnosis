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
                      <span><a href="/diseases/{{ $disease->disease_id }}" class="btn btn-sm btn-outline-primary">Go back</a></span>
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

                  <h4>Add symptom to {{ $disease->disease_name }}</h4>
                  <hr>

                  <form method="POST" action="{{ route('diseases.removeSymptom') }}">

                      @csrf

                      <div class="form-group row">
                          <label for="disease_name" class="col-md-4 col-form-label text-md-right">{{ __('Name of disease_name') }}</label>

                          <div class="col-md-6">
                              <input id="disease_name_name" type="text" class="form-control{{ $errors->has('disease_name') ? ' is-invalid' : '' }}" name="disease_name" value="{{ $disease->disease_name }}" required disabled>
                              <input type="hidden" name="disease" value="{{ $disease->disease_id }}">
                              @if ($errors->has('disease_name'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('disease_name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="symptom" class="col-md-4 col-form-label text-md-right">{{ __('Description of disease') }}</label>

                          <div class="col-md-6">
                              <select id="symptom" class="form-control{{ $errors->has('symptom') ? ' is-invalid' : '' }}" name="symptom" required>
                                <option value="">Select a symptom</option>
                                @foreach($disease_symptom_level as $symptom_)
                                <option value="{{ $symptom_->symptom_id }}">{{ $symptom_->symptom_name }}</option>
                                @endforeach
                              </select>
                              @if ($errors->has('symptom'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('symptom') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary btn-md">
                                  {{ __('Remove this symptom') }}
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
