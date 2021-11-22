<span class="pl-3">
    {{ empty(trim($slot)) ? 'Added' : $slot}} {{ $date->diffForHumans() }}  
    @if (isset($name))
    by {{ $name }}
    @endif
</span>