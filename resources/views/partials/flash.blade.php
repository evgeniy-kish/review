@if(session('flash'))
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    @endpush

    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
        <script>
          Swal.fire(
            "{{ session('flash.title', '👌') }}",
            "{{ session('flash.message', 'Yea!') }}",
            "{{ session('flash.type', 'success') }}",
          );
        </script>
    @endpush
@endif