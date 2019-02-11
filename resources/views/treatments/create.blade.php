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
                      <span><a href="/treatments/" class="btn btn-sm btn-outline-primary">Go back</a></span>
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

                  <h4>Create treatment</h4>
                  <hr>

                  <form method="POST" action="{{ route('treatments.store') }}">

                      @csrf

                      <div class="form-group row">
                          <label for="disease_to_treat" class="col-md-4 col-form-label text-md-right">{{ __('Select a disease_to_treat') }}</label>

                          <div class="col-md-6">
                              <select id="disease_to_treat" class="form-control{{ $errors->has('disease_to_treat') ? ' is-invalid' : '' }}" name="disease_to_treat" required>
                                <option value="">Select a disease to create treatment</option>
                                @foreach($diseases as $disease_)
                                <option value="{{ $disease_->disease_id }}">{{ $disease_->disease_name }}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="treatment" class="col-md-4 col-form-label text-md-right">{{ __('Enter treatment details') }}</label>

                          <div class="col-md-6">
                              <textarea id="treatment" type="text" class="form-control{{ $errors->has('treatment') ? ' is-invalid' : '' }}" name="treatment" value="{{ old('treatment') }}" required></textarea>

                              @if ($errors->has('treatment'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('treatment') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary btn-md">
                                  {{ __('Create this treatment') }}
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
