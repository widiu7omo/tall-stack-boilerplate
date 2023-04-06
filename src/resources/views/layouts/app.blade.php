@props(["title"=> '-'])
<x-layouts.base :title="$title">
    {{--    Top bar--}}
    {{--    Content Slot--}}
    {{$slot}}
    {{--    Footer--}}
</x-layouts.base>
