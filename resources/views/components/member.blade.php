@props([
    'title' => 'A member page',
    'wrapped' => false,
    'bgImagePath' => false,
    'jsResources' => null,
    'cssResources' => null,
    'bootstrapWrapped' => false,
])
<x-layout 
    :title="$title" 
    :wrapped="$wrapped" 
    :bgImagePath="$bgImagePath" 
    :jsResources="$jsResources"
    :cssResources="$cssResources"
    :bootstrapWrapped="$bootstrapWrapped"
>
    {{ $slot }}
</x-layout>
<x-backBtn />
