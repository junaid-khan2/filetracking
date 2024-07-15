{{-- @if ($errors->any())

    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error !</strong> {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach

@endif


@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif --}}

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Error!',
                body: '{{ $error }}'
            });
        </script>
    @endforeach
@endif

@if (Session::has('success'))
    <script>
        $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Success!',
            body: '{{ Session::get('success') }}'
        });
    </script>
@endif

