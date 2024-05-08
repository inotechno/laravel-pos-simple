<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js
"></script>

@if ($message = Session::get('success'))
    <script>
        Swal.fire({
            icon: "success",
            title: "{{ $message }}",
            showConfirmButton: !1,
            timer: 3000,
        });
    </script>
@endif

@if ($message = Session::get('error'))
    <script>
        Swal.fire({
            icon: "error",
            title: "{{ $message }}",
            showConfirmButton: !1,
            timer: 3000,
        });
    </script>
@endif

<script>
    function notification(type, message) {
        if (type == 'success') {
            Swal.fire({
                icon: "success",
                title: message,
                showConfirmButton: !1,
                timer: 3000,
            });
        } else {
            Swal.fire({
                icon: "error",
                title: message,
                showConfirmButton: !1,
                timer: 3000,
            });
        }
    }
</script>
