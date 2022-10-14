<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- documentoUsuario -->
            <div>
                <x-label for="documentoUsuario" :value="__('Documento')" />
                <x-input id="documentoUsuario" class="block mt-1 w-full" type="text" name="documentoUsuario" :value="old('documentoUsuario')" required autofocus />
            </div>
            <!-- Name -->
            <div class="mt-4">
                <x-label for="name" :value="__('Nombres')" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>
            <!-- LastName -->
            <div class="mt-4">
                <x-label for="name" :value="__('Apellidos')" />
                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>
            
            <!-- tipoUsuario -->
            <div class="mt-4">
                <x-label for="tipoUsuario" :value="__('Tipo de Usuario')" />
                <select id="tipoUsuario" class="block mt-1 w-full" name="tipoUsuario" :value="old('tipoUsuario')" required autofocus>
                    <option value="" disabled selected>selección...</option>
                    <option value="1">Admin</option>
                    <option value="2">Entrega</option>
                </select>
            </div>

            <!-- estadoUsuario -->
            <div class="mt-4">
                <x-label for="estadoUsuario" :value="__('Estado de Usuario')" />
                <select id="estadoUsuario" class="block mt-1 w-full" name="estadoUsuario" :value="old('estadoUsuario')" required autofocus>
                    <option value="" disabled selected>selección...</option>
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                </select>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
