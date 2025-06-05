<x-layouts.app :title="__('Dealers')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative mb-6 w-full flex flex-row border-b border-gray-100">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1"><b>{{$vehicle->name}}</b> | {{$vehicle->year}}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{$vehicle->code}}</flux:subheading>
            </div>
            <div class="basis-1/3 text-right">
                <flux:button
                    href=""
                    icon:trailing="pencil"
                >
                    Editar vehículo
                </flux:button>
            </div>

        </div>

        <div class="p-4 mb-4 border border-gray-100 rounded-lg shadow-lg">
            <div class="flex items-center gap-2 text-gray-500">
                <flux:icon.puzzle-piece class="size-5" />
                <h2 class="text-lg font-bold uppercase"> Catálogo de partes</h2>
            </div>
            <flux:separator variant="subtle" class="my-4"/>
            <div class="flex">
                <div class="basis-2/3">
                    <a href="#" class="text-cyan-500 hover:text-cyan-600" target="blank">20250604-800mtx-catalogopartes.pdf</a>
                </div>
                <div class="basis-1/3">
                    <img src="{{Storage::url($vehicle->image_path)}}" class="mb-4" width="300">
                </div>
            </div>

        </div>

        <div class="p-4 mb-4 border border-gray-100 rounded-lg shadow-lg">
            <div class="flex items-center gap-2 text-gray-500">
                <flux:icon.exclamation-triangle class="size-5" />
                <h2 class="text-lg font-bold uppercase"> Alertas de seguridad</h2>
            </div>
            <flux:separator variant="subtle" class="my-4"/>
                <div class="border-b border-gray-50 pb-3 mb-3">
                    <flux:badge color="yellow" size="sm">22/10/2024</flux:badge> <a href="#" class="text-cyan-500 hover:text-cyan-600" target="blank">CF2024-003R - RH HANDLEBAR SWITCH ASSY REPLACEMENT</a>
                </div>
                <div class="border-b border-gray-50 pb-3 mb-3">
                    <flux:badge color="yellow" size="sm">22/10/2024</flux:badge> <a href="#" class="text-cyan-500 hover:text-cyan-600" target="blank">CF2024-003R - RH HANDLEBAR SWITCH ASSY REPLACEMENT</a>
                </div>
                <div class="border-b border-gray-50 pb-3 mb-3">
                    <flux:badge color="yellow" size="sm">22/10/2024</flux:badge> <a href="#" class="text-cyan-500 hover:text-cyan-600" target="blank">CF2024-003R - RH HANDLEBAR SWITCH ASSY REPLACEMENT</a>
                </div>
        </div>

    </div>
</x-layouts.app>
