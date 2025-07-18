@props([
    'name',
    'label',
    'id' => null,
    'required' => false,
])

<div {{ $attributes->except('class') }}>
    <x-input-label :for="$id ?? $name">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </x-input-label>

    <input
        type="file"
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        {{ $required ? 'required' : '' }}
        class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-800 focus:outline-none file:bg-gray-200 file:dark:bg-gray-700 file:text-gray-800 file:dark:text-gray-200 file:border-0 file:py-2 file:px-4 file:mr-4"
    />

    @if (isset($slot) && !$slot->isEmpty())
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400" id="{{ $name }}-help">
            {{ $slot }}
        </p>
    @endif

    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>