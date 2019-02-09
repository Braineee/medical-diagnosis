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
                      <span><a href="/diseases/create" class="btn btn-sm btn-outline-success">Register new disease</a></span>
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

                <h4>List Of Diseases</h4>
                <hr>
                <!-- display the list of diseases -->
                <table class="table">
                  <thead>
                    <th>ID</th>
                    <th>Disease</th>
                    <th>Description</th>
                    <th>Date Added</th>
                    <th>Option</th>
                  </thead>
                  <tbody>
                    @foreach($diseases as $disease)
                    <tr>
                      <td>{{ $disease->disease_id }}</td>
                      <td>{{ $disease->disease_name }}</td>
                      <td>{{ $disease->description }}</td>
                      <td>{{ $disease->created_at }}</td>
                      <td>
                        <a href="/diseases/{{ $disease->disease_id }}" class="btn btn-sm btn-primary" title="Click this button to view more detail">View detail</a>

                        <!--button class="btn btn-sm btn-danger" title="Click this button to delete this disease" id="delete-Form" data-id="{{ $disease->disease_id }}">Delete</button>
                        < delete proccedure -->
                        <!--form id="delete-Form{{ $disease->disease_id }}" action='{{ route("diseases.deleteDisease",[$disease->disease_id]) }}' method="POST" style="display:none">
                          @csrf
                          @method('DELETE')
                        </form-->
                        <!--end delet proccedure-->
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
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
