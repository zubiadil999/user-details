<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
   <!-- Tailwind CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css">
   
   <!-- SweetAlert -->
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">{{ __('Form Entries') }}</div>

        <div class="card-body">
            <table id="form-entries-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Profile Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Profile Image') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($profiles as $profile)
                        <tr>
                            <td>{{ $profile->id }}</td>
                            <td>{{ $profile->profile_name }}</td>
                            <td>{{ $profile->email }}</td>
                            <td>
                            @if ($profile->profile_image)
                                <img src="{{ asset('storage/images/' . $profile->profile_image) }}" alt="Profile Image" width="50">
                            @else
                                No Image
                            @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.edit', $profile->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                                <form action="{{ route('admin.delete', $profile->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#form-entries-table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            // "lengthMenu": [1],
            "language": {
                "paginate": {
                    "first": "&#171;", // Previous button text
                    "last": "&#187;", // Next button text
                    "next": "&#8250;", // Next button text
                    "previous": "&#8249;" // Previous button text
                }
            }
        });
    });
</script>
<script>
    @if(session('success'))
        swal("Success!", "{{ session('success') }}", "success");
    @endif
</script>

</body>
</html>
