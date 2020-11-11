@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <!-- Current Tasks -->
        <div class="panel panel-default">
            <div class="panel-heading">
                {{__('messages.task')}}: {{$task->name}}
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    @if (count($users) > 0)
                    <thead>
                    <th>{{__('messages.user')}}</th>
                    <th>&nbsp;</th>
                    </thead>             
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="table-text"><div><a href="{{ url('userDetail/'.$user->id) }}">{{ $user->name }}</a></div></td>
                            <td>
                                <form action="{{ route('removeUserFromTask',['id' => $task->id]) }}" method="GET">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>{{__('messages.delete')}}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    {{__('messages.nouserintask')}}
                    @endif
                </table>
                <form action="{{ route('listUserCanAdd',['id' => $task->id])}}" method="GET" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-plus"></i>{{__('messages.adduser')}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
