<!-- Bootstrap JS from CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Include DataTables JavaScript (version 1.13.6) from CDN -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
  // Your DataTable initialization scripts
  $(document).ready(function() {
    $('#user-datatables').dataTable({
      "lengthMenu": [5, 10, 25, 50, 75, 100]
    });

    // Initialize DataTable for Module 1
    $('#user-datatables-module1').DataTable({
      "lengthMenu": [5, 10, 25, 50, 75, 100]
    });

    // Initialize DataTable for Module 2
    $('#user-datatables-module2').DataTable({
      "lengthMenu": [5, 10, 25, 50, 75, 100]
    });

    // Initialize DataTable for Module 3
    $('#user-datatables-module3').DataTable({
      "lengthMenu": [5, 10, 25, 50, 75, 100]
    });

    // Initialize DataTable for Module 4
    $('#user-datatables-module4').DataTable({
      "lengthMenu": [5, 10, 25, 50, 75, 100]
    });
    // Initialize DataTable for Module 4
    $('#user-datatables-module5').DataTable({
      "lengthMenu": [5, 10, 25, 50, 75, 100]
    });

    // Additional DataTable configurations
    $('#ledger-table').DataTable({
      paging: true,
      searching: true,
      ordering: true,
      order: [
        [0, 'desc']
      ],
      lengthMenu: [5, 10, 25, 50],
      language: {
        paginate: {
          next: '<i class="fa fa-angle-right"></i>',
          previous: '<i class="fa fa-angle-left"></i>'
        }
      }
    });
  });
  $('select').selectpicker();
</script>