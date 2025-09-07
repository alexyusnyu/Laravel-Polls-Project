<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Option;
use App\Models\Vote;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::latest()->paginate(6);
        return view('polls.index', compact('polls'));
    }

    public function create()
    {
        return view('polls.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'options.*' => 'required|string|max:255',
        ]);

        $poll = Poll::create([
            'question' => $request->question,
            'expires_at' => $request->expires_at ?? null
        ]);

        foreach ($request->options as $option) {
            $poll->options()->create(['text' => $option]);
        }

        return redirect()->route('polls.index')->with('success', 'Poll created successfully.');
    }

    public function show(Poll $poll)
    {
        $poll->load('options.votes', 'votes');
        return view('polls.show', compact('poll'));
    }

    public function vote(Request $request, Poll $poll)
    {
        $request->validate(['option_id' => 'required|exists:options,id']);

        $option = $poll->options()->findOrFail($request->option_id);
        $option->votes()->create();

        return redirect()->route('polls.show', $poll)->with('success', 'Your vote has been counted!');
    }

    // Delete Poll
    public function destroy(Poll $poll)
    {
        
        $poll->options()->each(function ($option) {
            $option->votes()->delete();
            $option->delete();
        });
        $poll->votes()->delete(); 
        $poll->delete();

        return redirect()->route('polls.index')->with('success', 'Poll deleted successfully.');
    }
}
