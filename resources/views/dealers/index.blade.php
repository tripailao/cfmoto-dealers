<x-layouts.app :title="__('Dealers')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative w-full flex flex-row">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1">{{ __('Dealers de CFMOTO en Chile')}}</flux:heading>
                <flux:subheading size="lg">{{ __('Listado de distribuidores') }}</flux:subheading>
            </div>
            <div class="basis-1/3 text-right">
                @if ( auth()->user()->hasanyrole('super-admin|admin'))
                <flux:button
                    href="{{ route('dealers.trashed' ) }}"
                    icon:trailing="trash"
                >
                    Papelera
                </flux:button>

                <flux:button
                    href="{{route('dealers.create')}}"
                    icon:trailing="plus-circle"
                >
                    Agregar dealer
                </flux:button>
                @endif
            </div>
        </div>
        <div class="my-3">
            <flux:separator variant="subtle" />
        </div>

        <div class="border border-gray-100 rounded-lg shadow-xl">
        <table class="table table-auto w-full text-left ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                <th class="p-4">Dealer</th>
                <th class="p-4">Ciudad</th>
                <th class="p-4">Dirección</th>
                <th class="p-4">Telefono</th>
                @if ( auth()->user()->hasanyrole('super-admin|admin'))
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
                    <td class="px-4 py-3">
                    <div class="flex flex-row gap-2">
                        <flux:button
                        href="{{route('dealers.edit', $dealer->id)}}"
                        variant="primary"
                        class="bg-cyan-500 hover:bg-cyan-600"
                        size="sm"
                        icon:trailing="pencil-square"
                        >
                            Editar
                        </flux:button>
                        <form action="{{ route('dealers.trash', $dealer->id) }}" method="POST">
                            @csrf
                            <flux:button
                                as="button"
                                type="submit"
                                variant="primary"
                                class="border-red-600 bg-red-500 hover:bg-red-600"
                                icon="trash"
                                size="sm">
                            </flux:button>
                        </form>
                    </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>

    </div>
</x-layouts.app>
