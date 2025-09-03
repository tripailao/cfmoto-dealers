<x-layouts.app :title="__('Dealers')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative mb-6 w-full flex flex-row">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1">{{ __('Vehículos')}}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('Listado de modelos de vehículos') }}</flux:subheading>
                <flux:separator variant="subtle" />
            </div>
            <div class="basis-1/3 text-right">
                @if ( auth()->user()->role >= 89 )
                <flux:button
                    href="{{route('vehicles.create')}}"
                    icon:trailing="plus-circle"
                >
                    Agregar vehículo
                </flux:button>
                @endif
            </div>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg">
            <form action="{{ url('/search')}}" type="get">
                <flux:field>
                    <flux:input icon="magnifying-glass" type="search" name="vehicle" placeholder="Buscar por modelo, codigo o año" />
                </flux:field>
            </form>
        </div>

        <div class="border border-gray-100 rounded-lg shadow-xl">
        <table class="table table-auto w-full text-left ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                <th class="p-4">Modelo</th>
                <th class="p-4">Serie</th>
                <th class="p-4">Código</th>
                <th class="p-4">Año</th>
                @if ( auth()->user()->role >= 89 )
                    <th class="p-4">Editar</th>
                @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicles as $vehicle)
                <tr>
                    <td class="px-4 py-3 font-bold">{{$vehicle->name}} <img src="{{Storage::url($vehicle->image_path)}}" width="100"></td>
                    <td class="px-4 py-3">{{$vehicle->serie->name}}</td>
                    <td class="px-4 py-3">{{$vehicle->code}}</td>
                    <td class="px-4 py-3">{{$vehicle->year}}</td>
                    @if ( auth()->user()->role >= 89 )
                        <td class="px-4 py-3"><flux:button href="{{route('vehicles.edit', $vehicle->id)}}" icon="pencil-square" size="sm"></flux:button></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>

    </div>
</x-layouts.app>
