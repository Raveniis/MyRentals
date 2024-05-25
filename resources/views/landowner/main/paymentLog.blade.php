<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="{{ asset('css/landowner/main.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Payment log</title>
</head>

<body style="background: white">


    <div class="container-fluid" style="margin-top: 63px;">
        <div class="card shadow mb-3">
            <div class="card-header py-3" style="display: flex"> 
                <a style="cursor: pointer; margin-right: 10px; font-size: 30px; color: black;" href="{{route('tenants')}}">
                    <i class='bx bx-arrow-back'></i>
                </a>
                <p class="text-primary m-0 fw-bold" style="font-size: 22px;"><span style="color: rgb(15, 17, 20);">Tenant info</span></p>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('paymentLog.post', ['id' => $tenant->id]) }}"  enctype="multipart/form-data" >
                    @csrf
                    <div class="row" style="margin-bottom: 25px;text-align: left;">                 
                            <div class="col-sm-8 col-md-8 col-lg-9 col-xl-10 col-xxl-10 align-self-center">
                            <div class="row">
                                <div class="col-md-6 text-start">
                                    <div class="mb-3"><label class="form-label" for="email"><strong>Name</strong></label>
                                    <input class="form-control" type="text" value="{{ auth()->user()->firstname}} {{ auth()->user()->lastname}}" readonly>
                                </div>
                                </div>
                                <div class="col-md-6 text-start">
                                    <div class="mb-3"><label class="form-label" for="username"><strong>Email</strong></label>
                                    <input class="form-control" type="text" value="{{ auth()->user()->email}}" readonly></div>
                                </div>
                                <div class="col-md-6 text-start">
                                    <div class="mb-3"><label class="form-label" for="username"><strong>Amount</strong></label>
                                    <input class="form-control" type="number" name="amount" required></div>
                                </div>
                                <div class="col-md-6 text-start">
                                    <div class="mb-3"><label class="form-label" for="username"><strong>Date</strong></label>
                                    <input class="form-control" type="date" name="date"  required></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                @if($errors->any())
                                    <div class="warning-messages" style="color:red">
                                    @foreach ($errors->all() as $error)
                                        <p>{{$error}}</p>
                                    @endforeach
                                    </div>
                                @endif

                                @if(session()->has("success"))
                                    <div class="warning-messages" style="color:green">
                                        <script>
                                            Swal.fire(
                                                "Success!",
                                                "Payment has been recorder",
                                                "success"
                                            );
                                        </script>
                                    </div>
                                @endif
                            </div>

                        <div class="col-md-12" style="text-align: right;margin-top: 5px;">
                            <div style="position: absolute;display: flex;">
                                {{-- <a href="changePassword.php" class="btn btn-primary btn-sm" id="submitBtn"  style="margin-right: 12px;">Change Password?</a> --}}
                                <button id="save" class="btn btn-success btn-sm" id="submitBtn-1" type="submit" name="update">Add payment log</button></div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid" style="margin-top: 63px;">
        <div class="card shadow mb-3">
            <div class="card-header py-3" style="display: flex"> 
                <p class="text-primary m-0 fw-bold" style="font-size: 22px;"><span style="color: rgb(15, 17, 20);">Payment Logs</span></p>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($paymentLogs as $paymentLog)
                            <tr>
                            <td>₱{{ $paymentLog->amount }}</td>
                            <td>{{ $paymentLog->date}}</td>
                            </tr> 
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('js/landowner/main.js') }}"></script>
{{-- <script src="js/userprofile.js"></script> --}}

</html>
