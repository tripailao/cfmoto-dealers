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
                <th class="p-4">Titulo</th>
                <th class="p-4">Descripción</th>
                <th class="p-4">Modelo</th>
                <th class="p-4">Archivo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datasets as $dataset)
                <tr>
                    <td class="px-4 py-3 font-bold">{{$dataset->vehicle_year}}</td>
                    <td class="px-4 py-3">{{$dataset->type_data}}</td>
                    <td class="px-4 py-3">{{$dataset->vehicle->name}} ({{$dataset->vehicle->code}})</td>
                    <td class="px-4 py-3"><a href="{{Storage::url($dataset->file_path)}}" target="blank">Descargar archivo</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>

    </div>
</x-layouts.app>
