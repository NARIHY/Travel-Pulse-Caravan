@extends('admin')

@section('title', 'Dashboard')

@section('content')

<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Home</li>
      </ol>
    </nav>
  </div>

  <!-- -->
  <section class="section dashboard">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="card" style="padding: 20px">
                    <h6 style="color: blue">Total number of visits:</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-center align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-center align-items-center">
                                <h1>{{$visits}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="padding: 20px">
                    <h6 style="color: blue">Total number of fleet:</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-center align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" fill="currentColor" class="bi bi-pie-chart" viewBox="0 0 16 16">
                                    <path d="M7.5 1.018a7 7 0 0 0-4.79 11.566L7.5 7.793V1.018zm1 0V7.5h6.482A7.001 7.001 0 0 0 8.5 1.018zM14.982 8.5H8.207l-4.79 4.79A7 7 0 0 0 14.982 8.5zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                                  </svg>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-center align-items-center">
                                <h1>{{$fleet}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="padding: 20px">
                    <h6 style="color: blue">Total number of cars:</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-center align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg"  width="50px" height="50px" fill="currentColor" class="bi bi-car-front-fill" viewBox="0 0 16 16" style="color: red">
                                    <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17 1.247 0 3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z"/>
                                </svg>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-center align-items-center">
                                <h1>{{$car}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="padding: 20px">
            <div class="row mb-3 text-center">
                <div class="col-md-4">
                    <h6>Numbers of visits for today:</h6>
                    <div >
                        <h2>{{$visitsToday}}</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <h6>Numbers of visits for this month:</h6>
                    <div >
                        <h2>{{$visitsThisMonth}}</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <h6>Numbers of visits for this year:</h6>
                    <div >
                        <h2>{{$visitsThisYear}}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="padding: 20px">
            <div class="row mb-3 text-center">
                <div class="col-md-6">
                    <h6>Total number of users</h6>
                    <div >
                        <h2>{{$totalUsers}}</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6>Total number of moderators and administrators</h6>
                    <div >
                        <h2>{{$totaleAdmin}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>

@endsection
