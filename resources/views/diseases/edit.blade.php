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

                  <h4>Update {{ $disease->disease_name }}</h4>
                  <hr>

                  <form method="POST" action="{{ route('diseases.update', [$disease->disease_id] ) }}">
                    <input type="hidden" name="_method" value="PUT">

                      @csrf

                      <div class="form-group row">
                          <label for="disease" class="col-md-4 col-form-label text-md-right">{{ __('Name of disease') }}</label>

                          <div class="col-md-6">
                              <input id="disease" type="text" class="form-control{{ $errors->has('disease') ? ' is-invalid' : '' }}" name="disease" value="{{ $disease->disease_name }}" required autofocus>

                              @if ($errors->has('disease'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('disease') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="disease_description" class="col-md-4 col-form-label text-md-right">{{ __('Description of disease') }}</label>

                          <div class="col-md-6">
                              <textarea id="disease_description" type="text" class="form-control{{ $errors->has('disease_description') ? ' is-invalid' : '' }}" name="disease_description" value="{{ $disease->description }}" required>{{ $disease->description }}</textarea>

                              @if ($errors->has('disease_description'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('disease_description') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary btn-md">
                                  {{ __('Update this disease') }}
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
