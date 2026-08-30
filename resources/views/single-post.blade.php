<x-layout>

  <div class="container py-md-5 container--narrow">
    <div class="d-flex justify-content-between">
      <h2>{{$post->title}}</h2>
      <span class="pt-2">
        <a href="#" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i
            class="fas fa-edit"></i></a>
        <form class="delete-post-form d-inline" action="#" method="POST">
          <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i
              class="fas fa-trash"></i></button>
        </form>
      </span>
    </div>

    <p class="text-muted small mb-4">
      @if ($post->postCreator->avatar)
        <a href="#"><img class="avatar-tiny" src="{{$post->postCreator->avatar}}" /></a>
      @endif
      Posted by <a href="#"> {{$post->postCreator->username}}</a> {{$post->created_at}}
    </p>

    <div class="body-content">
      <p> {!! $post->body !!}</p>
    </div>
  </div>

</x-layout>