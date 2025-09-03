<x-layouts.app :title="__('Dealers')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative w-full flex flex-row">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1">{{ __('Vehículos')}}</flux:heading>
                <flux:subheading size="lg">{{ __('Listado de modelos de vehículos') }}</flux:subheading>
            </div>
            <div class="basis-1/3 text-right">
                @if ( auth()->user()->hasanyrole('super-admin|admin'))
                <flux:button
                    href="{{route('vehicles.create')}}"
                    icon:trailing="plus-circle"
                >
                    Agregar vehículo
                </flux:button>
                @endif
            </div>
        </div>
        <div class="my-3">
            <flux:separator variant="subtle" />
        </div>

        <div class="mb-4 bg-gray-100 p-4 rounded-lg shadow-md">
        <form action="{{ url('/search')}}" type="get">
            <flux:field>
                <flux:input icon="magnifying-glass" type="search" name="vehicle" placeholder="Buscar por modelo comercial, serie o código de modelo" />
            </flux:field>
        </form>
        </div>

        <div class="mb-3">
            <span class="text-gray-500 font-bold">Series:</span>
            <flux:badge color="cyan"><a href="/search?vehicle=MT">MT</a></flux:badge>
            <flux:badge color="cyan"><a href="/search?vehicle=SR">SR</a></flux:badge>
            <flux:badge color="cyan"><a href="/search?vehicle=NK">NK</a></flux:badge>
            <flux:badge color="cyan"><a href="/search?vehicle=CL">CL</a></flux:badge>
            <flux:badge color="cyan"><a href="/search?vehicle=CFORCE">CFORCE</a></flux:badge>
            <flux:badge color="cyan"><a href="/search?vehicle=ZFORCE">ZFORCE</a></flux:badge>
            <flux:badge color="cyan"><a href="/search?vehicle=YOUTH">YOUTH</a></flux:badge>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">
            @foreach ($vehicles as $vehicle)
            <div class="p-4 border border-gray-100 rounded-lg shadow-md">
                <a href="{{ route('vehicles.show', $vehicle->id) }}" class="text-cyan-500 hover:text-cyan-600">
                    <img src="{{Storage::url($vehicle->image_path)}}" class="mb-4" width="200">
                    <h2><b>{{$vehicle->name}}</b></h2>
                </a>
                <p>{{$vehicle->code}}</p>

                <flux:separator variant="subtle" class="my-4"/>

                <flux:button href="{{route('vehicles.show', $vehicle->id)}}" icon="chevron-right" variant="primary" size="sm">Ver modelo</flux:button>
                @if ( auth()->user()->role >= 89 )
                    <flux:button href="{{route('vehicles.edit', $vehicle->id)}}" icon="pencil-square" variant="filled" size="sm">Editar </flux:button>
                @endif
            </div>
            @endforeach
        </div>

    </div>
</x-layouts.app>
