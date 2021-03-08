<x-guest-layout>
    <x-auth-card>
        <a href="/dashboard">back</a>

        <div class="container text-center">
            <h2 style="font-weight: bold">Create New User</h2>
        </div>
        <x-slot name="logo">
            <a href="/">
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="/dashboard/create-user">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <div>
                <x-label for="surname" :value="__('Surname')" />

                <x-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required/>
            </div>

            <div>
                <x-label for="age" :value="__('Date of Birth')" />

                <x-input id="age" class="block mt-1 w-full" type="date" name="age" :value="old('age')" required/>
            </div>

            <div>
                <x-label for="gender" :value="__('Gender')" />
                <select class="form-select mt-1 block w-full" name="gender">
                    <option value="" selected disabled></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
            </div>

            <div>
                <x-label for="role" :value="__('Role')" />
                <select class="form-select mt-1 block w-full" name="role_id">
                    <option value="" selected disabled></option>
                    <option value="{{$roles[0]->id}}">{{$roles[0]->role}}</option> 
                    <option value="{{$roles[1]->id}}">{{$roles[1]->role}}</option> 

                  </select>
            </div>

            <div>
                <x-label for="mobile" :value="__('Mobile')" />

                <x-input id="mobile" class="block mt-1 w-full" type="number" min=71000001 max=78999999 name="mobile" :value="old('mobile')" required/>
            </div>
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
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
            

                <x-button class="ml-4">
                    {{ __('Create User') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
