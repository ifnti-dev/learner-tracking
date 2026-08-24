@props(['class' => ''])

<fieldset {{ $attributes->merge(['class' => 'relative rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900 ' . $class]) }}>
    {{ $slot }}
</fieldset>
