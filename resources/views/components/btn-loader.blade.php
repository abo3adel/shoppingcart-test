@props(['id', 'vue'])

    <span @isset($vue) :id="'spinner' + {{ $id }}" @else id="spinner{{ $id }}" @endisset
        class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
