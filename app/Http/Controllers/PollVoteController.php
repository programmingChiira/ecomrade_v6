<?php

namespace App\Http\Controllers;

use App\Http\Resources\PollVoteResource;
use Illuminate\Http\Request;
use App\Models\PollVote;
use Illuminate\Support\Facades\DB;

class PollVoteController extends Controller
{
    public function store(Request $request)
    {
        $voterId = auth()->user()->id;
        $voterName = auth()->user()->name;
        $userId = $request->input('user_id');
        $pollId = $request->input('id');
        $pollTitle = $request->input('title');
        $vote = $request->input('option');

        $pollvote = new PollVote();

        $pollvote->senderId = $voterId;
        $pollvote->senderName = $voterName;
        $pollvote->userId = $userId;
        $pollvote->pollId = $pollId;
        $pollvote->pollTitle = $pollTitle;
        $pollvote->vote = $vote;

        return $pollvote->save();
    }

    public function index()
    {
        return PollVoteResource::collection(PollVote::latest()->get());
    }

    public function getSub()
    {
        return PollVote::latest()->get();
    }

    public function show(PollVote $pollvote)
    {
        return $pollvote;
    }

    public function destroy(PollVote $pollvote)
    {
        return $pollvote->delete();
    }
}
