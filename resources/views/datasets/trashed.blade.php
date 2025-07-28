<x-layouts.app :title="__('Dataset')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative w-full flex flex-row">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1">{{ __('Papelera: Dataset')}}</flux:heading>
                <flux:subheading size="lg">{{ __('Datasets archivados') }}</flux:subheading>
            </div>
            <div class="basis-1/3 text-right">
                @if ( auth()->user()->hasanyrole('super-admin|admin'))
                <flux:button
                    href="{{route('datasets.index')}}"
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

        @if($datasets->count() == 0 )
            <div class="p-3 rounded bg-amber-100 text-amber-700 border border-amber-300 shadow">
                <p><flux:icon.information-circle class="inline" /> No hay elementos en la papelera</p>
            </div>
        @else

        <div class="border border-gray-100 rounded-lg shadow-xl">
        <table class="table table-auto w-full text-left ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="p-4">ID</th>
                    <th class="p-4">Año</th>
                    <th class="p-4">Modelo</th>
                    <th class="p-4">Tipo</th>
                    <th class="p-4"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($datasets as $dataset)
                <tr>
                    <td class="px-4 py-3 font-bold">{{$dataset->id}}</td>
                    <td class="px-4 py-3 font-bold">{{$dataset->vehicle_year}}</td>
                    <td class="px-4 py-3">{{$dataset->vehicle->name}} | {{$dataset->vehicle->code}}</td>
                    <td class="px-4 py-3">{{$dataset->type_data}}</td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <flux:button
                                variant="primary"
                                class="bg-cyan-500 hover:bg-cyan-600"
                                href="{{Storage::url($dataset->file_path)}}"
                                size="sm"
                                icon="arrow-down-tray"
                            >
                            </flux:button>
                            <form action="{{ route('datasets.restore', $dataset->id) }}" method="POST">
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

                            <form action="{{ route('datasets.destroy', $dataset->id) }}" method="POST">
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
