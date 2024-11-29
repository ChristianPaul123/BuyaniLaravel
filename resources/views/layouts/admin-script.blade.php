{{-- <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS (5.3.3 - Matches the CSS version) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<!-- AOS (Animate On Scroll - v2.3.4) -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<!-- Moment.js (For date manipulation) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js" crossorigin="anonymous"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.js"></script>
<!--<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>-->
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
<!-- Livewire Scripts -->
@livewireScripts --}}

<!-- jQuery and Dependent Libraries -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

<!-- DataTables Buttons Extensions -->
<script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap5.js"></script>

<!-- File Export Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>

<!-- DataTables Column Visibility -->
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.colVis.min.js"></script>

<!-- Other Libraries -->
<script defer  src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js" crossorigin="anonymous"></script>
<script defer src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js" crossorigin="anonymous"></script>

<!-- Alphine JS -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>

<!-- Livewire Scripts -->
@livewireScripts



<script>
//Tables for the Product
new DataTable('#categoryTable');
new DataTable('#productTable');
new DataTable('#subcategoryTable');
new DataTable('#productSpecificationTable');



//Tables for the Orders
new DataTable('#orderCancelledTable');
new DataTable('#orderCompletedTable');
new DataTable('#orderStandbyTable');
new DataTable('#orderPayTable');
new DataTable('#orderShipTable');


//Tables for the Admin
new DataTable('#adminTable');

//Tables for the Reports
new DataTable('#currentInventoryTable', {
    layout: {
        topStart: {
            buttons: [
                {
                    extend: 'copy',
                    title: 'Current Inventory Report' // Custom title
                },
                {
                    extend: 'csv',
                    title: 'Current Inventory Report' // Custom title
                },
                {
                    extend: 'excel',
                    title: 'Current Inventory Report' // Custom title
                },
                {
                    extend: 'pdf',
                    title: 'Buyani Current Inventory Report', // Custom title
                    orientation: 'portrait', // Example of additional customization
                    pageSize: 'A4' // Example of additional customization
                },
                {
                    extend: 'print',
                    title: 'Current Inventory Report' // Custom title
                }
            ]
        }
    }
});

new DataTable('#pastInventoryTable', {
    layout: {
        topStart: {
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        }
    }
});


new DataTable('#blogTable');
</script>

<script>
    // DataTables initialization
    $(document).ready(function() {
        $('.datatable').DataTable({
            responsive: true,
            autoWidth: false,
        });
    });
</script>