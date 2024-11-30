<script>
    function showPopup() {
        const popup = document.getElementById('notif');

        popup.classList.remove('hidden');

        setTimeout(() => {
            popup.classList.add('hidden');
        }, 10000);
    }

    window.onload = () => showPopup();
</script>
