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

                  <h4>{{ $disease->disease_name }}</h4>
                  <hr>
                  <h6><b>Treatment:</b></h6>
                  <ul>
                    @if( $treatments !== NULL)
                    @foreach($treatments as $treatment)
                    <li>
                      <p>{{ $treatment->treatment }}</p>
                      <a href="" class="delete-Form-button btn btn-sm btn-danger pull-right">Delete Treatment</a>
                      <!--delet proccedure-->
                      <form class="delete-Form" method="POST" style="display:none">
                        @csrf
                        @method('DELETE')
                      </form>
                      <!--end delet proccedure-->
                      <script type="text/javascript">
                        $('.delete-Form-button').on('click', function(event){
                          var _delete = confirm('Are you sure you want to delete this treatment?');
                          if(_delete){
                            //alert('it got here');
                            event.preventDefault();
                            $(`.delete-Form`).attr('action', '{{ route("treatments.deleteTreatment", [$treatment->treatment_id]) }}');
                            $(`.delete-Form`).submit();
                          }
                        });
                      </script>
                      <hr>
                    </li>
                    @endforeach
                    @endif
                  </ul>
                  <br>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
