<x-layouts.app :title="__('Dealers')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative w-full flex flex-row">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1">{{ __('Papelera: Dealers')}}</flux:heading>
                <flux:subheading size="lg">{{ __('Distribuidores o servicios archivados') }}</flux:subheading>
                <flux:separator variant="subtle" />
            </div>
            <div class="basis-1/3 text-right">
                @if ( auth()->user()->hasanyrole('super-admin|admin'))
                <flux:button
                    href="{{route('dealers.index')}}"
                    icon:trailing="list-bullet"
                >
                    Ver publicados
                </flux:button>
                @endif
            </div>
        </div>
        <div class="my-3">
            <flux:separator variant="subtle" />
        </div>

        @if($dealers->count() == 0 )
            <div class="p-3 rounded bg-amber-100 text-amber-700 border border-amber-300 shadow">
                <p><flux:icon.information-circle class="inline" /> No hay elementos en la papelera</p>
            </div>
        @else

        <div class="border border-gray-100 rounded-lg shadow-xl">
        <table class="table table-auto w-full text-left ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                <th class="p-4">Dealer</th>
                <th class="p-4">Ciudad</th>
                <th class="p-4">Dirección</th>
                <th class="p-4">Telefono</th>
                <th class="p-4">Editar</th>
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
                        <form action="{{ route('dealers.restore', $dealer->id) }}" method="POST">
                            @csrf
                            <flux:button
                                as="button"
                                type="submit"
                                variant="primary"
                                class="border-green-600 bg-green-500 hover:bg-green-600"
                                icon="arrow-uturn-left"
                                size="sm">
                            Restaurar
                            </flux:button>
                        </form>
                        <form action="{{ route('dealers.destroy', $dealer->id) }}" method="POST">
                            @csrf
                            <flux:button
                                as="button"
                                type="submit"
                                variant="primary"
                                class="border-red-600 bg-red-500 hover:bg-red-600"
                                icon="x-mark"
                                size="sm">
                            Eliminar
                            </flux:button>
                        </form>
                    </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        @endif
    </div>
</x-layouts.app>
