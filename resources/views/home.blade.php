@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
              @if(Auth::user()->group_id == '2')
                <div class="card-header">Doctor's Dashboard</div>
              @else
                <div class="card-header">Patient's Dashboard</div>
              @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

              <!-- Check if the user is a doctor or a patient  -->
              @if(Auth::user()->group_id == '2')
                    <div class="row justify-content-center">
                      <section>
                        <div class="container py-3">
                          <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                               data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                            <a href="{{ route('user.patients') }}" class="text-blue">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 text-center v-align py-4">
                                  <img src="{{ asset('img/patient.svg') }}" alt="user_icon" width="50px" height="50px">
                                </div>
                                <div class="col-md-8 col-sm-8">
                                  <div class="card-block px-3 py-3">
                                    <p class="card-text">
                                      <b>Patients</b><br>
                                      Here you can view registered patients <br> and their records.
                                    </p>
                                  </div>
                                </div>
                            </div>
                            </a>
                          </div>
                        </div>
                      </section>

                      <section>
                        <div class="container py-3">
                          <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                               data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                            <a href="/diseases" class="text-blue">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 text-center v-align py-4">
                                  <img src="{{ asset('img/disease.svg') }}" alt="user_icon" width="50px" height="50px">
                                </div>
                                <div class="col-md-8 col-sm-8">
                                  <div class="card-block px-3 py-3">
                                    <p class="card-text">
                                      <b>Diseases</b><br>
                                      Here you can view, create and update <br> all disease in the system.
                                    </p>
                                  </div>
                                </div>
                            </div>
                            </a>
                          </div>
                        </div>
                      </section>
                    </div>


                    <div class="row justify-content-center">
                      <section>
                        <div class="container py-3">
                          <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                               data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                            <a href="/symptoms" class="text-blue">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 text-center v-align py-4">
                                  <img src="{{ asset('img/symptoms.svg') }}" alt="user_icon" width="50px" height="50px">
                                </div>
                                <div class="col-md-8 col-sm-8">
                                  <div class="card-block px-3 py-3">
                                    <p class="card-text">
                                      <b>Symptoms</b><br>
                                      Here you can view all possible symptoms <br> patients are likely experience.
                                    </p>
                                  </div>
                                </div>
                            </div>
                            </a>
                          </div>
                        </div>
                      </section>

                      <section>
                        <div class="container py-3">
                          <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                               data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                            <a href="/treatments" class="text-blue">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 text-center v-align py-4">
                                  <img src="{{ asset('img/first-aid-kit.svg') }}" alt="user_icon" width="50px" height="50px">
                                </div>
                                <div class="col-md-8 col-sm-8">
                                  <div class="card-block px-3 py-3">
                                    <p class="card-text">
                                      <b>Treatmeant</b><br>
                                      Here you can view and <br> specify a treatment for a disease.
                                    </p>
                                  </div>
                                </div>
                            </div>
                            </a>
                          </div>
                        </div>
                      </section>

                    </div>

                    <br>

              <!-- check if the user is a patient -->
              @elseif(Auth::user()->group_id == '1')

                    <div class="row justify-content-center">
                      <section>
                        <div class="container py-3">
                          <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                               data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                            <a href="?pg=biodata" class="text-blue">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 text-center v-align py-4">
                                  <img src="{{ asset('img/account-details.svg') }}" alt="user_icon" width="50px" height="50px">
                                </div>
                                <div class="col-md-8 col-sm-8">
                                  <div class="card-block px-3 py-3">
                                    <p class="card-text">
                                      <b>Account Details</b><br>
                                      Here you can view account details.
                                    </p>
                                  </div>
                                </div>
                            </div>
                            </a>
                          </div>
                        </div>
                      </section>

                      <section>
                        <div class="container py-3">
                          <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                               data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                            <a href="?pg=fees" class="text-blue">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 text-center v-align py-4">
                                  <img src="{{ asset('img/medical-history.svg') }}" alt="user_icon" width="50px" height="50px">
                                </div>
                                <div class="col-md-8 col-sm-8">
                                  <div class="card-block px-3 py-3">
                                    <p class="card-text">
                                      <b>My Histroy</b><br>
                                      Here you can diagnosis histroy.
                                    </p>
                                  </div>
                                </div>
                            </div>
                            </a>
                          </div>
                        </div>
                      </section>
                    </div>


                    <div class="row justify-content-center">
                      <section>
                        <div class="container py-3">
                          <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                               data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                            <a href="?pg=biodata" class="text-blue">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 text-center v-align py-4">
                                  <img src="{{ asset('img/diagnosis.svg') }}" alt="user_icon" width="50px" height="50px">
                                </div>
                                <div class="col-md-8 col-sm-8">
                                  <div class="card-block px-3 py-3">
                                    <p class="card-text">
                                      <b>Diagnose myself</b><br>
                                      Here you can diagnose yourself.
                                    </p>
                                  </div>
                                </div>
                            </div>
                            </a>
                          </div>
                        </div>
                      </section>

                      <section>
                        <div class="container py-3">
                          <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                               data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                            <a href="?pg=fees" class="text-blue">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 text-center v-align py-4">
                                  <img src="{{ asset('img/doctor.svg') }}" alt="user_icon" width="50px" height="50px">
                                </div>
                                <div class="col-md-8 col-sm-8">
                                  <div class="card-block px-3 py-3">
                                    <p class="card-text">
                                      <b>Doctor</b><br>
                                      Here you can contact a doctor
                                    </p>
                                  </div>
                                </div>
                            </div>
                            </a>
                          </div>
                        </div>
                      </section>
                    </div>
              @endif
              <!-- end check -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
