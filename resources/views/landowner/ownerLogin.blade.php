
<html>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="{{ asset('css/landowner/login.css') }}" rel="stylesheet">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <title>Login</title>
</head>

<body>
   <div class="background"></div>
    <div class="container">
        <div class="content">
        <h2 class="logo">{{--<img src="">--}}</img>MyRentals</h2>
            <div class="text-sci">
                <h2>Welcome!<br>
                <span>To MyRentals</span></h2>

                {{-- <p>An Online Trade and Sell Marketplace</p> --}}
            </div>

        </div>
        <div class="logreg-box">
            <div class="form-box login">
                <form id="login-form" action="{{ route('ownerLogin.post')}}" method="POST">  
                    @csrf
                    <h2>Log in</h2>
                    
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-user'></i></span>

                        <input type="text" name="email" value="{{old('email')}}" required>
                        <label>Email</label>
                    </div>

                    <div class="input-box">
                        <span class="icon"><button type="button" style="margin-right: 5px;" onmousedown="ShowPassword()" onmouseup="hidePassword()" onmouseout="hidePassword()"><i id="password-icon" class='bx bxs-show' ></i></button><i class='bx bxs-lock-alt' ></i></span>
                    
                        <input type="password" name="password" required>
                        <label>Password</label>
                    </div>

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
                                    "Accouunt has been created.",
                                    "success"
                                );
                            </script>
                        </div>
                    @endif

                    <button type="submit" class="btn" name="login">Log in</button>                    

                    <div class="login-register">
                        <p>Dont have an account? <a href="{{route('ownerSignup')}}" class="register-link">Sign up</a></p>
                    </div>
                </form>
            </div>    
        </div> 
    </div>
    
    <script src="{{ asset('js/landowner/login.js') }}"></script>
    

    @if(session()->has("error"))
        <script>
            Swal.fire({
                icon: "error",
                title: "Unauthorized User",
                text: "Invalid email or password",
            })
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