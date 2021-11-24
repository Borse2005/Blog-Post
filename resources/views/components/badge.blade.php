@if (!isset($show) || $show)
    <br><span class="font-weight-bold ml-3">
        Types : 
    </span>
    <span class="badge badge-{{ $type ?? 'success'}} " >
        {{ $slot }}
    </span>
@endif