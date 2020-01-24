<?php

namespace App\Http\Controllers;

use App\Action;
use App\Http\Requests\ActionRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use \Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;

class ActionController extends Controller
{
    /**
     * Display a listing of the actions
     *
     * @param Action $model
     * @return View
     */
    public function index(Action $model)
    {
        return view('actions.index', ['actions' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new Action
     *
     * @return View
     */
    public function create()
    {
        return view('actions.create');
    }

    /**
     * Store a newly created Action in storage
     *
     * @param ActionRequest $request
     * @param Action $model
     * @return RedirectResponse
     */
    public function store(ActionRequest $request, Action $model)
    {
        $requestData = $request->all();
        $model = new Action();
        $model->user = $requestData['user'];
        $model->event = $requestData['event'];

        $params = [];

        foreach ($requestData as $key => $data) {
            if (is_int(strpos($key, 'param'))) {
                $params[$data] = $requestData['value_' . str_replace('param_', '', $key)];
            }
        }

        foreach ($params as $key => $param) {
            $model->{$key} = $param;
        }

        $model->save();

        return redirect()->route('action.index')->withStatus(__('Action successfully created.'));
    }

    public function revenue()
    {
        $data = Action::where('event', 'first_payment')
            ->orWhere('event', 'future_payment')
            ->orderBy('created_at', 'asc')->get();

        $result = [];

        foreach ($data as $key => $item) {
            $users = Action::where('created_at', '<', $item->created_at)
                ->where('event', 'register')
                ->count();

            $result['items'][] = [
                'price' => $item->amount / $users,
                'timestamp' => strtotime($item->created_at),
            ];
        }

        return json_encode($result);
    }

    public function retention()
    {
        $data = User::orderBy('created_at', 'asc')->get();
        $dates = [];

        $lastPeriod = $data{count($data)-1}->created_at;
        $startDate = $data{0}->created_at;

        while ($startDate <= $lastPeriod) {
            $usersCountStart = User::where('created_at', '<', $startDate)->count();
            $usersCountEnd = User::where('created_at', '<', $startDate->modify('+2 days'))->count();
            $usersCountNew = User::where('created_at', '>', $startDate)
                ->where('created_at', '<', $startDate->modify('+2 days'))
                ->count();

            if($usersCountStart == 0){
                $dates[] = [
                    'retention' => ($usersCountEnd - $usersCountNew),
                    'date' => strtotime($startDate),
                ];
            }else {
                $dates[] = [
                    'retention' => ($usersCountEnd - $usersCountNew) / $usersCountStart,
                    'date' => strtotime($startDate),
                ];
            }

            $startDate = $startDate->modify('+2 days');
        }

        return json_encode($dates);
    }

    public function usersChart(){
        $users = User::groupBy('device')->get();
        $info = [];

        foreach ($users as $user) {
            $info[] = [
                'label' => $user->device,
                'value' => User::where('device', $user->device)->count()
            ];
        }

        return json_encode($info);
    }
}
