<span class="pl-3">
    {{ empty(trim($slot)) ? 'Added' : $slot}} {{ $date->diffForHumans() }}  
    @if (isset($name))
    by @if (isset($link))
        <a href="{{ route('user.show',$link )}}">{{ $name }}</a>
    @else
        {{ $name }}
    @endif
    @endif
</span>