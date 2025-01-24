<!-- Example usage in a Blade view -->
@if(session('error'))
    <x-alert-error :message="session('error')" class="mb-4" />
@endif

<!-- Example usage in a Blade view -->
@if(session('success'))
    <x-alert-success :message="session('success')" class="mb-4" />
@endif

<!-- Example usage in a form -->
@if($errors->any())
    <x-alert-error :message="$errors->first()" class="mb-4" />
@endif
