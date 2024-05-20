<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Register</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="{{ asset('css/user/login.css')}}" />
</head>

<body>
  <!-- Start your project here-->

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
          <form method="POST" action="{{ route('userRegister.post')}}">
            @csrf
            <div class="divider d-flex align-items-center my-4">
              <p class="text-center fw-bold mx-3 mb-0">Register</p>
            </div>

            <!-- Your 1st name input -->
            <div class="form-outline mb-4">
              <input type="tett" id="form3Example3" name="firstname" value="{{old('firstname')}}" class="form-control form-control-lg"
                placeholder="Enter your name" />
              <label class="form-label" name="firstname" for="form3Example3">First name</label>
            </div>

            <!-- Last name input -->
            <div class="form-outline mb-3">
              <input type="text" name="lastname" value="{{old('lastname')}}" required  id="form3Example4" class="form-control form-control-lg"
                placeholder="Enter your Last name" />
              <label class="form-label"  name="lastname" for="form3Example4">Last name</label>
            </div>

            <!-- Mobile num input -->
            <div class="form-outline mb-3">
              <input type="tel" name="contact_num" pattern="[0-9]{11}" placeholder="09*********" value="{{old('contact_num')}}" required id="form3Example4" class="form-control form-control-lg"
                placeholder="09*********" />
              <label class="form-label" for="form3Example4">Contact Number</label>
            </div>

            <div class="form-outline mb-4">
              <input type="text" name="address" value="{{old('address')}}" required id="form3Example3" class="form-control form-control-lg"
                placeholder="Please enter the address" />
              <label class="form-label" for="form3Example3">Address</label>
            </div>

            <div class="form-outline mb-4">
              <input type="date" name="birthdate" value="{{old('birthdate')}}" required id="form3Example3" class="form-control form-control-lg" />
              <label class="form-label" for="form3Example3">Birthday</label>
            </div>
            
            <div class="form-outline mb-4">
              <input type="email" name="email" value="{{old('email')}}" class="form-control form-control-lg"
                placeholder="Enter a valid email address" />
              <label class="form-label" for="form3Example3"> Add Email address</label>
            </div>

            <div class="form-outline mb-4">
              <input type="password" name="password" value="{{old('password')}}" required class="form-control form-control-lg"
                placeholder="Enter a valid email address" />
              <label class="form-label" for="form3Example3">Password</label>
            </div>

            <div class="form-outline mb-4">
              <input type="password" id="form3Example3" name="password_confirmation" value="{{old('password_confirmation')}}" required class="form-control form-control-lg"
                placeholder="Enter a valid email address" />
              <label class="form-label"   for="form3Example3">Confirm Password</label>
            </div>

            <input type="text" name='role' value="tenant" hidden>

            <div class="d-flex justify-content-between align-items-center">
              <!-- Checkbox -->
              <div class="form-check mb-0">
              </div>
            </div>
            @if($errors->any())
                        <div class="warning-messages" style="color:red">
                        @foreach ($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                        </div>
                    @endif

                    @if(session()->has("error"))
                        <div class="warning-messages" style="color:red">
                            <p>{{session("error")}}</p>
                        </div>
                    @endif
            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="{{route('login')}}"
                  class="link-danger">Log in</a></p>
            </div>

          </form>
          <script>
            document.addEventListener('DOMContentLoaded', (event) => {
              const dateInput = document.getElementById('birthday');
              
              dateInput.addEventListener('focus', function(e) {
                const value = e.target.value;
                if (value) {
                  const [day, month, year] = value.split('-');
                  e.target.value = `${year}-${month}-${day}`;
                  e.target.type = 'date';
                }
              });
          
              dateInput.addEventListener('blur', function(e) {
                e.target.type = 'text';
                const value = e.target.value;
                if (value) {
                  const [year, month, day] = value.split('-');
                  e.target.value = `${day}-${month}-${year}`;
                }
              });
          
              dateInput.addEventListener('change', function(e) {
                const value = e.target.value;
                if (value) {
                  const [year, month, day] = value.split('-');
                  e.target.value = `${day}-${month}-${year}`;
                }
              });
            });
          </script>
          

      <!-- Right -->
    </div>
  </section>
  <!-- End your project here-->

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
</body>

</html>