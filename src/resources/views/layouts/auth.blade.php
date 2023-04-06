@props(['title'=>'-','state'=>'login'])
<x-layouts.base :title="$title">
    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">

        {{$slot}}
    </div>
</x-layouts.base>
