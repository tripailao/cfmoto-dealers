<x-layouts.app :title="__('Usuarios')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative mb-6 w-full flex flex-row border-b border-gray-100">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1">{{ __('Usuarios')}}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('Listado de usuarios') }}</flux:subheading>
            </div>
            <div class="basis-1/3 text-right">
                @if ( auth()->user()->hasanyrole('super-admin|admin'))
                <flux:button
                    href="{{route('users.create')}}"
                    icon:trailing="plus-circle"
                >
                    Nuevo usuario
                </flux:button>
                @endif
            </div>
        </div>

        <div class="border border-gray-100 rounded-lg shadow-xl">
            <div class="flex flex-row text-xs text-gray-700 uppercase bg-gray-50 p-4">
                <div class="basis-4/12">
                    Nombre
                </div>
                <div class="basis-3/12">
                    Email
                </div>
                <div class="basis-2/12">
                    Rol
                </div>
                <div class="basis-2/12">
                    Estado
                </div>
                <div class="basis-1/12">
                    Acción
                </div>
            </div>

            @foreach ($users as $user)
            <div class="flex flex-row p-3">
                <div class="basis-4/12">
                    {{$user->name}} {{$user->lastname}}
                </div>
                <div class="basis-3/12">
                    {{$user->email}}
                </div>
                <div class="basis-2/12 uppercase">
                    @foreach ($user->roles as $role)
                        <flux:badge color="cyan" class="text-xs">
                            {{ $role->name }}
                        </flux:badge>
                    @endforeach
                </div>
                <div class="basis-2/12 uppercase">
                    @if ( '{{$user->status}} == 1' )
                        <flux:badge color="lime" class="text-xs">Activo</flux:badge>
                        @else
                        <flux:badge color="red" class="text-xs">Inactivo</flux:badge>
                    @endif
                </div>
                <div class="basis-1/12">
                    <flux:button
                        href="{{route('users.edit', $user->id)}}"
                        size="sm"
                        icon:trailing="pencil-square"
                    >
                        Editar
                    </flux:button>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</x-layouts.app>
