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

                  <h4>Register new symptom</h4>
                  <hr>

                  <form method="POST" action="{{ route('symptoms.store') }}">

                      @csrf

                      <div class="form-group row">
                          <label for="symptom" class="col-md-4 col-form-label text-md-right">{{ __('Name of symptom') }}</label>

                          <div class="col-md-6">
                              <input id="symptom" type="text" class="form-control{{ $errors->has('symptom') ? ' is-invalid' : '' }}" name="symptom" value="{{ old('symptom') }}" required autofocus>

                              @if ($errors->has('symptom'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('symptom') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="symptom_description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                          <div class="col-md-6">
                              <textarea id="symptom_description" class="form-control{{ $errors->has('symptom_description') ? ' is-invalid' : '' }}" name="symptom_description" value="{{ old('symptom_description') }}"></textarea>

                              @if ($errors->has('symptom_description'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('symptom_description') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary btn-md">
                                  {{ __('Register this symptom') }}
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
