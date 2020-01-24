@extends('layouts.app', ['activePage' => 'event-management', 'titlePage' => __('event Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('events') }}</h4>
                            <p class="card-category"> {{ __('Here you can manage events') }}</p>
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
                                    <a href="{{ route('event.create') }}"
                                       class="btn btn-sm btn-primary">{{ __('Add event') }}</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>
                                        {{ __('Title') }}
                                    </th>
                                    <th>
                                        {{ __('Key') }}
                                    </th>
                                    <th>
                                        {{ __('Creation date') }}
                                    </th>
                                    <th class="text-right">
                                        {{ __('Actions') }}
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach($events as $event)
                                        <tr>
                                            <td>
                                                {{ $event->title }}
                                            </td>
                                            <td>
                                                {{ $event->key }}
                                            </td>
                                            <td>
                                                {{ $event->created_at->format('Y-m-d') }}
                                            </td>
                                            <td class="td-actions text-right">
                                                @if ($event->id != auth()->id())
                                                    <form action="{{ route('event.destroy', $event) }}" method="post">
                                                        @csrf
                                                        @method('delete')

                                                        <a rel="tooltip" class="btn btn-success btn-link"
                                                           href="{{ route('event.edit', $event) }}"
                                                           data-original-title="" title="">
                                                            <i class="material-icons">edit</i>
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-link"
                                                                data-original-title="" title=""
                                                                onclick="confirm('{{ __("Are you sure you want to delete this event?") }}') ? this.parentElement.submit() : ''">
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
