@props(['type' => 'default', 'title', 'icon' => null, 'dismissible' => true])

@php
    $styles = [
        'default' => 'bg-gray-50 border border-gray-300',
        'info' => 'bg-gray-50 border border-blue-800',
        'success' => 'bg-gray-50 border border-gray-400',
        'warning' => 'bg-gray-50 border-l-4 border-gray-700',
        'error' => 'bg-gray-50 border border-gray-800',
    ];
    
    $headerBg = [
        'default' => 'bg-gradient-to-r from-gray-700 to-gray-900',
        'info' => 'bg-gradient-to-r from-blue-800 to-black',
        'success' => 'bg-gradient-to-r from-gray-600 to-gray-800',
        'warning' => 'bg-gradient-to-r from-gray-700 to-gray-900',
        'error' => 'bg-gradient-to-r from-gray-800 to-black',
    ];
    
    $iconSvg = $icon ?? match ($type) {
        'success' => '<svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>',
        'warning' => '<svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                      </svg>',
        'error' => '<svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>',
        'info' => '<svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                  </svg>',
        default => '<svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                   </svg>',
    };
@endphp

<div 
    x-data="{ show: true }" 
    x-show="show" 
    x-transition:enter="transform transition ease-in-out duration-500"
    x-transition:enter-start="translate-y-full opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transform transition ease-in-out duration-500"
    x-transition:leave-start="translate-y-0 opacity-100" 
    x-transition:leave-end="translate-y-full opacity-0"
    class="relative overflow-hidden rounded-lg {{ $styles[$type] }} shadow-md mb-6"
>
    <!-- Notification header -->
    <div class="{{ $headerBg[$type] }} p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <span class="flex-shrink-0">
                    {!! $iconSvg !!}
                </span>
                <h3 class="text-lg font-medium text-white">{{ $title }}</h3>
            </div>
            @if($dismissible)
                <button @click="show = false" class="text-white hover:text-gray-200 transition-colors">
                    <span class="sr-only">Fermer</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            @endif
        </div>
    </div>
    
    <!-- Notification content -->
    <div class="bg-white p-5">
        {{ $slot }}
    </div>
</div>
