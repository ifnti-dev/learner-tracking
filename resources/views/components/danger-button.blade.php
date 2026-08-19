<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-red-500 shadow-theme-xs hover:bg-red-600']) }}>
    {{ $slot }}
</button>
