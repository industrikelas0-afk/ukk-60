document.addEventListener('DOMContentLoaded', function() {
    // 1. Logika Logout dengan SweetAlert
    const logoutBtn = document.querySelector('a[href="/logout"]');
    const logoutForm = document.getElementById('logout-form');

    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault(); // Stop link agar tidak error GET

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Sesi anda akan segera berakhir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Keluar!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jalankan form logout POST
                    logoutForm.submit();
                }
            });
        });
    }

    // 2. Logika Dropdown (Tetap dipertahankan)
    const dropdownLink = document.querySelector('.dropdown-wrapper > .nav-link');
    if (dropdownLink) {
        dropdownLink.addEventListener('click', function() {
            this.parentElement.classList.toggle('open');
        });
    }
});