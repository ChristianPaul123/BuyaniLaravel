



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
new DataTable('#ordercancelledTable');
new DataTable('#ordercompletedTable');
new DataTable('#orderstandbyTable');
new DataTable('#orderpayTable');
new DataTable('#ordershipTable');
new DataTable('#orderarchivedTable');
new DataTable('#orderdeliverTable');


//Tables for the Admin
new DataTable('#adminTable');


//Tables for the Sponsors Images
new DataTable('#sponsorImagesTable');

//Tables for the Report logs
new DataTable('#userlogTable');
new DataTable('#orderlogTable');
new DataTable('#productlogTable');
new DataTable('#adminlogTable');

//Tables for the Reviews
new DataTable('#productreviewTable');
new DataTable('#orderreviewTable');

//Tables for the Votes
new DataTable('#currentvotesTable');
new DataTable('#managesuggestionsTable');
new DataTable('#pastvotesTable');


//Tables for the Reports
new DataTable('#currentInventoryTable', {
    layout: {
        topStart: {
            buttons: [
                {
                    extend: 'copy',
                    title: 'Buyani Current Inventory Report', // Custom title
                },
                {
                    extend: 'csv',
                    title: 'Buyani Current Inventory Report', // Custom title
                },
                {
                    extend: 'excel',
                    title: 'Buyani Current Inventory Report', // Custom title
                },
                {
                    extend: 'pdf',
                    title: 'Buyani Current Inventory Report', // Custom title
                    orientation: 'portrait', // Example of additional customization
                    pageSize: 'A4' // Example of additional customization
                },
                {
                    extend: 'print',
                    title: 'Buyani Current Inventory Report', // Custom title
                }
            ]
        }
    }
});

new DataTable('#productsalesTable', {
    layout: {
        topStart: {
            buttons: [
                {
                    extend: 'copy',
                    title: 'Buyani Product Sales Report', // Custom title
                },
                {
                    extend: 'csv',
                    title: 'Buyani Product Sales Report', // Custom title
                },
                {
                    extend: 'excel',
                    title: 'Buyani Product Sales Report', // Custom title
                },
                {
                    extend: 'pdf',
                    title: 'Buyani Product Sales Report', // Custom title
                    orientation: 'portrait', // Example of additional customization
                    pageSize: 'A4' // Example of additional customization
                },
                {
                    extend: 'print',
                    title: 'Buyani Product Sales Report', // Custom title
                }
            ]
        }
    }
});

new DataTable('#specificproductsalesTable', {
    layout: {
        topStart: {
            buttons: [
                {
                    extend: 'copy',
                    title: 'Buyani Specific Product Sales Report', // Custom title
                },
                {
                    extend: 'csv',
                    title: 'Buyani Specific Product Sales Report', // Custom title
                },
                {
                    extend: 'excel',
                    title: 'Buyani Specific Product Sales Report', // Custom title
                },
                {
                    extend: 'pdf',
                    title: 'Buyani Specific Product Sales Report', // Custom title
                    orientation: 'portrait', // Example of additional customization
                    pageSize: 'A4' // Example of additional customization
                },
                {
                    extend: 'print',
                    title: 'Buyani Specific Product Sales Report', // Custom title
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
new DataTable('#adminfarmerTable');
new DataTable('#adminconsumerTable');
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
