@extends('postLayout')
@section('postContent')

<div class="container mt-5">
    <h1 class="text-center mb-5">Compact Post with Comments</h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#postModal">
        Add Post
      </button>
      <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="postModalLabel">New Post</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- Form inside modal -->
              <form id="postForm">
                <div class="form-group">
                  <label for="postTitle">Title</label>
                  <input type="text" class="form-control" id="postTitle" name="title" placeholder="Enter post title">
                </div>
                <div class="form-group">
                  <label for="postContent">Content</label>
                  <textarea class="form-control" id="postContent" rows="3" name="body" placeholder="Enter post content"></textarea>
                </div>
                <div class="form-group">
                  <label for="postCategory">File</label>
                  <input type="file" class="form-control" id="postFile" name="file" placeholder="Enter post title">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="submitPost">Submit Post</button>
            </div>
          </div>
        </div>
      </div>
    @if($posts->isEmpty())
        <p>No posts available.</p>
    @else
        @foreach($posts as $post)
        <div class="card post-card mb-4">
            <div class="post-header card-header">
                <h4>{{ $post->title }}</h4>
                <p class="post-body">{{ $post->body }}</p>
                @if($post->file_path)
                    <img src="{{ asset('storage/'.$post->file_path) }}" alt="{{ $post->title }}" class="img-fluid">
                @endif
                <small class="text-muted">Posted on {{ $post->created_at->format('F j, Y') }}</small>
            </div>
            <div class="card-body">
                <div class="comment-section">
                    <h5>Comments</h5>
                    <button id="addCommentButton" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#commentModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                        </svg>
                    </button>
                    <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="commentModalLabel">Add Comment</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form id="postForm">
                                <div class="form-group">
                                  <label for="postTitle">Comment</label>
                                  <input type="text" class="form-control" id="postTitle" name="title" placeholder="Enter post title">
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary" id="submitPost">Submit Comment</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    @if($post->comments->isEmpty())
                        <p class="text-muted">No comments available.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($post->comments as $comment)
                            <li class="list-group-item">
                                <strong>Comment:</strong> {{ $comment->comment }} <br>
                                <small class="text-muted">Posted on {{ $comment->created_at->format('F j, Y') }}</small>

                                @if($comment->replies->isNotEmpty())
                                    <ul class="list-group mt-2">
                                        @foreach($comment->replies as $reply)
                                        <li class="list-group-item">
                                            <strong>Reply:</strong> {{ $reply->comment }} <br>
                                            <small class="text-muted">Replied on {{ $reply->created_at->format('F j, Y') }}</small>
                                        </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
  $(document).ready(function () {
    $('#submitPost').on('click', function (e) {
      e.preventDefault();

    var formData = new FormData();
    formData.append('title', $('#postTitle').val());
    formData.append('body', $('#postContent').val());

    var fileInput = $('#postFile')[0].files[0];
    if (fileInput) {
      formData.append('file', fileInput);
    }
    $.ajax({
      url: '/api/posts',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        alert("Post submitted successfully!");
        $('#postModal').modal('hide');
        $('#postForm')[0].reset();
        window.location.reload()
      },
      error: function (error) {
        console.error("There was an error submitting the post:", error);
        alert("Error submitting the post.");
      }
    });
    });
  });
</script>
@endsection
