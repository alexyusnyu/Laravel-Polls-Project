<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::latest()->paginate(10);
        return view('polls.index', compact('polls'));
    }

    public function create()
    {
        return view('polls.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
            'expires_at' => 'nullable|date',
        ]);

        $poll = Poll::create([
            'question' => $data['question'],
            'expires_at' => $data['expires_at'] ?? null,
        ]);

        foreach ($data['options'] as $opt) {
            $poll->options()->create(['text' => $opt]);
        }

        return redirect()->route('polls.show', $poll)->with('success', 'Poll created.');
    }

    public function show(Poll $poll)
    {
        $poll->load('options.votes');
        $totalVotes = $poll->votes()->count();
        return view('polls.show', compact('poll', 'totalVotes'));
    }
}
