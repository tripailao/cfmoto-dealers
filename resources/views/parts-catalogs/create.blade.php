<x-layouts.app :title="__('Agregar nuevo catalogo de partes')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="relative mb-6 w-full flex flex-row">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1">{{ __('Agregar nuevo catálogo')}}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('Publica un nuevo catálogo de partes') }}</flux:subheading>
                <flux:separator variant="subtle" />
            </div>
            <div class="basis-1/3 text-right">

            </div>
        </div>

        <form method="POST" action="{{route('parts-catalogs.store')}}" enctype="multipart/form-data">
        @csrf
            <div class="mb-5">
                <flux:field>
                    <flux:label>Titulo</flux:label>
                    <flux:input type="text" name="title" value="{{old('title')}}" />
                    <flux:error name="title" />
                </flux:field>
            </div>
            <div class="mb-5">
                <flux:field>
                    <flux:label>Descripción</flux:label>
                    <flux:input type="text" name="description" value="{{old('description')}}" />
                    <flux:error name="description" />
                </flux:field>
            </div>
            <div class="mb-5">
                <flux:field>
                    <flux:label>Vehículo</flux:label>
                    <flux:select name="vehicle_id" placeholder="Seleccione la serie...">
                        @foreach ($vehicles as $vehicle)
                            @if ( old('vehicle_id') == $vehicle->id )
                                <flux:select.option value="{{ old('vehicle_id')}}" selected>{{$vehicle->name}}</flux:select.option>
                            @else
                                <flux:select.option value="{{ $vehicle->id }}">{{$vehicle->name}}</flux:select.option>
                            @endif)
                        @endforeach
                    </flux:select>
                    <flux:error name="vehicle_id" />
                </flux:field>
            </div>
            <div class="mb-5">
                <flux:field>
                    <flux:label>Archivo</flux:label>
                    <flux:input type="file" name="file" value="{{old('file')}}" />
                    <flux:error name="file" />
                </flux:field>
            </div>

            <flux:button variant="primary" type="submit">Agregar nuevo catálogo</flux:button>
        </form>

    </div>
</x-layouts.app>
