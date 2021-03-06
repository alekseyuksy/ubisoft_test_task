@extends('layouts.app', ['activePage' => 'event-management', 'titlePage' => __('Event Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('event.store') }}" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('post')

                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Add Event') }}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('event.index') }}"
                                           class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                   name="title" id="input-title" type="text"
                                                   placeholder="{{ __('title') }}" value="{{ old('title') }}"
                                                   required="true" aria-required="true"/>
                                            @if ($errors->has('title'))
                                                <span id="title-error" class="error text-danger"
                                                      for="input-title">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Key') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('key') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('key') ? ' is-invalid' : '' }}"
                                                   name="key" id="input-key" type="text"
                                                   placeholder="{{ __('key') }}" value="{{ old('key') }}"
                                                   required="true" aria-required="true"/>
                                            @if ($errors->has('key'))
                                                <span id="key-error" class="error text-danger"
                                                      for="input-key">{{ $errors->first('key') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Add Event') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
