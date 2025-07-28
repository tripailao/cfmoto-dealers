<x-layouts.app :title="__('Usuarios')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative w-full flex flex-row">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1">{{ __('Usuarios')}}</flux:heading>
                <flux:subheading size="lg">{{ __('Listado de usuarios') }}</flux:subheading>
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
        <div class="my-3">
            <flux:separator variant="subtle" />
        </div>

        <div class="border border-gray-100 rounded-lg shadow-xl">
            <div class="flex flex-row text-xs text-gray-700 uppercase bg-gray-50 p-4 font-black">
                <div class="basis-4/12">
                    Nombre
                </div>
                <div class="basis-3/12">
                    Email
                </div>
                <div class="basis-4/12">
                    Dealer o Servicio
                </div>
                <div class="basis-2/12">
                    Acción
                </div>
            </div>

            @foreach ($users as $user)
            <div class="flex flex-row p-3">
                <div class="basis-4/12">
                    {{$user->name}} {{$user->lastname}}
                    @foreach ($user->roles as $role)
                        <flux:badge color="cyan" class="text-xs uppercase">
                            {{ $role->name }}
                        </flux:badge>
                    @endforeach
                </div>
                <div class="basis-3/12">
                    {{$user->email}}
                </div>
                <div class="basis-4/12 ">
                    {{$user->dealer->name}}
                </div>
                <div class="basis-2/12 flex flex-row gap-2">
                    <flux:button
                        href="{{route('users.edit', $user->id)}}"
                        variant="primary"
                        class="bg-cyan-500 hover:bg-cyan-600"
                        size="sm"
                        icon:trailing="pencil-square"
                    >
                        Editar
                    </flux:button>
                    <form id="delete-user-{{$user->id}}" action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <flux:button
                            as="button"
                            type="button"
                            data-id="{{ $user->id }}"
                            data-title="Confirmación"
                            data-text="¿Desea eliminar completamente al usuario de la base de datos y perder la información asociada a él?"
                            data-confbtntxt="Si, eliminar"
                            variant="primary"
                            class="btn-delete border-red-600 bg-red-500 hover:bg-red-600"
                            icon="x-mark"
                            size="sm">
                        </flux:button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</x-layouts.app>
