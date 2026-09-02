<x-layout>
    <div class="container py-md-5 container--narrow">
        <form action="/create-post" method="POST">
            @csrf
            @include('partials.post-form')

            <button class="btn btn-primary">Save New Post</button>
        </form>
    </div>
</x-layout>