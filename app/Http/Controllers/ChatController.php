<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Redirect;

class ChatController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $id = Auth::user()->id;
        $profileData = User::find($id);
        // Fetch conversations where the authenticated user is a participant
        $currentUser = auth()->user();
        $users = User::all();
        $conversations = Conversation::where('user_one_id', $userId)
            ->orWhere('user_two_id', $userId)
            ->get();

        return view('chat', compact('conversations','profileData','currentUser','users'));
    }

    public function adminchat()
    {
        $userId = Auth::id();
        $id = Auth::user()->id;
        $profileData = User::find($id);
        // Fetch conversations where the authenticated user is a participant
        $currentUser = auth()->user();
        $users = User::all();
        $conversations = Conversation::where('user_one_id', $userId)
            ->orWhere('user_two_id', $userId)
            ->get();

        return view('Admin.chat', compact('conversations','profileData','currentUser','users'));
    }

    public function professionalchat()
    {
        $userId = Auth::id();
        $id = Auth::user()->id;
        $profileData = User::find($id);
        // Fetch conversations where the authenticated user is a participant
        $currentUser = auth()->user();
        $users = User::all();
        $conversations = Conversation::where('user_one_id', $userId)
            ->orWhere('user_two_id', $userId)
            ->get();

        return view('Professional.chat', compact('conversations','profileData','currentUser','users'));
    }

 // Method to handle sending a message
 public function sendMessage(Request $request)
{
    $validated = $request->validate([
        'receiver_id' => 'required|exists:users,id',
        'content' => 'required|string|max:1000',
    ]);

    Message::create([
        'sender_id' => auth()->id(),
        'receiver_id' => $validated['receiver_id'],
        'content' => $validated['content'],
    ]);

    return response()->json(['success' => true]);
}

 // Fetch chat messages for a specific user
public function getMessages($userId)
{
    // Ensure the messages are fetched between the current user and the selected user
    $messages = Message::where(function ($query) use ($userId) {
        $query->where('sender_id', auth()->id())
              ->where('receiver_id', $userId);
    })
    ->orWhere(function ($query) use ($userId) {
        $query->where('sender_id', $userId)
              ->where('receiver_id', auth()->id());
    })
    ->orderBy('created_at', 'asc')
    ->get()
    ->map(function ($message) {
        // Add a formatted timestamp to each message
        $message->formatted_created_at = $message->created_at->format('d-m-Y H:i:s');
        return $message;
    });

    // Return messages as JSON
    return response()->json(['messages' => $messages]);
}

 public function search(Request $request)
 {
     $query = $request->input('query');
 
     $users = User::where('name', 'LIKE', "%{$query}%")->get();
 
     return response()->json([
         'users' => $users
     ]);
 }
 

}
