<x-layout>
    <div class="container py-md-5 container--narrow">
        <form action="/post/{{ $post->id }}/edit" method="POST">
            @csrf
            @method('PUT')
            @include('partials.post-form', ['title' => $post->title, 'body' => $post->body])

            <button class="btn btn-primary">Save Changes</button>
            <a href="/post/{{ $post->id }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-layout>