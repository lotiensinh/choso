<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1" for="{{ $name }}">
        {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="6"
        {{ $required ? 'required' : '' }}
        class="w-full border rounded px-3 py-2 text-sm @error($name) border-red-500 @enderror"
    >{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>