<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src = " https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js">
    </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js">
    </script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js">
    </script>
    $(document).ready(function() {
    $('#myTable').DataTable();
    } );
    </script>
</head>

<body>
    <h1> Bootstrap Datatable </h1>
    <table id="myTable" class="table table-bordered" style="width: 100%">
        <thead>
            <tr>
                <th> Name </th>
                <th> Place </th>
                <th> Position </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> Emma Thor </td>
                <td> NYK </td>
                <td> Technical writer </td>
            </tr>
            <td> Merry Tyson </td>
            <td> NYK </td>
            <td> blog writer </td>
            </tr>
    </table>
</body>

</html>