@props(['tag' => $tag])

<div class="mb-4">
    <span class="text-gray-600 text-sm"> {{ $tag->created_at->diffForHumans() }}<span>

    <p class="mb-2"> {{ $tag->name }} | {{ $tag->description }}</p>

    @can('delete', $tag)
        <form action="{{ route('tags.destroy', $tag) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-blue-500">Delete</button>
        </form>
    @endcan
</div>
