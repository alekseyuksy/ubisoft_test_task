@extends('layouts.app', ['activePage' => 'action-management', 'titlePage' => __('Action Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('action.store') }}" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('post')

                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Add Action') }}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('action.index') }}"
                                           class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('User') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('user') ? ' has-danger' : '' }}">
                                            <select class="form-control{{ $errors->has('user') ? ' is-invalid' : '' }}"
                                                    name="user" id="input-user" type="text"
                                                    placeholder="{{ __('type') }}" value="{{ old('user') }}"
                                                    required="true" aria-required="true">
                                                @foreach(\App\User::getUsersArray() as $id => $type)
                                                    <option value="{{ $id }}">{{ $type }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('user'))
                                                <span id="user-error" class="error text-danger"
                                                      for="input-user">{{ $errors->first('user') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Event') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('event') ? ' has-danger' : '' }}">
                                            <select class="form-control{{ $errors->has('event') ? ' is-invalid' : '' }}"
                                                    name="event" id="input-event" type="text"
                                                    placeholder="{{ __('type') }}" value="{{ old('event') }}"
                                                    required="true" aria-required="true">
                                                @foreach(\App\Event::getEventsArray() as $id => $type)
                                                    <option value="{{ $id }}">{{ $type }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('event'))
                                                <span id="event-error" class="error text-danger"
                                                      for="input-event">{{ $errors->first('event') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row new-parameter" data-param="1"  style="display: none;">
                                        <label class="col-sm-2 col-form-label">{{ __('Parameter') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group{{ $errors->has('param') ? ' has-danger' : '' }}">
                                                <select
                                                    class="form-control{{ $errors->has('param') ? ' is-invalid' : '' }}" type="text"
                                                    placeholder="{{ __('type') }}" value="{{ old('param') }}"
                                                    required="true" aria-required="true">
                                                    @foreach(\App\Param::getParamsArray() as $id => $type)
                                                        <option value="{{ $id }}">{{ $type }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('tut'))
                                                    <span id="param-error" class="error text-danger"
                                                          for="input-param">{{ $errors->first('param') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                                <div class="row new-value" style="display: none;">
                                    <label class="col-sm-2 col-form-label">{{ __('Value') }}</label>
                                    <div class="col-sm-7">
                                        <input class="form-control">
                                    </div>
                                </div>
                                <a id="add-parameter" onclick="" class="btn btn-success">{{ __('Add Parameter') }}</a>

                                <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Add Action') }}</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
