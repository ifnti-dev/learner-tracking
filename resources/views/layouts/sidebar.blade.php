<aside
  :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
  class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-gray-900 lg:static lg:translate-x-0"
>
    <!-- SIDEBAR HEADER -->
    <div
        :class="sidebarToggle ? 'justify-center' : 'justify-between'"
        class="sidebar-header flex items-center gap-2 pb-7 pt-8"
    >
        <a href="{{ route('dashboard') }}">
            <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                <img class="dark:hidden" src="{{ asset('images/logo/logo.svg') }}" alt="Logo" />
                <img class="hidden dark:block" src="{{ asset('images/logo/logo-dark.svg') }}" alt="Logo" />
            </span>

            <img
                class="logo-icon"
                :class="sidebarToggle ? 'lg:block' : 'hidden'"
                src="{{ asset('images/logo/logo-icon.svg') }}"
                alt="Logo"
            />
        </a>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <!-- Ici tu mettras le menu -->
    </div>
</aside>