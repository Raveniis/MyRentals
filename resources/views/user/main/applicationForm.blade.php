<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Tenant Application</title>
</head>

<body>

<section class="dashboard">

    <div class="container-fluid" style="margin-top: 63px;">
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold" style="font-size: 22px;"><span style="color: rgb(15, 17, 20);"><a href="{{route('houseRentals', ['id' => $houseRental->id])}}" style=" font-size: 30px; padding: 15px;"><i class='bx bx-left-arrow-alt'></i></a>Tenant Applicantion</span></p>
            </div>
            <div class="card-body">
                <!-- Start: Form -->
                <form method="POST" action="{{ route('applicationForm.post', ['id' => $houseRental->id])}}">
                    @csrf
                    <div class="row" style="margin-bottom: 25px;text-align: left;">
                        <div class="col-sm-4 col-md-4 col-lg-3 col-xl-2 col-xxl-2" style="display: inline;text-align: center;margin-bottom: 25px;">
                                <img id="previewImage" class="rounded-circle mb-3 mt-4 img-fluid" src="{{ asset(auth()->user()->profile_pic ? auth()->user()->profile_pic : 'images/default.png') }}" style="display: inline;max-height: 110px;width: 111.5px; height: 111.5px;">
                            </div>                        
                            <div class="col-sm-8 col-md-8 col-lg-9 col-xl-10 col-xxl-10 align-self-center">
                            <div class="row">
                                <div class="col-md-12 text-start">
                                    <div class="mb-3"><label class="form-label" for="email"><strong>Name</strong></label>
                                    <input class="form-control" value="{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}" readonly>
                                </div>
                                </div>
                                <div class="col-md-12 text-start">
                                    <div class="mb-3"><label class="form-label" for="username"><strong>Email</strong></label>
                                    <input class="form-control" type="text" value="{{ auth()->user()->email }}" readonly></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="first_name"><strong>Contact Number</strong></label>
                                <input class="form-control" type="text" value="{{ auth()->user()->contact_num }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="first_name"><strong>Emergency Contact</strong></label>
                                <input class="form-control" type="text" name= "emergency_num" value="{{ old('emergency_num') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="first_name"><strong>Employment Status</strong></label>
                                <select class="form-control" name='employment_status' value="{{ old('employment_status') }}" required>
                                    <option value="employed">Employed</option>
                                    <option value="unemployed">Unemployed</option>
                                </select>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="first_name"><strong>Monthly Income</strong></label>
                                <input class="form-control" type="number" name="monthly_income" value="{{ old('monthly_income') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="first_name"><strong>Move in date</strong></label>
                                <input class="form-control" type="date" name="move_in_date" value="{{ old('move_in_date') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="first_name"><strong>Lease term (in month)</strong></label>
                                <input class="form-control" type="number" name="lease_term" value="{{ old('lease_term') }} months" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="first_name"><strong>Number of Occupants</strong></label>
                                <input class="form-control" type="number" name="occupants_number" value="{{ old('occupants_number') }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            @if($errors->any())
                                <div class="warning-messages" style="color:red">
                                @foreach ($errors->all() as $error)
                                    <p>{{$error}}</p>
                                @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-md-12" style="text-align: right;margin-top: 5px; margin-bottom: 50px;">
                            <div style="position: absolute;display: flex;">
                                {{-- <a href="changePassword.php" class="btn btn-primary btn-sm" id="submitBtn"  style="margin-right: 12px;">Change Password?</a> --}}
                                <button id="save" class="btn btn-success btn-sm" id="submitBtn-1" type="submit" name="update">Apply</button></div>
                        </div >

                </form>
            </div>
            
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold" style="font-size: 22px;"><span style="color: rgb(15, 17, 20);">Rental Details</span></p>
            </div>
            <div class="card-body">
                <!-- Start: Form -->
                <form>
                    <div class="row" style="margin-bottom: 25px;text-align: left;">
                        <div class="col-sm-4 col-md-4 col-lg-3 col-xl-2 col-xxl-2" style="display: inline;text-align: center;margin-bottom: 25px;">
                                <img id="previewImage" class="rounded-circle mb-3 mt-4 img-fluid" src="{{ asset($houseRental->image) }}" style=" display: inline; max-height: 150px; width: 200px; height: 200px; border-radius: 0px !important;">
                            </div>                        
                            <div class="col-sm-8 col-md-8 col-lg-9 col-xl-10 col-xxl-10 align-self-center">
                            <div class="row">
                                <div class="col-md-12 text-start">
                                    <div class="mb-3"><label class="form-label" for="email"><strong>Rental Name</strong></label>
                                    <input class="form-control" value="{{ $houseRental->name}}" readonly>
                                </div>
                                </div>
                                <div class="col-md-12 text-start">
                                    <div class="mb-3"><label class="form-label" for="username"><strong>Address</strong></label>
                                    <input class="form-control" type="text" value="{{ $houseRental->address }}" readonly></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="first_name"><strong>Monthly Rent</strong></label>
                                <input class="form-control" type="text" value="{{ $houseRental->monthly_rent }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="first_name"><strong>Maximum Occupants</strong></label>
                                <input class="form-control" type="text" value="{{ $houseRental->maximum_occupants }}" readonly>
                            </div>
                        </div>
                </form>
            </div>  
        </div>
    </div>
</section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</html>
