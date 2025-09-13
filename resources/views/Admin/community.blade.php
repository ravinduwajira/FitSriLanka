@extends('Admin.admin_dashboard')

@section('Admin')
<div class="container my-5">
    <br>
    <h1 class="mb-4 text-primary text-center">FitSriLanka Community Forum 🤝</h1>
    <h4 class="text-muted text-center mb-5">
        Engage, share, and connect with others in your fitness journey. Follow the community guidelines and make this a positive space for everyone!
</h4>

    <!-- Create Post Section -->
    <div class="card shadow-sm mb-5 border-0">
        <div class="card-body">
            <h5 class="text-secondary mb-4">Start a New Conversation</h5>
            <form action="{{ route('community.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="title" class="form-label fw-semibold">Title</label>
                    <input type="text" name="title" id="title" class="form-control rounded-pill" placeholder="Enter an engaging title" required>
                </div>
                <div class="mb-4">
                    <label for="body" class="form-label fw-semibold">Content</label>
                    <textarea name="body" id="body" class="form-control rounded-3" rows="5" placeholder="Write your post content..." required></textarea>
                </div>
                <div class="mb-4">
                    <label for="image" class="form-label fw-semibold">Attach an Image (Optional)</label>
                    <input type="file" name="image" id="image" class="form-control rounded-pill">
                </div>
                <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">Submit Post</button>
            </form>
        </div>
    </div>

    <!-- Posts List -->
    <h2 class="text-primary mb-4">Recent Discussions</h2>
    @foreach($posts as $post)
    <div class="card shadow-sm mb-5 border-0">
        <div class="card-body">
            <!-- Post Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title text-primary">{{ $post->title }}</h4>
                <span class="text-muted small">
                    Posted by <strong>{{ $post->user->name }}</strong> on {{ $post->created_at->format('d M Y') }}
                </span>
            </div>
            <!-- Post Content -->
            <p class="card-text">{{ $post->body }}</p>
            @if($post->image)
            <img src="{{ url('upload/posts/'.$post->image) }}" class="img-fluid rounded mb-4 fixed-image" alt="Post Image">
            @endif

            <!-- Post Actions -->
            <div class="d-flex align-items-center gap-3">
                <!-- Like Button -->
                <button 
                    class="btn btn-outline-success btn-sm rounded-circle d-flex align-items-center justify-content-center"
                    onclick="updatePostReaction({{ $post->id }}, 'like')"
                    id="like-btn-{{ $post->id }}">
                    <i class="fas fa-thumbs-up"></i>
                </button>
                <span id="like-count-{{ $post->id }}" class="small text-secondary">{{ $post->likes }}</span>

                <!-- Dislike Button -->
                <button 
                    class="btn btn-outline-danger btn-sm rounded-circle d-flex align-items-center justify-content-center"
                    onclick="updatePostReaction({{ $post->id }}, 'dislike')"
                    id="dislike-btn-{{ $post->id }}">
                    <i class="fas fa-thumbs-down"></i>
                </button>
                <span id="dislike-count-{{ $post->id }}" class="small text-secondary">{{ $post->dislikes }}</span>

                <!-- Delete Button -->
                @if(Auth::user()->role === 'Admin' || Auth::user()->id === $post->user_id)
                <form action="{{ route('Admin.community.posts.destroy', $post->id) }}" method="POST" class="ms-3" onsubmit="return confirm('Are you sure you want to delete this post?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm rounded-pill">Delete</button>
                </form>
                @endif
            </div>
        </div>

        <!-- Comments Section -->
        <div class="card-footer bg-light">
            <h6 class="text-secondary mb-3">Comments</h6>
            <p class="text-muted small">Be part of the conversation. Share your thoughts below.</p>
            <div id="comments-container-{{ $post->id }}">
                @foreach($post->comments as $comment)
                <div class="mb-3 p-3 bg-white shadow-sm rounded">
                    <strong>{{ $comment->user->name }}</strong>: {{ $comment->body }}
                </div>
                @endforeach
            </div>
            <form id="comment-form-{{ $post->id }}" action="{{ route('community.comments.store', $post) }}" method="POST">
                @csrf
                <textarea name="body" class="form-control rounded-3 mb-3" placeholder="Add a comment" rows="2" required></textarea>
                <button type="submit" class="btn btn-primary btn-sm rounded-pill">Post Comment</button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Add dynamic handling for posting comments
        document.querySelectorAll('[id^="comment-form-"]').forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const postId = this.id.split('-')[2];
                const formData = new FormData(this);
                const commentsContainer = document.getElementById(`comments-container-${postId}`);

                fetch(this.action, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const commentHtml = `
                            <div class="mb-3 p-3 bg-white shadow-sm rounded">
                                <strong>${data.comment.user.name}</strong>: ${data.comment.body}
                            </div>`;
                        commentsContainer.insertAdjacentHTML('beforeend', commentHtml);
                        this.querySelector('textarea').value = '';
                    } else {
                        alert(data.message || 'Failed to add comment.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred.');
                });
            });
        });
    });

    function updatePostReaction(postId, reactionType) {
        const likeButton = document.getElementById(`like-btn-${postId}`);
        const dislikeButton = document.getElementById(`dislike-btn-${postId}`);
        const likeCount = document.getElementById(`like-count-${postId}`);
        const dislikeCount = document.getElementById(`dislike-count-${postId}`);

        fetch(`/community/posts/${postId}/${reactionType}`, { 
            method: 'POST', 
            headers: { 
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                likeCount.textContent = data.likes;
                dislikeCount.textContent = data.dislikes;
                likeButton.classList.toggle('btn-success', reactionType === 'like');
                dislikeButton.classList.toggle('btn-danger', reactionType === 'dislike');
            } else {
                alert(data.message || 'Error updating reaction.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred.');
        });
    }
</script>

<style>
    .fixed-image {
        width: 100%;
        height: auto;
        max-height: 400px;
        object-fit: cover;
    }
    .card {
        border-radius: 20px;
    }
    .btn {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }
    .btn:hover {
        transform: scale(1.05);
    }
</style>
@endsection
