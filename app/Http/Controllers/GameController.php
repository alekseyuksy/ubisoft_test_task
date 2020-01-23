<?php

namespace App\Http\Controllers;

use App\Game;
use App\Http\Requests\ParamRequest;
use Illuminate\Support\Facades\Hash;
use \Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;

class GameController extends Controller
{
    /**
     * Display a listing of the games
     *
     * @param Game $model
     * @return View
     */
    public function index(Game $model)
    {
        return view('games.index', ['games' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new Game
     *
     * @return View
     */
    public function create()
    {
        return view('games.create');
    }

    /**
     * Store a newly created Game in storage
     *
     * @param ParamRequest $request
     * @param Game $model
     * @return RedirectResponse
     */
    public function store(ParamRequest $request, Game $model)
    {
        $model->create($request->all());

        return redirect()->route('game.index')->withStatus(__('Game successfully created.'));
    }

    /**
     * Show the form for editing the specified Game
     *
     * @param Game $game
     * @return View
     */
    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    /**
     * Update the specified Game in storage
     *
     * @param ParamRequest $request
     * @param Game $game
     * @return RedirectResponse
     */
    public function update(ParamRequest $request, Game $game)
    {
        $hasPassword = $request->get('password');
        $game->update($request);

        return redirect()->route('game.index')->withStatus(__('Game successfully updated.'));
    }

    /**
     * Remove the specified Game from storage
     *
     * @param Game $game
     * @return RedirectResponse
     */
    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('game.index')->withStatus(__('game successfully deleted.'));
    }
}
