<script src="{{ asset('dist-front/js/jquery.min.js') }}"></script>
<script src="{{ asset('dist-front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist-admin/js/iziToast.min.js') }}"></script>
<script src="{{ asset('dist-front/js/script.js') }}"></script>

@if($errors->any())
    <script>
        iziToast.error({
            message: '{{ $errors->first() }}',
            position: 'topRight',
            timeout: 5000,
            progressBarColor: '#FF0000',
        });
    </script>
@endif

@if(session('success'))
    <script>
        iziToast.success({
            message: '{{ session('success') }}',
            position: 'topRight',
            timeout: 5000,
            progressBarColor: '#00FF00',
        });
    </script>
@endif

@if(session('error'))
    <script>
        iziToast.error({
            message: '{{ session('error') }}',
            position: 'topRight',
            timeout: 5000,
            progressBarColor: '#FF0000',
        });
    </script>
@endif