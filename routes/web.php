<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollController;
use App\Http\Controllers\VoteController;

Route::get('/', [PollController::class, 'index'])->name('polls.index');

Route::get('/polls/create', [PollController::class, 'create'])->name('polls.create');
Route::post('/polls', [PollController::class, 'store'])->name('polls.store');

Route::get('/polls/{poll}', [PollController::class, 'show'])->name('polls.show');
Route::post('/polls/{poll}/vote', [VoteController::class, 'store'])->name('polls.vote');
