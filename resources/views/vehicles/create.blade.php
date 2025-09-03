<x-layouts.app :title="__('Agregar nuevo dealer')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="relative mb-6 w-full flex flex-row">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1">{{ __('Agregar nuevo vehículo')}}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('Completa toda la información del distribuidor') }}</flux:subheading>
                <flux:separator variant="subtle" />
            </div>
            <div class="basis-1/3 text-right">

            </div>
        </div>

        <form method="POST" action="{{route('vehicles.store')}}" enctype="multipart/form-data">
        @csrf
            <div class="flex flex-row gap-8">
                <div class="basis-2/3">
                    <div class="mb-5">
                        <flux:field>
                            <flux:label>Nombre del modelo (nombre comercial)</flux:label>
                            <flux:input type="text" name="name" value="{{old('name')}}" />
                            <flux:error name="name" />
                        </flux:field>
                    </div>
                    <div class="mb-5">
                        <flux:field>
                            <flux:label>Serie</flux:label>
                            <flux:select name="serie_id" placeholder="Seleccione la serie...">
                                @foreach ($series as $serie)
                                    @if ( old('serie_id') == $serie->id )
                                        <flux:select.option value="{{ old('serie_id')}}" selected>{{$serie->name}}</flux:select.option>
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
                            <flux:input type="text" name="code" value="{{old('code')}}" />
                            <flux:error name="code" />
                        </flux:field>
                    </div>
                </div>
                <div class="basis-1/3">
                    <div class="shadow-lg bg-gray-100 p-4 mb-5 rounded-lg">
                        <flux:icon.photo class="size-24 text-gray-200"/>
                        <flux:field>
                            <flux:label>Imagen</flux:label>
                            <flux:input type="file" name="image_path" accept="image/*" />
                            <flux:error name="image_path" />
                        </flux:field>
                    </div>
                </div>
            </div>
            <flux:button
                variant="primary"
                class="bg-cyan-500 hover:bg-cyan-600"
                type="submit">
                Agregar vehículo
            </flux:button>
        </form>

    </div>
</x-layouts.app>
