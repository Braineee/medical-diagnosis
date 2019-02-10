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
                    @foreach ($disease_symptom_level as $symptom)
                      <li>{{ $symptom->level_name }} level of {{ $symptom->symptom_name }}</li>
                    @endforeach
                  </ol>
                  <br>
                  <a href="/diseases/add-symptom/{{ $disease->disease_id }}" class="btn btn-md btn-primary">Add Symptoms</a>
                  <a href="/diseases/remove-symptom/{{ $disease->disease_id }}" class="btn btn-md btn-info">Remove Symptoms</a>
                  <a href="/diseases/{{ $disease->disease_id }}/edit" class="btn btn-md btn-success">Edit Disease</a>
                  <button class="btn btn-md btn-danger" title="Click this button to delete this disease" id="delete-Form-button">Delete Disease</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- delete proccedure -->
<form id="delete-Form" action='{{ route("diseases.deleteDisease",[$disease->disease_id]) }}' method="POST" style="display:none">
  @csrf
  @method('DELETE')
</form>
<!--end delet proccedure-->
<script type="text/javascript">
  $('#delete-Form-button').on('click', function(event){
    var _delete = confirm('Are you sure you want to delete this disease?');
    if(_delete){
      alert('it got here');
      event.preventDefault();
      $(`#delete-Form`).submit();
    }
  });
</script>


@endsection
