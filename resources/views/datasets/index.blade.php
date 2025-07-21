<x-layouts.app :title="__('Dealers')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative mb-6 w-full flex flex-row">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1">{{ __('Datasets')}}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('Listado de catálogos y manuales') }}</flux:subheading>
                <flux:separator variant="subtle" />
            </div>
            <div class="basis-1/3 text-right">
                @if ( auth()->user()->hasanyrole('super-admin|admin'))
                <flux:button
                    href="{{route('datasets.create')}}"
                    icon:trailing="plus-circle"
                >
                    Subir nuevo documento
                </flux:button>
                @endif
            </div>
        </div>

        <div class="border border-gray-100 rounded-lg shadow-xl">
        <table class="table table-auto w-full text-left ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                <th class="p-4">Año</th>
                <th class="p-4">Modelo</th>
                <th class="p-4">Tipo</th>
                <th class="p-4">Archivo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datasets as $dataset)
                <tr>
                    <td class="px-4 py-3 font-bold">{{$dataset->vehicle_year}}</td>
                    <td class="px-4 py-3">{{$dataset->vehicle->name}} | {{$dataset->vehicle->code}}</td>
                    <td class="px-4 py-3">{{$dataset->type_data}}</td>
                    <td class="px-4 py-3">
                        <flux:button
                            variant="primary"
                            class="bg-cyan-500 hover:bg-cyan-600"
                            href="{{Storage::url($dataset->file_path)}}"
                            size="sm"
                            icon="arrow-down-tray"
                        >
                            Descargar
                        </flux:button>
                        <form action="{{ route('datasets.delete', $dataset->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <flux:button
                                as="button"
                                type="submit"
                                variant="primary"
                                class="bg-red-50 hover:bg-red-600 border-red-500 text-red-500 hover:text-neutral-50"
                                size="sm"
                                icon="trash"
                            >Eliminar
                            </flux:button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>

    </div>
</x-layouts.app>
