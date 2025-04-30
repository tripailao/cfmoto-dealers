<x-layouts.app :title="__('Dealers')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative mb-6 w-full flex flex-row">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1">{{ __('Dealers de CFMOTO en Chile')}}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('Listado de distribuidores') }}</flux:subheading>
                <flux:separator variant="subtle" />
            </div>
            <div class="basis-1/3 text-right">
                @if ( auth()->user()->role >= 89 )
                <flux:button
                    href="{{route('dealers.create')}}"
                    icon:trailing="plus-circle"
                >
                    Agregar dealer
                </flux:button>
                @endif
            </div>
        </div>

        <div class="border border-gray-100 rounded-lg shadow-xl">
        <table class="table table-auto w-full text-left ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                <th class="p-4">Dealer</th>
                <th class="p-4">Ciudad</th>
                <th class="p-4">Dirección</th>
                <th class="p-4">Telefono</th>
                @if ( auth()->user()->role >= 89 )
                    <th class="p-4">Editar</th>
                @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($dealers as $dealer)
                <tr>
                    <td class="px-4 py-3 font-bold">{{$dealer->name}}</td>
                    <td class="px-4 py-3">{{$dealer->city}}</td>
                    <td class="px-4 py-3">{{$dealer->address}}</td>
                    <td class="px-4 py-3">{{$dealer->phone}}</td>
                    @if ( auth()->user()->role >= 89 )
                        <td class="px-4 py-3"><flux:button href="{{route('dealers.edit', $dealer->id)}}" icon="pencil-square" size="sm"></flux:button></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>

    </div>
</x-layouts.app>
