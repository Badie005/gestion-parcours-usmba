@if (session('success'))
    <x-notification type="success" :message="session('success')" />
@endif

@if (session('error'))
    <x-notification type="error" :message="session('error')" />
@endif

@if (session('warning'))
    <x-notification type="warning" :message="session('warning')" />
@endif

@if (session('eligibility_warning'))
    <x-notification type="warning" :message="session('eligibility_warning')" :autoDismiss="false" />
@endif

@if (session('info'))
    <x-notification type="info" :message="session('info')" />
@endif

@if ($errors->any())
    <x-notification type="error" message="Des erreurs sont survenues:">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-notification>
@endif
