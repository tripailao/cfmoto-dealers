@php
    $groups = [
        'Partes' => [
            [
                'name' => 'Dashboard',
                'icon' => 'home',
                'url' => route('dashboard'),
                'current' => request()->routeIs('dashboard'),
            ],
            // [
            //     'name' => 'Catalogo',
            //     'icon' => 'book-open',
            //     'url' => '',
            //     'current' => request()->routeIs(''),
            // ],
        ]
    ]
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="darkk">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.item icon="home" href="{{route('dashboard')}}" :current="request()->routeIs('dashboard')">Inicio</flux:navlist.item>
                <flux:navlist.item icon="circle-stack" href="{{route('vehicles.index')}}" :current="request()->routeIs('vehicles.*')">Vehículos</flux:navlist.item>

                @if ( auth()->user()->hasanyrole('super-admin|admin'))

                @endif
                <flux:navlist.item icon="exclamation-triangle" href="{{route('dealers.index')}}">Alertas de Seguridad</flux:navlist.item>
                <flux:navlist.item icon="book-open" href="{{route('datasets.index')}}">Datasets</flux:navlist.item>
                {{-- <flux:navlist.item icon="wrench" href="#">Manuales de Servicio</flux:navlist.item> --}}
                <flux:navlist.item icon="lifebuoy" href="#">Activación de garantía</flux:navlist.item>

                {{-- @foreach ( $groups as $group => $links)
                <flux:navlist.group :heading="$group" class="grid">
                    @foreach ($links as $link)
                    <flux:navlist.item :icon="$link['icon']" :href="$link['url']" :current="$link['current']" wire:navigate>{{$link['name']}}</flux:navlist.item>
                    @endforeach
                </flux:navlist.group>
                @endforeach--}}
                {{-- <flux:navlist.group expandable :expanded="false" heading="Partes" class="lg:grid">
                    <flux:navlist.item href="#">NK</flux:navlist.item>
                    <flux:navlist.item href="#">SR</flux:navlist.item>
                    <flux:navlist.item href="#">MT</flux:navlist.item>
                    <flux:navlist.item href="#">CL</flux:navlist.item>
                    <flux:navlist.item href="#">CFORCE</flux:navlist.item>
                    <flux:navlist.item href="#">UFORCE</flux:navlist.item>
                    <flux:navlist.item href="#">ZFORCE</flux:navlist.item>
                    <flux:navlist.item href="#">YOUTH</flux:navlist.item>
                    <flux:navlist.item href="#">GOES</flux:navlist.item>
                </flux:navlist.group> --}}
            </flux:navlist>
            <flux:spacer />

            <flux:navlist variant="outline">
                @if ( auth()->user()->hasanyrole('super-admin|admin'))
                <flux:navlist.group heading="Administración" class="mt-4">
                    <flux:navlist.item icon="users" href="{{route('users.index')}}">
                        {{ __('Usuarios') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="building-storefront" href="{{route('dealers.index')}}">
                        {{ __('Dealers') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="key" href="#">
                        {{ __('Configuración') }}
                    </flux:navlist.item>
                </flux:navlist.group>
                @endif

                {{-- <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits" target="_blank">
                {{ __('Documentation') }}
                </flux:navlist.item> --}}
            </flux:navlist>

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Configuración') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Cerrar sesión') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
