<x-guest-layout>
    <section class="relative bg-gray-900 dark:bg-gray-900 overflow-hidden">

        @include('components.bg-images')

        <div class="relative z-40 flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div class="w-full bg-opacity-90 backdrop-blur-md bg-gray-50 rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700 items-center justify-center">
                <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-white-900 dark:text-white place-content-center">
                    <x-application-logo-login class="block h-[193px] w-auto"/>
                </a>
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        {{__('Create an account')}}
                    </h1>

                    <form method="POST" class="space-y-4 md:space-y-6" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name">{{__('Name')}}</label>
                            <x-text-input type="text" name="name" :value="old('name')" id="name"
                                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                          placeholder="Jon" required autocomplete="given-name"/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Surname -->
                        <div>
                            <label for="surname">{{ __('Surname') }}</label>
                            <x-text-input type="text" name="surname" :value="old('surname')" id="surname"
                                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                          placeholder="Doe" required autocomplete="family-name"/>
                            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email">Your email</label>
                            <x-text-input type="email" name="email" :value="old('email')" id="email"
                                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                          placeholder="name@company.com" required autocomplete="email"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Profile Picture -->
                        <div>
                            <label for="profile_picture">{{ __('Upload profile picture') }}</label>
                            <input id="profile_picture" name="profile_picture" type="file" accept="image/*"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                            <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description">{{ __('Short description') }}</label>
                            <textarea id="description" name="description" rows="3"
                                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                      placeholder="Tell us something about yourself...">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password">{{__('Password')}}</label>
                            <x-text-input type="password" id="password" name="password" required autocomplete="new-password"
                                          placeholder="••••••••"
                                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation">{{__('Confirm password')}}</label>
                            <x-text-input type="password" name="password_confirmation" id="password_confirmation"
                                          placeholder="••••••••"
                                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required autocomplete="new-password"/>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <x-primary-button class="ms-4 w-full">
                            {{ __('Register') }}
                        </x-primary-button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
