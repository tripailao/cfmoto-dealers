<x-layouts.app :title="__('Agregar nuevo dealer')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="relative mb-6 w-full flex flex-row">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1">{{ __('Agregar nuevo dealer')}}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('Completa toda la información del distribuidor') }}</flux:subheading>
                <flux:separator variant="subtle" />
            </div>
            <div class="basis-1/3 text-right">

            </div>
        </div>

        <form method="POST" action="{{route('dealers.store')}}">
        @csrf
            <div class="mb-5">
                <flux:field>
                    <flux:label>Nombre del dealer</flux:label>
                    <flux:input type="text" name="name" value="{{old('name')}}" />
                    <flux:error name="name" />
                </flux:field>
            </div>
            <div class="mb-5">
                <flux:field>
                    <flux:label>Dirección</flux:label>
                    <flux:input type="text" name="address" value="{{old('address')}}" />
                    <flux:error name="address" />
                </flux:field>
            </div>
            <div class="mb-5">
                <flux:field>
                    <flux:label>Ciudad o comuna</flux:label>
                    <flux:input type="text" name="city" value="{{old('city')}}" />
                    <flux:error name="city" />
                </flux:field>
            </div>
            <div class="mb-5">
                <flux:field>
                    <flux:label>Teléfono</flux:label>
                    <flux:input type="tel" name="phone" value="{{old('phone')}}" />
                    <flux:error name="phone" />
                </flux:field>
            </div>

            <flux:button variant="primary" type="submit">Agregar dealer</flux:button>
        </form>

    </div>
</x-layouts.app>
