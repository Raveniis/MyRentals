<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Login</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="{{ asset('css/user/login.css')}}" />
</head>

<body>
  <style>
    .divider:after,
    .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
    }
    .h-custom {
      height: calc(100% - 73px);
    }
    @media (max-width: 450px) {
      .h-custom {
        height: 100%;
      }
    }
  </style>

  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid"
            alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form method="POST" action="{{ route('userLogin.post')}}">
            @csrf
            <div class="divider d-flex align-items-center my-4">
              <p class="text-center fw-bold mx-3 mb-0">Log Into Rentals</p>
            </div>

            <div class="form-outline mb-4">
              <input type="email" id="form3Example3" class="form-control form-control-lg" name='email' value="{{ old('email')}}"
                placeholder="Enter a valid email address" />
              <label class="form-label" for="form3Example3" >Email address</label>
            </div>

            <div class="form-outline mb-3">
              <input type="password" id="form3Example4" class="form-control form-control-lg" name="password"
                placeholder="Enter password" />
              <label class="form-label" for="form3Example4 ">Password</label>
            </div>  

            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{ route('userRegister')}}"
                  class="link-danger">Register</a></p>
            </div>
          </form>
    </div>
  </section>

  <!-- MDB -->
  <!-- <script type="text/javascript" src="js/mdb.min.js"></script> -->
  <!-- Custom scripts -->
  <!-- <script type="text/javascript"></script> -->
@if(session()->has("error"))
  <script>
      Swal.fire({
          icon: "error",
          title: "Unauthorized User",
          text: "Invalid email or password",
      })
  </script>
@endif

@if(session()->has("success"))
  <script>
      Swal.fire(
          "Success!",
          "Accouunt has been created.",
          "success"
      );
  </script>
@endif

@if(session()->has("unauthorized"))
  <script>
      Swal.fire(
          "Unauthorized!",
          "{{ session('unauthorized')}}",
          "error"
      );
  </script>
@endif

@if(session()->has("logout"))
  <script>
      Swal.fire({
      title: 'Logged Out',
      text: 'You have been logged out.',
      icon: 'success',
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000, // Display the toast for 3 seconds
      timerProgressBar: true, // Show a progress bar indicating the remaining time
      customClass: {
      popup: 'sweetalert-custom-popup',
      title: 'sweetalert-custom-title',
      },
      background: '#ffffff', // Custom background color for success (white)
      })
  </script>
@endif
</body>

</html>