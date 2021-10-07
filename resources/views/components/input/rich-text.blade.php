@props(['initialValue' => ''])
<div
    {{ $attributes->whereDoesntStartWith('wire:model') }}
    wire:ignore
    x-data="{
        value : @entangle( $attributes->wire('model') ),
        isNotFocused() {return document.activeElement !== this.$refs.trix},
        setValue() {this.$refs.trix.editor.loadHTML(this.value)}
    }"
    x-init="setValue(); $watch('value', () => isNotFocused() && setValue())"
    x-on:trix-change="value = $event.target.value"
    class="rounded-md shadow-sm"
>
    <input id="x" x-bind:value="value" type="hidden">
    <trix-editor x-ref="trix" input="x" class="shadow-sm block w-full bg-white focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md"></trix-editor>
</div>
@once
    @push('styles')
        <link rel="stylesheet" type="text/css" href="https://www.unpkg.com/trix@1.3.1/dist/trix.css">
    @endpush

    @push('scripts')
        <script src="https://www.unpkg.com/trix@1.3.1/dist/trix.js"></script>
    @endpush

@endonce
