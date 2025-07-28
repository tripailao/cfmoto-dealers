<x-layouts.app :title="__('Editar usuario')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative mb-6 w-full flex flex-row border-b border-gray-100">
            <div class="basis-2/3">
                <flux:heading size="xl" level="1">{{ __('Editar usuario')}}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('Modifica la información de un usuario') }}</flux:subheading>
            </div>
            <div class="basis-1/3 text-right">
                {{-- Intencionalmente dejado en blanco --}}
            </div>
        </div>

        <form action="{{route('users.update', $user)}}" method="POST" >
        @csrf
        @method('PUT')
        @csrf
            <div class="mb-5">
                <flux:field>
                    <flux:label>Nombre</flux:label>
                    <flux:input type="text" name="name" value="{{old('name', $user->name)}}" />
                    <flux:error name="name" />
                </flux:field>
            </div>
            <div class="mb-5">
               <flux:field>
                    <flux:label>Apellido</flux:label>
                    <flux:input type="text" name="lastname" value="{{old('lastname', $user->lastname)}}" />
                    <flux:error name="lastname" />
                </flux:field>
            </div>
            <div class="mb-5">
                <flux:field>
                    <flux:label>Correo electrónico</flux:label>
                    <flux:input type="email" name="email" value="{{old('email', $user->email)}}" />
                    <flux:error name="email" />
                </flux:field>
            </div>
            <div class="mb-5">
                <flux:field>
                    <flux:label>Contraseña</flux:label>
                    <flux:input type="password" name="password" value="{{old('password', $user->password)}}" />
                    <flux:error name="password" />
                </flux:field>
            </div>

            <div class="mb-5">
                <flux:field>
                    <flux:label>Asociar a dealer o servicio</flux:label>
                    <flux:select name="dealer_id" placeholder="Seleccione un dealer o servicio...">
                        @foreach ($dealers as $dealer)
                            @if ( old('dealer_id', $user->dealer_id ) ==  $dealer->id)
                                <flux:select.option value="{{ old('dealer_id', $user->dealer_id)}}" selected>{{$dealer->name}}</flux:select.option>
                            @else
                                <flux:select.option value="{{ $dealer->id }}">{{$dealer->name}}</flux:select.option>
                            @endif)
                        @endforeach
                    </flux:select>
                    <flux:error name="dealer_id" />
                </flux:field>
            </div>

            <div class="mb-5">
                <flux:field>
                    <flux:label>Rol de usuario</flux:label>
                    <flux:select name="role" placeholder="Seleccione un rol...">
                        @foreach ($roles as $role)
                            @if ( $user->hasRole($role->name) == $role->name )
                                <flux:select.option value="{{ $role->name }}" selected>{{$role->name}}</flux:select.option>
                            @else
                                <flux:select.option value="{{ $role->name }}">{{$role->name}}</flux:select.option>
                            @endif)
                        @endforeach
                    </flux:select>
                    <flux:error name="role" />
                </flux:field>
            </div>

            <flux:button
                variant="primary"
                class="bg-cyan-500 hover:bg-cyan-600"
                type="submit">
                Actualizar usuario
            </flux:button>
        </form>

    </div>
</x-layouts.app>
