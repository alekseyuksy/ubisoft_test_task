@extends('layouts.app', ['activePage' => 'action-management', 'titlePage' => __('action Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('actions') }}</h4>
                            <p class="card-category"> {{ __('Here you can manage actions') }}</p>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <span>{{ session('status') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('action.create') }}"
                                       class="btn btn-sm btn-primary">{{ __('Add action') }}</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>
                                        {{ __('Title') }}
                                    </th>
                                    <th>
                                        {{ __('Creation date') }}
                                    </th>
                                    <th class="text-right">
                                        {{ __('Actions') }}
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach($actions as $action)
                                        <tr>
                                            <td>
                                                {{ $action->title }}
                                            </td>
                                            <td>
                                                {{ $action->created_at->format('Y-m-d') }}
                                            </td>
                                            <td class="td-actions text-right">
                                                @if ($action->id != auth()->id())
                                                    <form action="{{ route('action.destroy', $action) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" class="btn btn-danger btn-link"
                                                                data-original-title="" title=""
                                                                onclick="confirm('{{ __("Are you sure you want to delete this action?") }}') ? this.parentElement.submit() : ''">
                                                            <i class="material-icons">close</i>
                                                            <div class="ripple-container"></div>
                                                        </button>
                                                    </form>
                                                @else
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                       href="{{ route('profile.edit') }}" data-original-title=""
                                                       title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection