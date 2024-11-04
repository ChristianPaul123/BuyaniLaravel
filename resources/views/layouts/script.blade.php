<!-- This is for the js section of the layout -->
<!-- P.S I'm not sure if this is the right way to do it but it works for now -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<!-- Bootstrap 4 JS -->
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
<!-- Fade animation -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<!-- Day -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<!-- Datatables -->
<script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.js"></script>
<!--<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>-->
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

@livewireScripts




{{-- admin side for datatables --}}
<script>
new DataTable('#categoryTable');
new DataTable('#productTable');
new DataTable('#subcategoryTable');
new DataTable('#productSpecificationTable');
new DataTable('#blogTable');
</script>

<!--This is for the nav bar consumer-->
{{-- <script>
document.addEventListener('DOMContentLoaded', (event) => {
            // Get the current page URL
            const currentPage = window.location.pathname.split('/').pop();

            // Find all nav-links
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                // Extract the page from the data-page attribute
                const page = link.getAttribute('data-page');

                // Check if the link's href matches the current page
                if (link.getAttribute('href').includes(currentPage) || page === currentPage.replace('.html', '')) {
                    link.classList.add('active');
                }

                // Add click event listener to each link
                link.addEventListener('click', () => {
                    // Remove active class from all links
                    navLinks.forEach(link => link.classList.remove('active'));
                    // Add active class to clicked link
                    link.classList.add('active');
                });
            });
        });
</script> --}}
