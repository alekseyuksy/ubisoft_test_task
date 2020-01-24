@extends('layouts.app', ['activePage' => 'param-management', 'titlePage' => __('Param Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('param.update', $param) }}" autocomplete="off"
                          class="form-horizontal">
                        @csrf
                        @method('put')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit Param') }}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        {{--                      <a href="{{ route('param.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>--}}
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                   name="title" id="input-title" type="text"
                                                   placeholder="{{ __('Name') }}"
                                                   value="{{ old('title', $param->title) }}" required="true"
                                                   aria-required="true"/>
                                            @if ($errors->has('title'))
                                                <span id="title-error" class="error text-danger"
                                                      for="input-title">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Type') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('type_id') ? ' has-danger' : '' }}">
                                            <select class="form-control{{ $errors->has('key_id') ? ' is-invalid' : '' }}"
                                                    name="key_id" id="input-key_id" key="text"
                                                    placeholder="{{ __('key') }}" value="{{ old('key_id') }}"
                                                    required="true" aria-required="true">
                                                @foreach(\App\Param::getTypes() as $id => $key)

                                                <option {{$id == old('type_id', $param->type_id)? 'selected' : '' }} value="{{ $id }}">{{ $key }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('type_id'))
                                                <span id="type_id-error" class="error text-danger"
                                                      for="input-type_id">{{ $errors->first('type_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Key') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('Key') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('key') ? ' is-invalid' : '' }}"
                                                   name="key" id="input-key" key="text" placeholder="{{ __('Name') }}"
                                                   value="{{ old('key', $param->key) }}" required="true"
                                                   aria-required="true"/>
                                            @if ($errors->has('key'))
                                                <span id="key-error" class="error text-danger"
                                                      for="input-key">{{ $errors->first('key') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
