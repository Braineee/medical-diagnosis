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
                      <span><a href="/treatments/create" class="btn btn-sm btn-outline-success">Create new treatment</a></span>
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

                  <h4>Search for treatment</h4>
                  <hr>

                  <div class="form-group row">
                      <label for="symptom" class="col-md-4 col-form-label text-md-right">{{ __('Select a disease') }}</label>

                      <div class="col-md-6">
                          <select id="disease_to_search" class="form-control{{ $errors->has('disease_to_search') ? ' is-invalid' : '' }}" name="disease_to_search" required>
                            <option value="">Select a disease to view its treatment</option>
                            @foreach($diseases as $disease_)
                            <option value="{{ $disease_->disease_id }}">{{ $disease_->disease_name }}</option>
                            @endforeach
                          </select>
                      </div>
                      <a href="" class="btn btn-primary btn-md" id="view-treatment">View treatment</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $('#disease_to_search').on('change', function(){
    let disease = $(this).val();
    $('#view-treatment').attr("href", `/treatments/${disease}`);
  });
</script>
@endsection
