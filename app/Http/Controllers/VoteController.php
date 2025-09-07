<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(Request $request, Poll $poll)
{
    $data = $request->validate([
        'option_id' => 'required|exists:options,id',
    ]);

    // Create the vote without checking session
    Vote::create([
        'poll_id' => $poll->id,
        'option_id' => $data['option_id'],
        'voter_session' => session()->getId(),
        'voter_ip' => $request->ip(),
    ]);

    return redirect()->route('polls.show', $poll)
                     ->with('success', 'Thanks for voting!');
}
    
    //   *** For only 1 vote per session *** 
    //public function store(Request $request, Poll $poll)
    //{
    //    $data = $request->validate([
    //        'option_id' => 'required|exists:options,id',
    //    ]);

    //    $voted = session()->get('voted_polls', []);
    //    if (in_array($poll->id, $voted)) {
    //        return back()->withErrors(['You have already voted in this poll (session).']);
    //    }

    //    Vote::create([
    //        'poll_id' => $poll->id,
    //        'option_id' => $data['option_id'],
    //        'voter_session' => session()->getId(),
    //       'voter_ip' => $request->ip(),
    //    ]);

    //    $voted[] = $poll->id;
    //    session()->put('voted_polls', $voted);

    //    return redirect()->route('polls.show', $poll)->with('success', 'Thanks for voting!');
    //}
}

