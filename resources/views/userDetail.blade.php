@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{__('messages.user')}}: {{$user->name}}
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    @if (count($tasks) > 0)
                    <thead>
                    <th>{{__('messages.task')}}</th>
                    <th>&nbsp;</th>
                    </thead>
                    
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <td class="table-text"><div><a href="{{ url('taskDetail/'.$task->id) }}">{{ $task->name }}</a></div></td>
                            <td>
                                <form action="{{ route('removeTaskFromUser',['id' => $user->id]) }}" method="GET">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="task_id" value="{{$task->id}}">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>{{__('messages.delete')}}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    {{__('messages.notaskinuser')}}
                    @endif
                </table>
                <form action="{{ route('listTaskCanAdd',['id' => $user->id])}}" method="GET" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-plus"></i>{{__('messages.addtask')}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
