@component('mail::message')
# You post was liked

{{ $liker->name }} liked your post

@component('mail::button', ['url' => route('posts.show', $post)])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
