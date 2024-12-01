<script>
    function trigger(){
        const popup = document.querySelector('.notif');

        popup.style.display = 'block';
        popup.classList.remove('hidden');

        setTimeout(() => {
            popup.classList.add('hidden');
            setTimeout(() => {
                popup.style.display = 'none';
            }, 500);
        }, 10000);  <!-- 10 seconds delay -->
    }
</script>
