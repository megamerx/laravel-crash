@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-9/12 bg-white p-6 rounded-lg">
            <form action="{{ route('tags.store')}}" id="tag_create_form" onsubmit="return false;">
                @csrf

                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <input name="name" id="name" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                    @error('name') border-red-500 @enderror" placeholder="Tag name"/>

                    @error('name')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                    @error('name') border-red-500 @enderror" placeholder="Tag something!"></textarea>

                    @error('name')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <button id="tag-button-submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full" value="">Post</button>
                </div>
            </form>

            @if ($tags->count())
                @foreach ($tags as $tag)
                    <x-post :tag="$tag" />
                @endforeach

                {{ $posts->links() }}
            @else
                <p>There are no Tags</p>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">

$(window).on('load', function() {
    $('#tag-button-submit').click(function() {
        alert('test');
        let data = {
                _token: "{{ csrf_token() }}",
                name: $('#name').val(),
                description: $('#description').val()
            };
        $.post('{{ route('tags.store')}}',
            data,
            function (data) {
                console.log(data);
                alert(data);
            }
        );
    });

});

</script>
@endsection