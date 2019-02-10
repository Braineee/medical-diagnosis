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
                      <span><a href="/symptoms/" class="btn btn-sm btn-outline-primary">Go back</a></span>
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

                  <h4>{{ $symptom->symptom_name }}</h4>
                  <hr>
                  <h6><b>Description:</b></h6>
                  <p>{{ $symptom->description }}</p>
                  <br>
                  <a href="/symptoms/{{ $symptom->symptom_id }}/edit" class="btn btn-md btn-success">Edit Symptom</a>
                  <button class="btn btn-md btn-danger" title="Click this button to delete this symptom" id="delete-Form-button">Delete Symptoms</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- delete proccedure -->
<form id="delete-Form" action='{{ route("symptoms.deleteSymptom",[$symptom->symptom_id]) }}' method="POST" style="display:none">
  @csrf
  @method('DELETE')
</form>
<!--end delet proccedure-->
<script type="text/javascript">
  $('#delete-Form-button').on('click', function(event){
    var _delete = confirm('Are you sure you want to delete this symptom?');
    if(_delete){
      alert('it got here');
      event.preventDefault();
      $(`#delete-Form`).submit();
    }
  });
</script>


@endsection
