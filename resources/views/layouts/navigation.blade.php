<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>                
                    @hasrole('resident')   
                        @if (Auth::user()->email_verified_at != NULL)
                        <x-nav-link :href="route('request.index')" :active="request()->routeIs('request')">
                            {{ __('Request') }}
                        </x-nav-link>
                        <x-nav-link :href="route('status')" :active="request()->routeIs('status')">
                            {{ __('Status') }}
                        </x-nav-link>

                                            
                        @else
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('verify')">
                            {{ __('VERIFY YOUR ACCOUNT FIRST!!!') }}
                        </x-nav-link>                      
                        @endif
                    @endhasrole('resident')   
                    @hasrole('admin')
                    <x-nav-link :href="route('user.index')" :active="request()->routeIs('users')">
                    {{ __('Users') }}
                    </x-nav-link>
                    <x-nav-link :href="route('role.index')" :active="request()->routeIs('roles')">
                        {{ __('Roles') }}
                    </x-nav-link>
                    <x-nav-link :href="route('documentrequest.showReq')" :active="request()->routeIs('request')">
                        {{ __('Requests') }}
                    </x-nav-link>
                    @endhasrole

                    <x-nav-link :href="route('chatify')" :active="request()->routeIs('chatify')">
                        {{ __('Live Chat') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name ?? 'None' }} </div>
                            @if (Auth::user()->email_verified_at != NULL)
                            <x-verification-logo class="w-5 h-5 fill-current text-gray-500" />
                            @else
                            <a href="{{ url('/verify-email') }}" :active="request()->routeIs('verify-email')">
                                <x-unverified-logo class="w-5 h-5 fill-current text-gray-500" />
                            </a>
                            @endif
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @hasrole('resident')

            @if (Auth::user()->email_verified_at != NULL)
                <h1>VERIFY YOUR ACCOUNT FIRST</h1>
            @else
            
            @endif
            
            @endhasrole
            @hasrole('admin')
                    <x-responsive-nav-link :href="route('user.index')" :active="request()->routeIs('users')">
                    {{ __('Users') }}
                    </x-nav-link>
                    <x-responsive-nav-link :href="route('role.index')" :active="request()->routeIs('roles')">
                        {{ __('Roles') }}
                    </x-nav-link>
                    @endhasrole
            <x-responsive-nav-link :href="route('chatify')" :active="request()->routeIs('chatify')">
                {{ __('Live Chat') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name ?? 'None'}}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email ?? 'None' }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
