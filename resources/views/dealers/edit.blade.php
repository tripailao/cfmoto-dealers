<x-layouts.app :title="__('Agregar nuevo dealer')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="relative mb-6 w-full flex flex-row">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1">{{ __('Editar dealer')}}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('Modifica la información del distribuidor') }}</flux:subheading>
                <flux:separator variant="subtle" />
            </div>
            <div class="basis-1/3 text-right">

            </div>
        </div>

        <form action="{{route('dealers.update', $dealer)}}" method="POST">
        @csrf
        @method('PUT')
            <div class="mb-5">
                <flux:field>
                    <flux:label>Nombre del dealer</flux:label>
                    <flux:input type="text" name="name" value="{{old('name', $dealer->name)}}" />
                    <flux:error name="name" />
                </flux:field>
            </div>
            <div class="mb-5">
                <flux:field>
                    <flux:label>Dirección</flux:label>
                    <flux:input type="text" name="address" value="{{old('address', $dealer->address)}}" />
                    <flux:error name="address" />
                </flux:field>
            </div>
            <div class="mb-5">
                <flux:field>
                    <flux:label>Ciudad o comuna</flux:label>
                    <flux:input type="text" name="city" value="{{old('city', $dealer->city)}}" />
                    <flux:error name="city" />
                </flux:field>
            </div>
            <div class="mb-5">
                <flux:field>
                    <flux:label>Teléfono</flux:label>
                    <flux:input type="tel" name="phone" value="{{old('phone', $dealer->phone)}}" />
                    <flux:error name="phone" />
                </flux:field>
            </div>
            <flux:button variant="primary" type="submit">Guardar cambios</flux:button>
        </form>

    </div>
</x-layouts.app>
