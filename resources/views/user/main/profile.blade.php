    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Buyer and Seller Profile Setting</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>
    <div class="container-fluid" style="margin-top: 63px;">
        <div class="card shadow mb-3">
            <div class="card-header py-3" style="display: flex"> 
                <a style="cursor: pointer; margin-right: 10px; font-size: 30px; color: black;" href="{{route('index')}}">
                    <i class='bx bx-arrow-back'></i>
                </a>
                <p class="text-primary m-0 fw-bold" style="font-size: 22px;"><span style="color: rgb(15, 17, 20);">User Settings</span></p>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('userProfile.post') }}"  enctype="multipart/form-data" >
                    @csrf
                    <div class="row" style="margin-bottom: 25px;text-align: left;">
                        <div class="col-sm-4 col-md-4 col-lg-3 col-xl-2 col-xxl-2" style="display: inline;text-align: center;margin-bottom: 25px;">
                                <img id="previewImage" class="rounded-circle mb-3 mt-4 img-fluid" src="{{ asset(auth()->user()->profile_pic ? auth()->user()->profile_pic : 'images/default.png') }}" style="display: inline;max-height: 110px;width: 111.5px; height: 111.5px;">
                                <br>
                                <input type="file" id="pictureUpload" name="image"  accept="image/x-png,image/gif,image/jpeg" class="btn btn-primary btn-sm" value="Change Photo" style="width: 113px; color: transparent;">
                            </div>                        
                            <div class="col-sm-8 col-md-8 col-lg-9 col-xl-10 col-xxl-10 align-self-center">
                            <div class="row">
                                <div class="col-md-12 text-start">
                                    <div class="mb-3"><label class="form-label" for="email"><strong>Email Address</strong></label>
                                    <input class="form-control" type="email" id="email" placeholder="user@example.com" name="email" value="{{ auth()->user()->email}}" readonly>
                                </div>
                                </div>
                                <div class="col-md-12 text-start">
                                    <div class="mb-3"><label class="form-label" for="username"><strong>Contact number</strong></label>
                                    <input class="form-control" type="text" placeholder="" pattern="[0-9]{11}" name="contact_num" value="{{ auth()->user()->contact_num}}" required></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="first_name"><strong>First Name</strong></label>
                                <input id="firstname" class="form-control" type="text" placeholder="Firstname" name="firstname" required="" value="{{ auth()->user()->firstname}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="last_name"><strong>Last Name</strong></label>
                                <input id="lastname" class="form-control" type="text" placeholder="Lastname" name="lastname" required="" value="{{ auth()->user()->lastname}}">
                                <p style="color:red;" id="lastnameWarning"><p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="birthdate"><strong>Birthdate</strong></label>
                                <input id="dateInput" class="form-control" type="date" placeholder="mm/dd/yyyy" autocomplete="on" value="{{ auth()->user()->birthdate}}" name="birthdate">
                                <p style="color:red;" id="dateWarning"><p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="Age"><strong>Age</strong></label> 
                                <div style="display: none">
                                    {{ $ageYear = date('Y') - date('Y', strtotime(auth()->user()->birthdate )) }}
                                    {{ $ageM = ( date('m') < date('m', strtotime(auth()->user()->birthdate ))) ?  -1 :  0;  }}
                                </div>
                                <input class="form-control" type="text" value="{{ $ageYear + $ageM}}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="address"><strong>Address</strong></label>
                                <input class="form-control" type="text" placeholder="Home Number, Street, City, Municipality" name="address" value="{{ auth()->user()->address}}">
                            </div>
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
                                                "Profile has been updated",
                                                "success"
                                            );
                                        </script>
                                    </div>
                                @endif
                            </div>

                        <div class="col-md-12" style="text-align: right;margin-top: 5px;">
                            <div style="position: absolute;display: flex;">
                                {{-- <a href="changePassword.php" class="btn btn-primary btn-sm" id="submitBtn"  style="margin-right: 12px;">Change Password?</a> --}}
                                <button id="save" class="btn btn-success btn-sm" id="submitBtn-1" type="submit" name="update">Save Settings</button></div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- <script src="js/userprofile.js"></script> --}}

<script>
    const previewImage = document.getElementById('previewImage');
  
  pictureUpload.addEventListener('change', function () {
    const file = this.files[0];
    const reader = new FileReader();
  
    reader.addEventListener('load', function () {
      previewImage.src = reader.result;
    });
  
    if (file) {
      reader.readAsDataURL(file);
    } else {
      previewImage.src = '';
    }
  })

</script>
</html>
