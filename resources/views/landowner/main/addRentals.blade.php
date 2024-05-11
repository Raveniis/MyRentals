<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{ asset('css/landowner/main.css')}}">
    <link rel="stylesheet" href="{{ asset('css/landowner/styles.css')}}">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Seller Dashboard Panel</title> 
</head>
<body>
    @include('landowner.components.sidebar')

    <section class="dashboard">
        @include('landowner.components.header')

        <div class="dash-content" style="padding-top: 0px !important;">
            <div class="overview">
                <div class="title">
                <i class="uil uil-plus-square"></i>                    
                <span class="text">Add Rentals</span>
                </div>
            </div>
        </div>
        <section>
        <form action="{{ route('addRentals.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container flex">
            <div class="left">
                <div class="main_image">
                <label for="imageInput">Add Image:</label>
                <input type="file" name="image" id="imageInput" accept="image/*" onchange="previewImage()" required>
                <img id="preview" class="slide" alt="Preview Image" width="470px" height="400px" style="object-fit: cover">
                </div>
            </div>
            <div class="right">
                <h3>
                    <label for="productName">Rental Name:</label>
                    <input type="text" placeholder="Enter rentals name" name="name" value="{{ old('name')}}" required>
                </h3>
                <h3>
                    <label for="productDescription">Rental Description:</label>
                    <textarea id="productDescription" placeholder="Enter description" name="description"  required>{{ old('description')}}</textarea>
                </h3>
                <h3>
                    <label for="address">Address:</label>
                    <input placeholder="House #, Street, City, Province" name="address" value="{{ old('address')}}" required>
                </h3>
                <h4>
                    <label for="monthly_rent">Monthly Rent: (₱)</label>
                    <small><input type="number" placeholder="Enter monthly rent" name="monthly_rent" value="{{ old('monthly_rent')}}" required></small>
                </h4>
                {{-- <h5>
                <label for="productCategory">Category:</label>
                <select id="stateId" name="category">
                    <option hidden disabled selected value></option>
                    <option value="CPU">CPU</option>
                    <option value="GPU">GPU</option>
                    <option value="RAM">RAM</option>
                    <option value="Motherboard">Motherboard</option>
                    <option value="Power Supply">PSU</option>
                    <option value="Peripherals">Peripherals</option>
                    <option value="Accessories">Accessories</option>
                    <option value="Others">Others</option>
                </select>
                </h5> --}}
                <h4>
                    <label for="maximum_occupants">Maximum Occupants:</label>
                    <input type="number" name="maximum_occupants" placeholder="Enter maximum occupants" value="{{ old('maximum_occupants') ? old('maximum_occupants') : 2 }}"  required>
                </h4>
                <h4>
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

                    @if(session()->has("success"))
                        <div class="warning-messages" style="color:green">
                            <script>
                                Swal.fire(
                                    "Success!",
                                    "Rentals has been added.",
                                    "success"
                                );
                            </script>
                        </div>
                    @endif
                </h4>
                <button tyoe="submit" name="add">Add Rentals</button>
            </div>
            </div>
        </form>
        </section>
        <script src="{{asset('js/landowner/addRentals.js')}}"></script>
    </section>

    <script src="{{asset('js/landowner/main.js')}}"></script>
</body>
</html>