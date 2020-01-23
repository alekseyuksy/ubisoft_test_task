<?php

namespace App\Http\Controllers;

use App\Event;
use App\Game;
use App\Http\Requests\EventRequest;
use Illuminate\Support\Facades\Hash;
use \Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;

class EventController extends Controller
{
    /**
     * Display a listing of the events
     *
     * @param Event $model
     * @return View
     */
    public function index(Event $model)
    {
        return view('events.index', ['events' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new Event
     *
     * @return View
     */
    public function create()
    {
        $games = Game::getGamesByIdTitle();

        return view('events.create', compact('games'));
    }

    /**
     * Store a newly created Event in storage
     *
     * @param EventRequest $request
     * @param Event $model
     * @return RedirectResponse
     */
    public function store(EventRequest $request, Event $model)
    {
        $model->create($request->all());

        return redirect()->route('event.index')->withStatus(__('Event successfully created.'));
    }

    /**
     * Show the form for editing the specified Event
     *
     * @param Event $event
     * @return View
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified Event in storage
     *
     * @param EventRequest $request
     * @param Event $event
     * @return RedirectResponse
     */
    public function update(EventRequest $request, Event $event)
    {
        $event->update($request);

        return redirect()->route('event.index')->withStatus(__('Event successfully updated.'));
    }

    /**
     * Remove the specified Event from storage
     *
     * @param Event $event
     * @return RedirectResponse
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('event.index')->withStatus(__('event successfully deleted.'));
    }
}
