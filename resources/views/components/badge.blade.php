@if (!isset($show) || $show)
    <span class="font-weight-bold ">
        Types : 
    </span>
    <span class="badge badge-{{ $type ?? 'success'}} " >
        {{ $slot }}
    </span>
@endif