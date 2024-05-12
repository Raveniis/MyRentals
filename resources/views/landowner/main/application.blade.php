<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{ asset('css/landowner/main.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Applications</title>     
</head>

<body>
    @include('landowner.components.sidebar')

    <section class="dashboard">
        @include('landowner.components.header')
        

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                <i class="uil uil-list-ul"></i>                    
                <span class="text">Application List</span>
                </div>
            </div>
        </div>
        <!-- Product Table -->
        <div class="product-table">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>House Rental</th>
                        <th>Monthly Rent</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($tenantApplications as $tenantApplication)
                        <tr>
                            <td>
                                <p>{{ $tenantApplication->user->firstname }} {{ $tenantApplication->user->lastname }}</p>
                                <p style='color: #999999; font-size: 13px';>{{ $tenantApplication->user->email }} | {{ $tenantApplication->user->contact_num }}</p>
                            </td>
                            <td>
                                <p>{{ $tenantApplication->houseRental->name }}</p>
                                <p style='color: #999999; font-size: 13px';>{{ $tenantApplication->houseRental->address }}</p>
                            </td>
                            <td>
                                <p>{{ $tenantApplication->houseRental->monthly_rent  }}</p>
                            </td>
                            <td>
                                <p>{{ $tenantApplication->application_status }}</p>
                            </td>
                            <td class="actions">
                                @if ($tenantApplication->application_status === 'pending')
                                    <a class="icons" title="Accept" style="color:green" onclick="rejectConfirmation('{{ htmlspecialchars(route('application.accept', ['id' => $tenantApplication->id])) }}')">
                                        <i class='bx bxs-checkbox-checked'></i>
                                    </a>
                                    <a class="icons" title="Reject" style="color:red" onclick="rejectConfirmation('{{ htmlspecialchars(route('application.reject', ['id' => $tenantApplication->id])) }}')">
                                        <i class='bx bxs-checkbox-checked'></i>
                                    </a>
                                    <div class="icons" title="View" style="color:orange" href="{{ route('editRentals', ['id' => $tenantApplication->id]) }}">
                                        <i class='bx bx-notepad'></i>
                                    </div>
                                @else
                                    <div class="icons" title="View" style="color:grey" onclick="archiveConfirmation('{{ htmlspecialchars(route('application.destroy', ['id' => $tenantApplication->id])) }}')">
                                        <i class='bx bxs-archive-in' ></i>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-links">
            {{ $tenantApplications->links('pagination::bootstrap-5') }}
        </div>
    </div>
    </section>

    @if(session()->has("success"))
        <div class="warning-messages" style="color:green">
            <script>
                Swal.fire(
                    "Success!",
                    "{{ session('success') }}",
                    "success"
                );
            </script>
        </div>
    @endif

    <script src="{{asset('js/landowner/main.js')}}"></script>
</body>

<script>
    function acceptConfirmation(link) {
    Swal.fire({
        title: "Are you sure?",
        text: "Once accepted, you will not be able to undo you actions.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, accept it!",
        cancelButtonText: "Cancel"
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = link;
        }
      });
    }

    function rejectConfirmation(link) {
    Swal.fire({
        title: "Are you sure?",
        text: "Once rejected, you will not be able to undo you actions.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel"
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = link;
        }
      });
    }

    function archiveConfirmation(link) {
        Swal.fire({
            title: "Are you sure?",
            text: "This item will be archived.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, archive it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    }
</script>
</html>

