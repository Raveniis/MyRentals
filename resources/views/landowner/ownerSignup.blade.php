
<html>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="{{ asset('css/landowner/login.css') }}" rel="stylesheet">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
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
                <form id="login-form" action="{{ route('ownerSignup.post')}}" method="POST" style="transform: translateY(230px);">  
                    @csrf
                    <h2>Sign up</h2>
                    
                    <div class="input-box">
                        <input type="text" name="firstname" value="{{old('firstname')}}" required>
                        <label>First name</label>
                    </div>

                    <div class="input-box">
                        <input type="text" name="lastname" value="{{old('lastname')}}" required>
                        <label>Last name</label>
                    </div>

                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-phone'></i></span>

                        <label style="top: -3px;">Contact Number</label>   
                        <input type="tel" name="contact_num" pattern="[0-9]{11}" placeholder="09*********" value="{{old('contact_num')}}" required>
                    </div>
                    
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-map'></i></span>

                        <label style="top: -3px;">Address</label>
                        <input type="text" name="address" value="{{old('address')}}" required placeholder="House #, Street, City, Province">
                    </div>

                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-cake'></i></span>

                        <label style="top: -3px;">Birthday</label>   
                        <input type="date" name="birthdate" value="{{old('birthdate')}}" required>
                    </div>

                    {{-- <div class="input-box">
                        <label style="top: -3px;">Gender</label>
                        <select id="signup-gender" required>
                            <option hidden disabled selected value></option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="would rather not say">Would rather not say</option>
                        </select>
                    </div> --}}

                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-envelope'></i></span>
                    
                        <input type="text" name="email" value="{{old('email')}}" required>
                        <label>Email</label>
                    </div>

                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-lock-alt' ></i></span>
                    
                        <input type="password" name="password" value="{{old('password')}}" required>
                        <label>Password</label>
                    </div>

                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-lock-alt' ></i></span>
                    
                        <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}"required>
                        <label>Repeat password</label>
                    </div>

                    <input type="hidden" name='role' value="landowner">

                    <div class="login-register">
                        <div class="warning-messages"><p id=signup-warning></p></div>
                    </div>

                    <div class="remember-forgot">
                        <label><input type="checkbox" required><a id="showTermsAndCondition" href="#" style="margin-left:10px;">I agree to the Term & Conditions</a></label>
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
                    
                    <button id="signup-submit" type="submit" class="btn" name="signup">Sign up</button>                    

                    <div class="login-register">
                        <p style="margin-bottom:50px;">Already have an account? <a href="{{route('ownerLogin')}}" class="login-link"> Sign in</a></p>
                    </div>
                </form>
            </div>    
        </div> 
    </div>
</body>
 
</html>