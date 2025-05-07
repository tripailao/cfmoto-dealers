<x-layouts.app :title="__('Dealers')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative mb-6 w-full flex flex-row">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1">{{ __('Catálogo de partes')}}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('Listado de catálogos') }}</flux:subheading>
                <flux:separator variant="subtle" />
            </div>
            <div class="basis-1/3 text-right">
                @if ( auth()->user()->role >= 89 )
                <flux:button
                    href="{{route('parts-catalogs.create')}}"
                    icon:trailing="plus-circle"
                >
                    Subir nuevo catálogo
                </flux:button>
                @endif
            </div>
        </div>

        <div class="border border-gray-100 rounded-lg shadow-xl">
        <table class="table table-auto w-full text-left ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                <th class="p-4">Titulo</th>
                <th class="p-4">Descripción</th>
                <th class="p-4">Modelo</th>
                <th class="p-4">Archivo</th>
                {{-- @if ( auth()->user()->role >= 89 )
                    <th class="p-4">Editar</th>
                @endif --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($catalogs as $catalog)
                <tr>
                    <td class="px-4 py-3 font-bold">{{$catalog->title}}</td>
                    <td class="px-4 py-3">{{$catalog->description}}</td>
                    <td class="px-4 py-3">{{$catalog->vehicle_id}}</td>
                    <td class="px-4 py-3"><a href="{{Storage::url($catalog->file_path)}}" target="blank">Ver archivo</a></td>
                    {{-- @if ( auth()->user()->role >= 89 )
                        <td class="px-4 py-3"><flux:button href="{{route('vehicles.edit', $vehicle->id)}}" icon="pencil-square" size="sm"></flux:button></td>
                    @endif --}}
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>

    </div>
</x-layouts.app>
