
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">
            {{ $subtitle }}
        </h6>
    </div>
    <ul class="list-group list-group-flush">
        @if (is_a($items, 'Illuminate\Support\Collection'))
            @forelse ($items as $item)
                <li class="list-group-item">
                    {{ $item }}
                </li>
            @empty
                <div class="list-group-item">{{ $else }}</div>
            @endforelse 
        @else
            {{ $items }}
        @endif                 
    </ul>