@extends('dashboard')
@section('User')

<!-- Custom Chat Styles -->
<style>
    body {
        background-color: #f8f9fa;
    }

    .chat-container {
        display: flex;
        height: 90vh;
        margin-top: 2%;
    }

    .user-list {
        width: 25%;
        border-right: 1px solid #ddd;
        overflow-y: auto;
    }

    .chat-window {
        width: 75%;
        display: flex;
        flex-direction: column;
    }

    .messages {
        flex: 1;
        overflow-y: auto;
        padding: 10px;
        background-color: #ffffff;
        border-bottom: 1px solid #ddd;
    }

    .messages .message {
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 8px;
        position: relative;
    }

    .messages .message.sent {
        background-color: #d1e7dd;
        align-self: flex-end;
    }

    .messages .message.received {
        background-color: #f8d7da;
        align-self: flex-start;
    }

    .messages .message small {
        display: block;
        margin-top: 5px;
        font-size: 0.8rem;
        color: #6c757d;
        text-align: right;
    }

    .chat-input {
    padding: 10px;
    border-top: 1px solid #ddd;
    display: flex;
    align-items: center;
    gap: 10px;
    background-color: #f8f9fa;
}

.chat-input input[type="text"] {
    flex: 1;
    border: 1px solid #ced4da;
    border-radius: 5px;
    padding: 8px 12px;
}

.chat-input button {
    border-radius: 5px;
    padding: 8px 16px;
}


    #currentChatUser {
        text-align: center;
        margin-bottom: 10px;
    }
</style>

<br><br><br>
<div class="container">
    <div class="chat-container border rounded shadow-sm">
        <!-- User List -->
        <div class="user-list p-3">
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
                        style="cursor: pointer;"
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
        <div class="chat-window"><br>
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
  // Flag to prevent multiple submissions
let isSendingMessage = false;

// Send a Message Without Reloading
$('.chat-input form').off('submit').on('submit', function (event) {
    event.preventDefault();

    // Prevent submitting if already sending a message
    if (isSendingMessage) return;

    const messageInput = $('#messageInput');
    const receiverId = $('#receiver_id').val();
    const content = messageInput.val().trim();

    // Check if the message is empty or receiver_id is missing
    if (!content || !receiverId) {
        alert('Message content cannot be empty.');
        return;
    }

    // Set flag to true to indicate the message is being sent
    isSendingMessage = true;

    // Optionally, disable the input and button to show the user it's sending
    const sendButton = $('.chat-input button');
    sendButton.prop('disabled', true);

    $.ajax({
        url: '{{ route("chat.send") }}',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: {
            receiver_id: receiverId,
            content: content
        },
        success: function (data) {
            if (data.success) {
                messageInput.val(''); // Clear input field
                loadMessages(); // Reload messages without refreshing
            } else {
                alert('Failed to send message.');
            }
        },
        error: function (error) {
            console.error('Error sending message:', error);
            alert('Error sending message.');
        },
        complete: function () {
            // Reset the flag and enable the button/input after the request completes
            isSendingMessage = false;
            sendButton.prop('disabled', false);
        }
    });
});

// Select a User to Chat With
function selectUser(userId, userName) {
    currentChatUserId = userId;
    currentChatUserName = userName;
    document.getElementById('receiver_id').value = userId;

    $("#currentChatUser").html(`<h6 class="mb-0 text-center">
        Chatting with <strong>${userName}</strong>
    </h6>`);

    loadMessages();
}

// Load Chat Messages
function loadMessages() {
    if (!currentChatUserId) return;

    $.ajax({
        url: `/chat/messages/${currentChatUserId}`,
        method: 'GET',
        success: function (data) {
            const messagesDiv = $('#messages');
            messagesDiv.html(''); // Clear previous messages

            if (data.messages && data.messages.length > 0) {
                data.messages.forEach(msg => {
                    const messageClass = msg.sender_id === {{ $currentUser->id }} ? 'sent' : 'received';
                    const timestamp = new Date(msg.created_at).toLocaleString();

                    messagesDiv.append(`
                        <div class="message ${messageClass}">
                            <p>${msg.content}</p>
                            <small class="text-muted">${timestamp}</small>
                        </div>
                    `);
                });
            } else {
                messagesDiv.html('<p class="text-muted text-center mt-3">No messages yet.</p>');
            }

            // Auto-scroll to the latest message
            messagesDiv.scrollTop(messagesDiv.prop("scrollHeight"));
        },
        error: function (error) {
            console.error('Error fetching chat messages:', error);
        }
    });
}

// Auto-Refresh Chat Messages Every 2 Seconds
setInterval(() => {
    if (currentChatUserId) {
        loadMessages();
    }
}, 2000); // Refresh every 2 seconds

// User Search functionality
$(document).ready(function() {
    $('#userSearchInput').on('input', function() {
        const query = $(this).val();

        $.ajax({
            url: '{{ route('chat.search') }}',
            method: 'GET',
            data: { query: query },
            success: function(response) {
                $('#userList').html(''); // Clear the current list
                if (response.users.length > 0) {
                    response.users.forEach(user => {
                        $('#userList').append(
                            `<li class="list-group-item d-flex justify-content-between align-items-center" 
                                style="cursor: pointer;" 
                                onclick="selectUser(${user.id}, '${user.name}')">
                                ${user.name}
                                ${user.id === {{ $currentUser->id }} ? '<span class="badge bg-secondary">You</span>' : '' }
                            </li>`
                        );
                    });
                } else {
                    $('#userList').html('<p class="text-muted text-center">No users found.</p>');
                }
            },
            error: function(error) {
                console.error('Error fetching users:', error);
            }
        });
    });
});

</script>

@endsection
