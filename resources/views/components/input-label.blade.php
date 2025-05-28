<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1" for="{{ $name }}">
        {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}
        class="w-full border rounded px-3 py-2 text-sm @error($name) border-red-500 @enderror"
    >
    @error($name)
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>