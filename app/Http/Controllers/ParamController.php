<?php

namespace App\Http\Controllers;

use App\Param;
use App\Http\Requests\ParamRequest;
use \Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;

class ParamController extends Controller
{
    /**
     * Display a listing of the params
     *
     * @param Param $model
     * @return View
     */
    public function index(Param $model)
    {
        return view('params.index', ['params' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new Param
     *
     * @return View
     */
    public function create()
    {
        return view('params.create');
    }

    /**
     * Store a newly created Param in storage
     *
     * @param ParamRequest $request
     * @param Param $model
     * @return RedirectResponse
     */
    public function store(ParamRequest $request, Param $model)
    {
        $model->create($request->all());

        return redirect()->route('param.index')->withStatus(__('Param successfully created.'));
    }

    /**
     * Show the form for editing the specified Param
     *
     * @param Param $param
     * @return View
     */
    public function edit(Param $param)
    {
        return view('params.edit', compact('param'));
    }

    /**
     * Update the specified Param in storage
     *
     * @param ParamRequest $request
     * @param Param $param
     * @return RedirectResponse
     */
    public function update(ParamRequest $request, Param $param)
    {
        $param->update($request);

        return redirect()->route('param.index')->withStatus(__('Param successfully updated.'));
    }

    /**
     * Remove the specified Param from storage
     *
     * @param Param $param
     * @return RedirectResponse
     */
    public function destroy(Param $param)
    {
        $param->delete();

        return redirect()->route('param.index')->withStatus(__('param successfully deleted.'));
    }
}
