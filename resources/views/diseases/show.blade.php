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
                      <span><a href="/diseases/" class="btn btn-sm btn-outline-primary">Go back</a></span>
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

                  <h4>{{ $disease->disease_name }}</h4>
                  <hr>
                  <h6><b>Description:</b></h6>
                  <p>{{ $disease->description }}</p>
                  <br>
                  <h6><b>Symptoms:</b></h6>
                  <ol>
                    @foreach ($symptoms as $symptom)
                      <li>{{ $symptom->symptom_name }}</li>
                    @endforeach
                  </ol>
                  <br>
                  <a href="/diseases/addsymptom/{{ $disease->disease_id }}" class="btn btn-md btn-primary">Add Symptoms</a>
                  <a href="" class="btn btn-md btn-info">Remove Symptoms</a>
                  <a href="" class="btn btn-md btn-success">Edit Disease</a>
                  <a href="" class="btn btn-md btn-danger">Delete Disease</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $('#delete-Form').on('click', function(event){
    alert($(this).attr('data-id'));
    var delete_id = $(this).attr('data-id');
    var _delete = confirm('Are you sure you want to delete this disease?');
    if(_delete){
      event.preventDefault();
      $(`#delete-Form${delete_id}`).submit();
    }
  });
</script>
@endsection
