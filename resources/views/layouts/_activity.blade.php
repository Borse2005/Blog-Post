<div class="card" style="width: 18rem;">
    @component('components.card',['title' => 'Most Commented Post'])
        @slot('subtitle')
            What people are currently talking about
        @endslot
        @slot('items')
            @forelse ($comment as $comments)
                <li class="list-group-item">
                    <a href="{{ route('post.show',$comments->id) }}">{{ $comments->title }}</a>
                </li>
            @empty
                <div class="list-group-item">Comments not yet!</div>
            @endforelse 
        @endslot
    @endcomponent
</div>
<div class="card mt-4" style="width: 18rem;">
    @component('components.card',['title' => 'Most Posted User'])
        @slot('subtitle')
            Users with most posts written
        @endslot
        @slot('items', collect($user)->pluck('name'))
        @slot('else')
            User not found!
        @endslot
    @endcomponent
</div>
<div class="card mt-4" style="width: 18rem;">
    @component('components.card', ['title' => 'Most Active User'])
        @slot('subtitle')
            Last month active user
        @endslot
        @slot('items', collect($active)->pluck('name'))
        @slot('else')
            Last month active user not found!
        @endslot
    @endcomponent
</div>