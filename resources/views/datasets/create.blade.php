<x-layouts.app :title="__('Agregar nuevo catalogo de partes')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="relative mb-6 w-full flex flex-row">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1">{{ __('Agregar nuevo documento')}}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('Publica un nuevo archivo') }}</flux:subheading>
                <flux:separator variant="subtle" />
            </div>
            <div class="basis-1/3 text-right">
                {{-- Intencionalmente dejado en blanco --}}
            </div>
        </div>

        <form method="POST" action="{{route('datasets.store')}}" enctype="multipart/form-data">
        @csrf
            <div class="mb-5">
                <flux:field>
                    <flux:label>Tipo de documento</flux:label>
                    <flux:select name="type_data" placeholder="Tipo de documento">
                        <flux:select.option value="Engine Data">Engine Data</flux:select.option>
                        <flux:select.option value="Vehicle Data">Vehicle Data</flux:select.option>
                        <flux:select.option value="Service Manual">Service Manual</flux:select.option>
                    </flux:select>
                    <flux:error name="type_data" />
                </flux:field>
            </div>
            <div class="mb-5">
                <flux:field>
                    <flux:label>Vehículo</flux:label>
                    <flux:select name="vehicle_id" placeholder="Seleccione el vehículo...">
                        @foreach ($vehicles as $vehicle)
                            @if ( old('vehicle_id') == $vehicle->id )
                                <flux:select.option value="{{ old('vehicle_id')}}" selected>{{$vehicle->name}} - {{$vehicle->code}}</flux:select.option>
                            @else
                                <flux:select.option value="{{ $vehicle->id }}">{{$vehicle->name}} - {{$vehicle->code}}</flux:select.option>
                            @endif)
                        @endforeach
                    </flux:select>
                    <flux:error name="vehicle_id" />
                </flux:field>
            </div>
            <div class="mb-5">
                <flux:field>
                    <flux:label>Año</flux:label>
                    <flux:input type="number" name="vehicle_year" value="{{old('vehicle_year')}}" />
                    <flux:error name="vehicle_year" />
                </flux:field>
            </div>

            <div class="mb-5">
                <flux:field>
                    <flux:label>Archivo</flux:label>
                    <flux:input type="file" name="file_path" value="{{old('file_path')}}" />
                    <flux:error name="file_path" />
                </flux:field>
            </div>

            <flux:button
                variant="primary"
                class="bg-cyan-500 hover:bg-cyan-600"
                type="submit">
                Agregar nuevo catálogo
            </flux:button>
        </form>

    </div>
</x-layouts.app>
