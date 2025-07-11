<x-layouts.app :title="__('Dealers')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative mb-6 w-full flex flex-row border-b border-gray-100">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1">Editar {{$vehicle->name}} | {{$vehicle->code}}</flux:heading>
                <flux:subheading size="lg" class="mb-6">Modifica la información del vehículo</flux:subheading>
            </div>
            <div class="basis-1/3 text-right">
            </div>
        </div>

        <form action="{{route('vehicles.update', $vehicle)}}" method="POST" >
        @csrf
        @method('PUT')
        <div class="flex flex-row gap-8">
            <div class="basis-2/3">
                <div class="mb-5">
                    <flux:field>
                        <flux:label>Nombre del modelo (nombre comercial)</flux:label>
                        <flux:input type="text" name="name" value="{{old('name', $vehicle->name)}}" />
                        <flux:error name="name" />
                    </flux:field>
                </div>
                <div class="mb-5">
                    <flux:field>
                        <flux:label>Serie</flux:label>
                        <flux:select name="serie_id" placeholder="Seleccione la serie...">
                            @foreach ($series as $serie)
                                @if ( old('serie_id', $vehicle->serie_id) == $serie->id )
                                    <flux:select.option value="{{ old('serie_id', $vehicle->serie_id)}}" selected>{{$serie->name}}</flux:select.option>
                                @else
                                    <flux:select.option value="{{ $serie->id }}">{{$serie->name}}</flux:select.option>
                                @endif)
                            @endforeach
                        </flux:select>
                        <flux:error name="serie_id" />
                    </flux:field>
                </div>
                <div class="mb-5">
                    <flux:field>
                        <flux:label>Código</flux:label>
                        <flux:input type="text" name="code" value="{{old('code', $vehicle->code)}}" />
                        <flux:error name="code" />
                    </flux:field>
                </div>
                {{-- <div class="mb-5">
                    <flux:field>
                        <flux:label>Año</flux:label>
                        <flux:input type="number" name="year" value="{{old('year', $vehicle->year)}}" />
                        <flux:error name="year" />
                    </flux:field>
                </div> --}}
            </div>

            <div class="basis-1/3">
                <div class="shadow-lg bg-gray-100 p-4 mb-5 rounded-lg">
                    <flux:field>
                        <flux:label>Imagen</flux:label>
                        @if(Storage::disk('hidden')->exists($vehicle->image_path))
                            <img src="{{Storage::url($vehicle->image_path)}}" class="mb-4" width="200">
                        @endif
                        <flux:input type="file" name="image" accept="image/*" />
                        <flux:error name="image" />
                    </flux:field>
                </div>
            </div>
        </div>
        <flux:button variant="primary" type="submit">Guardar cambios</flux:button>
        </form>

    </div>
</x-layouts.app>
