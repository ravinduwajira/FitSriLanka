@extends('Admin.admin_dashboard')

@section('Admin')

<!-- Custom Chat Styles -->
<style>
    body {
        background-color: #1b1e2e;
        color: #ffffff;
    }

    .chat-container {
        display: flex;
        height: 90vh;
        margin-top: 2%;
        background-color: #2a2d3e;
        border: 1px solid #44475a;
        border-radius: 8px;
    }

    .user-list {
        width: 25%;
        border-right: 1px solid #44475a;
        overflow-y: auto;
        background-color: #20232a;
        padding: 10px;
    }

    .user-list h5 {
        color: #ffffff;
    }

    .user-list input[type="text"] {
        background-color: #2a2d3e;
        color: #ffffff;
        border: 1px solid #44475a;
    }

    .user-list .list-group-item {
        background-color: #2a2d3e;
        color: #ffffff;
        border: 1px solid #44475a;
        cursor: pointer;
    }

    .user-list .list-group-item:hover {
        background-color: #44475a;
    }

    .chat-window {
        width: 75%;
        display: flex;
        flex-direction: column;
        background-color: #282c36;
        border-left: 1px solid #44475a;
    }

    #currentChatUser {
        text-align: center;
        margin-bottom: 10px;
        padding: 10px;
        background-color: #44475a;
        color: #ffffff;
        font-size: 1.1rem;
        font-weight: bold;
    }

    .messages {
        flex: 1;
        overflow-y: auto;
        padding: 10px;
        background-color: #282c36;
        border-bottom: 1px solid #44475a;
    }

    .messages .message {
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 8px;
        position: relative;
        max-width: 70%;
    }

    .messages .message.sent {
        background-color: #5a67d8;
        color: #ffffff;
        align-self: flex-end;
        text-align: right;
    }

    .messages .message.received {
        background-color: #44475a;
        color: #ffffff;
        align-self: flex-start;
    }

    .messages .message small {
        display: block;
        margin-top: 5px;
        font-size: 0.8rem;
        color: #c0c0c0;
    }

    .chat-input {
        padding: 10px;
        border-top: 1px solid #44475a;
        background-color: #20232a;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .chat-input input[type="text"] {
        flex: 1;
        background-color: #2a2d3e;
        color: #ffffff;
        border: 1px solid #44475a;
        border-radius: 5px;
        padding: 8px 12px;
    }

    .chat-input input[type="text"]::placeholder {
        color: #c0c0c0;
    }

    .chat-input button {
        background-color: #5a67d8;
        color: #ffffff;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
    }

    .chat-input button:hover {
        background-color: #434190;
    }
</style>

<br><br><br>
<div class="container">
    <div class="chat-container border rounded shadow-sm">
        <!-- User List -->
        <div class="user-list">
            <h5 class="text-center">Users</h5>
            <input
                type="text"
                id="userSearchInput"
                class="form-control mb-3"
                placeholder="Search users..."
            >
            <ul class="list-group" id="userList">
                <!-- Users will be dynamically loaded via AJAX -->
                @foreach ($users as $user)
                    <li 
                        class="list-group-item d-flex justify-content-between align-items-center" 
                        onclick="selectUser({{ $user->id }}, '{{ $user->name }}')"
                    >
                        {{ $user->name }}
                        @if ($user->id === $currentUser->id)
                            <span class="badge bg-secondary">You</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Chat Window -->
        <div class="chat-window">
            <div id="currentChatUser">
                <p class="text-muted">Select a user to start chatting.</p>
            </div>
            <div class="messages" id="messages">
                <!-- Messages will load dynamically -->
            </div>
            <div class="chat-input">
                <form action="{{ route('chat.send') }}" method="POST" class="d-flex w-100">
                    @csrf
                    <input type="hidden" name="receiver_id" id="receiver_id">
                    <input type="text" class="form-control" name="content" id="messageInput" placeholder="Type your message...">
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>
<br><br>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Chat Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let currentChatUserId = null;
    let currentChatUserName = null;

    function selectUser(userId, userName) {
        currentChatUserId = userId;
        currentChatUserName = userName;
        document.getElementById('receiver_id').value = userId;

        const currentChatUser = document.getElementById('currentChatUser');
        currentChatUser.innerHTML = 
            `<h6 class="mb-0">
                Chatting with <strong>${userName}</strong>
            </h6>`;

        fetch(`/chat/messages/${userId}`)
            .then(response => response.json())
            .then(data => {
                const messagesDiv = document.getElementById('messages');
                messagesDiv.innerHTML = '';

                if (data.messages && data.messages.length > 0) {
                    data.messages.forEach(msg => {
                        const messageDiv = document.createElement('div');
                        messageDiv.className = `message ${msg.sender_id === {{ $currentUser->id }} ? 'sent' : 'received'}`;
                        
                        const timestamp = new Date(msg.created_at).toLocaleString();

                        messageDiv.innerHTML = 
                            `<p>${msg.content}</p>
                            <small>${timestamp}</small>`;
                        messagesDiv.appendChild(messageDiv);
                    });
                } else {
                    messagesDiv.innerHTML = '<p class="text-muted text-center mt-3">No messages yet.</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching chat messages:', error);
            });
    }

    document.querySelector('.chat-input form').addEventListener('submit', function (event) {
        event.preventDefault();
        const messageInput = document.getElementById('messageInput');
        const receiverId = document.getElementById('receiver_id').value;
        const content = messageInput.value.trim();

        if (!content || !receiverId) {
            alert('Message content cannot be empty.');
            return;
        }

        fetch('{{ route("chat.send") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                receiver_id: receiverId,
                content: content
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageInput.value = '';
                selectUser(currentChatUserId, currentChatUserName);
            } else {
                alert('Failed to send message.');
            }
        })
        .catch(error => {
            console.error('Error sending message:', error);
        });
    });
</script>

@endsection
