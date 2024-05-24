<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{ asset('css/landowner/main.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Tenants</title>     
</head>

<body>
    @include('landowner.components.sidebar')

    <section class="dashboard">
        @include('landowner.components.header')
        

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                <i class="uil uil-list-ul"></i>                    
                <span class="text">Tenants List</span>
                </div>
            </div>
        </div>
        <!-- Product Table -->
        <div class="product-table">
            <table>
                <thead>
                    <tr>
                        <th>Tenant details</th>
                        <th>Address</th>
                        <th>Lease details</th>
                        <th>Remarks</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($tenants as $tenant)
                        <tr>
                            <td>
                                <p> {{ $tenant->user->firstname }} {{ $tenant->user->lastname }} </p>
                                <p style='color: #999999; font-size: 13px';>{{ $tenant->user->email }} | {{ $tenant->user->contact_num }}</p>
                                <p style='color: #999999; font-size: 13px';>emergency contact: {{ $tenant->tenantApplication->emergency_num }}</p>
                            </td>
                            <td>
                                <p>{{ $tenant->tenantApplication->houseRental->name }}</p>
                                <p style='color: #999999; font-size: 13px'>{{ $tenant->tenantApplication->houseRental->address  }}</p>
                                <p style="color: rgb(255, 166, 50); font-size: 13px">₱ {{ $tenant->tenantApplication->houseRental->monthly_rent }} /mo</p>
                            </td>
                            <td>
                                <p style=' font-size: 13px'> Lease term: {{ $tenant->tenantApplication->lease_term }} months</p>
                                <p style='color: #999999; font-size: 13px'> Expected date: {{ date('M-d-Y' ,strtotime('+'.$tenant->tenantApplication->lease_term.' months', strtotime($tenant->tenantApplication->created_at)))   }}</p>
                            </td>
                            <td>
                                <p style=' font-size: 13px'> {{ $tenant->remarks ? $tenant->remarks : 'none'}}</p>
                            </td>
                            <td>
                                <p style=' font-size: 13px'> {{ $tenant->status ? 'Active Tenant' : 'Inactive Tenant' }}</p>
                            </td>
                            <td class="actions">
                                @if ($tenant->status === 1)
                                    <a class="icons" title="Payment logs" style="color:green" href="{{route('paymentLog', ['id' => $tenant->id])}}">
                                        <i class='bx bx-file'></i>
                                    </a>
                                    <a class="icons" title="Edit" style="color:orange" href="{{route('tenants.show', ['id' => $tenant->id])}}">
                                        <i class='bx bx-edit' ></i>
                                    </a>
                                    <div class="icons" title="Remove Tenant" onclick="deleteConfirmation('{{  htmlspecialchars(route('tenants.remove',  ['id' => $tenant->id ])) }}')" style="color:red" >
                                        <i class='bx bxs-trash'></i>
                                    </div>
                                @else
                                    <div class="icons" title="Archive" style="color:grey" onclick="archiveConfirmation('{{ htmlspecialchars(route('tenants.delete', ['id' => $tenant->id])) }}')">
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
            {{ $tenants->links('pagination::bootstrap-5') }}
        </div>
    </div>
    </section>
    

    @if(session()->has("success"))
        <script>
            Swal.fire(
                "Deleted!",
                "{{ session('success') }}",
                "success"
            );
        </script>
    @endif

    @if(session()->has("archived"))
    <script>
        Swal.fire(
            "Archived!",
            "{{ session('archived') }}",
            "success"
        );
    </script>
@endif

    <script src="{{asset('js/landowner/main.js')}}"></script>
</body>

<script>
    function deleteConfirmation(url) {
        Swal.fire({
            title: "Are you sure?",
            text: "Once removed, you will not be able to recover this item!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Remove",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
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

