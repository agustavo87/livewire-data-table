@props(['initialValue' => ''])
<div
    {{ $attributes }}
    wire:ignore
    x-data
    @trix-blur="$dispatch('change', $event.target.value)"
    class="rounded-md shadow-sm"
>
    <input id="x" value="{{ $initialValue }}" type="hidden">
    <trix-editor input="x" class="shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md"></trix-editor>
</div>
@once
    @push('styles')
        <link rel="stylesheet" type="text/css" href="https://www.unpkg.com/trix@1.3.1/dist/trix.css">
    @endpush

    @push('scripts')
        <script src="https://www.unpkg.com/trix@1.3.1/dist/trix.js"></script>
    @endpush

@endonce
