 <!doctype html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <title>{{ config('app.name', 'Laravel') }}</title>

     <!-- Fonts -->
     <link rel="dns-prefetch" href="//fonts.gstatic.com">
     <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

     <!-- css -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.7/css/bootstrap.min.css"
         integrity="sha512-fw7f+TcMjTb7bpbLJZlP8g2Y4XcCyFZW8uy8HsRZsH/SwbMw0plKHFHr99DN3l04VsYNwvzicUX/6qurvIxbxw=="
         crossorigin="anonymous" referrerpolicy="no-referrer" />
     <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
 </head>

 <body>
     <div id="app">
         <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
             <div class="container">
                 <a class="navbar-brand" href="{{ url('/') }}">
                     {{ config('app.name', 'Laravel') }}
                 </a>
                 <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                     data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                     aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                     <span class="navbar-toggler-icon"></span>
                 </button>
             </div>
         </nav>
         <main class="py-4">
             <div class="container mt-2">
                 <div class="row">
                     <div class="col-lg-12 margin-tb">
                         <div class="pull-left">
                             <h2>Users</h2>
                         </div>
                     </div>
                 </div>
                 <!-- Table -->
                 <table id="users-table" class="table table-bordered">
                     <thead>
                         <tr>
                             <th>Name</th>
                             <th>Email</th>
                             <th>Gender</th>
                             <th>DOB</th>
                             <th>Phone No</th>
                             <th>Address</th>
                             <th>Created At</th>
                         </tr>
                     </thead>
                 </table>
             </div>
         </main>
     </div>

     @include('drower')
     <!-- Scripts -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
         integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
         crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.7/js/bootstrap.min.js"
         integrity="sha512-zKeerWHHuP3ar7kX2WKBSENzb+GJytFSBL6HrR2nPSR1kOX1qjm+oHooQtbDpDBSITgyl7QXZApvDfDWvKjkUw=="
         crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <!-- DataTables JS -->
     <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
     <script>
         $(document).ready(function() {
             const table = $('#users-table').DataTable({
                 processing: true,
                 serverSide: true,
                 ajax: "{{ route('users.index') }}",
                 columns: [{
                         data: 'name',
                         name: 'name'
                     },
                     {
                         data: 'email',
                         name: 'email'
                     },
                     {
                         data: 'gender',
                         name: 'gender'
                     },
                     {
                         data: 'dob',
                         name: 'dob'
                     },
                     {
                         data: 'phone_no',
                         name: 'phone_no'
                     },
                     {
                         data: 'address',
                         name: 'address'
                     },
                     {
                         data: 'created_at',
                         name: 'created_at'
                     },
                 ],
                 rowCallback: function(row, data) {
                     $(row).addClass('cursor-pointer');
                     $(row).attr('data-id', data.id);
                 }
             });
             // View Drawer
             $(document).on('click', '#users-table tbody tr', function(e) {
                 e.preventDefault();
                 const id = $(this).data('id');
                 const drawer = new bootstrap.Offcanvas(document.getElementById('userDrawer'));
                 drawer.show();
                 $('#drawer-content').html('<div class="text-center">Loading...</div>');

                 $.ajax({
                     url: "{{ route('users.show', ['id' => ':id']) }}".replace(':id', id),
                     method: 'GET',
                     success: function(res) {
                         $('#drawer-content').html(res);
                     },
                     error: function() {
                         $('#drawer-content').html(
                             '<div class="alert alert-danger">Failed to load user data.</div>'
                         );
                     }
                 });
             });
         });
     </script>
 </body>

 </html>
