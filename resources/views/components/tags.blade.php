<p class="pl-3 mb-0 ">
   @forelse ($tags as $tag)
       <a href="{{ route('post.tag.index',['tag' => $tag->id]) }}" class="badge badge-success badge-lg">
           {{ $tag->name }}
        </a>
   @empty
       {{ __('Tags not available') }}
   @endforelse
</p>