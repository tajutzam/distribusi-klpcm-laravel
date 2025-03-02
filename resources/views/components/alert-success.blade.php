<!-- resources/views/components/alert-success.blade.php -->
@props(['message'])

<div {{ $attributes->merge(['class' => 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative']) }} role="alert">
    <span class="block sm:inline">{{ $message }}</span>
</div>
