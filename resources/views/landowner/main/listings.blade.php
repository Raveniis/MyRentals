<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{ asset('css/landowner/main.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Listings</title>     
</head>

<body>
    @include('landowner.components.sidebar')

    <section class="dashboard">
        @include('landowner.components.header')
        

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                <i class="uil uil-list-ul"></i>                    
                <span class="text">Rentals List</span>
                </div>
            </div>
        </div>
        <div class="add-product-box">
            <a class="add-product-btn add-btn" href="{{ route('addRentals') }}">
                <i class="uil uil-plus-square"></i> Add New
            </a>
        </div>
        <!-- Product Table -->
        <div class="product-table">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Monthly Rent</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($houseRentals as $houseRental)
                        <tr>
                            <td>
                                <p>{{ $houseRental->name }}</p>
                                <p style='color: #999999; font-size: 13px';>{{ $houseRental->description }}</p>
                            </td>
                            <td>
                                <p>{{ $houseRental->address }}</p>
                            </td>
                            <td>
                                <p style="color: rgb(255, 166, 50);">₱{{ $houseRental->monthly_rent }}</p>
                            </td>
                            <td>
                                <p>{{ $houseRental->status === 1 ? 'Available' : 'Unavailable' }}</p>
                            </td>
                            <td class="actions">
                                <a class="icons" title="Edit" style="color:orange" href="{{ route('editRentals', ['id' => $houseRental->id]) }}">
                                    <i class='bx bx-edit' ></i>
                                </a>
                                <div class="icons" title="Delete" style="color:red" onclick="deleteConfirmation({{ $houseRental->id }})">
                                    <i class='bx bxs-trash'></i>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <div>
            {{ $houseRentals->links('pagination::bootstrap-5') }}
        </div> --}}
    </div>
    </section>
    

    @if(session()->has("success"))
        <div class="warning-messages" style="color:green">
            <script>
                Swal.fire(
                    "Deleted!",
                    "Rentals has been deleted.",
                    "success"
                );
            </script>
        </div>
    @endif

    <script src="{{asset('js/landowner/main.js')}}"></script>
</body>

<script>
    function deleteConfirmation(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this item!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel"
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('deleteRentals', ['id' => '']) }}" + '/' + id;
        }
      });
}
</script>
</html>

