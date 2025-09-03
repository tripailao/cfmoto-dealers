<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        @if (session('swal'))
            <script>
                Swal.fire(@json(session('swal')));
            </script>
        @endif
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
