<style>
    .custom-modal {
        display: none;
        position: fixed; /* Change from absolute to fixed */
        z-index: 1050;
        width: 200px;
        max-width: calc(100% - 20px); /* Adjust the width as needed */
        max-height: calc(100% - 20px); /* Adjust the height as needed */
        overflow-y: auto; /* Enable vertical scrolling if content exceeds height */
    }
</style>
<?php @include '../include/message.php'; ?>
<!-- The Custom Modal -->
<div id="customModal" class="card custom-modal">
    <div class="card-body">
        <div class="container d-flex flex-column justify-content-center align-items-center">
            <h5 class="card-title mb-1">Admin</h5>
            <h7 class="mb-3">Manage Account</h7>
            <button type="button" id="logoutButton" class="btn btn-danger">Logout</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#triggerModal').click(function(event) {
            event.preventDefault();
            var modal = $('#customModal');

            // Toggle modal visibility
            modal.toggle();

            // If modal is visible, position it
            if (modal.is(':visible')) {
                var trigger = $(this);
                var offset = trigger.offset();
                var modalWidth = modal.outerWidth();
                var modalHeight = modal.outerHeight();
                var viewportWidth = $(window).width();
                var viewportHeight = $(window).height();
                var scrollBarWidth = viewportWidth - $(document).width(); // Calculate scrollbar width

                var modalLeft = offset.left;
                var modalTop = offset.top + trigger.outerHeight();

                // Adjust modal position if it exceeds viewport boundaries
                if (modalLeft + modalWidth > viewportWidth - scrollBarWidth) {
                    modalLeft = viewportWidth - scrollBarWidth - modalWidth - 10; // Adjust 10 pixels for padding
                }
                if (modalTop + modalHeight > viewportHeight) {
                    modalTop = viewportHeight - modalHeight - 10; // Adjust 10 pixels for padding
                }

                // Set the modal position
                modal.css({
                    top: modalTop,
                    left: modalLeft
                });
            }
        });

        $('#closeModal').click(function() {
            $('#customModal').hide();
        });

        // Hide modal when clicking outside of it
        $(document).mouseup(function(e) {
            var modal = $('#customModal');
            if (!modal.is(e.target) && modal.has(e.target).length === 0) {
                modal.hide();
            }
        });

        // Logout button functionality
        $('#logoutButton').click(function() {
            window.location.href = '../login/admin-login.php';
            sessionStorage.setItem('logout', 'true');
        });

        // Prevent back navigation to this page after logout
        if (sessionStorage.getItem('logout') === 'true') {
            sessionStorage.removeItem('logout');
            window.location.href = '../login/admin-login.php'; // Redirect to login page
        }
    });
</script>
