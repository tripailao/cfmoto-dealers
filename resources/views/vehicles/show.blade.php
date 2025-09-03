<x-layouts.app :title="__('Dealers')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative mb-6 w-full flex flex-row border-b border-gray-100">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1"><b>{{$vehicle->name}}</b></flux:heading>
                <flux:subheading size="lg" class="mb-6">{{$vehicle->code}}</flux:subheading>
            </div>
            <div class="basis-1/3 text-right">
                @if ( auth()->user()->hasanyrole('super-admin|admin'))
                <flux:button
                    href="{{route('vehicles.edit', $vehicle->id)}}"
                    icon:trailing="pencil"
                >
                    Editar vehículo
                </flux:button>
                @endif
            </div>

        </div>

        <div class="p-4 mb-4 border border-gray-100 rounded-lg shadow-lg">

            <div class="flex">
                <div class="basis-4/6">
                    <div class="flex items-center gap-2 text-gray-500">
                        <flux:icon.puzzle-piece class="size-5" />
                        <h2 class="text-lg font-bold uppercase"> Catálogos de partes</h2>
                    </div>
                    <flux:separator variant="subtle" class="my-4"/>

                    @forelse ($collected_engineData as $enginedata => $items)
                        <h3 class="text-lg font-bold mb-2">{{$enginedata}}</h3>
                            @foreach ($items as $item)
                                <flux:button
                                    icon="arrow-down-tray"
                                    variant="primary"
                                    class="bg-cyan-500 hover:bg-cyan-600"
                                    href="{{Storage::url($item->file_path)}}"
                                >
                                    {{$item->type_data}} (id: {{$item->id}})
                                </flux:button>
                            @endforeach
                        <hr class="my-4">
                    @empty
                         <div class="flex items-center gap-2 text-sm uppercase text-red-400">
                            <flux:icon.no-symbol/> Información no disponible
                         </div>
                    @endforelse


                    <hr class="my-6 border-transparent">
                    <div class="flex items-center gap-2 text-gray-500">
                        <flux:icon.wrench class="size-5" />
                        <h2 class="text-lg font-bold uppercase"> Manual de servicio</h2>
                    </div>
                    <flux:separator variant="subtle" class="my-4"/>
                    @forelse ($service_manuals as $service_manual)
                        <flux:button
                            icon="arrow-down-tray"
                            variant="primary"
                            class="bg-cyan-500 hover:bg-cyan-600"
                            href="{{Storage::url($service_manual->file_path)}}"
                        >
                            Service Manual
                        </flux:button>
                    @empty
                        <div class="flex items-center gap-2 text-sm uppercase text-red-400">
                            <flux:icon.no-symbol/> Información no disponible
                         </div>
                    @endforelse

                    {{-- @if(Storage::disk('hidden')->exists($vehicle))
                        <flux:button
                            icon="arrow-down-tray"
                            size="sm"
                            variant="primary"
                            href="{{Storage::url($vehicle->servicemanual_path)}}"
                        >
                        Manual de servicio</flux:button>
                    @else
                    <div class="flex items-center gap-2 text-sm uppercase text-red-400">
                        <flux:icon.no-symbol/> No disponible
                    </div>
                    @endif --}}


                </div>
                <div class="basis-2/6">
                    <img src="{{Storage::url($vehicle->image_path)}}" class="mx-auto text-center" width="350">
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
