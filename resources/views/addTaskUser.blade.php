@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{__('messages.user')}}: {{$users->name}}
            </div>
            @if (count($tasks) > 0)
            <div class="panel-body">
                <form action="{{ route('addTaskToUser',['id' => $users->id]) }}" method="GET">
                    {{ csrf_field() }}
                    <tbody>
                    <table class="table table-striped task-table">
                        <thead>
                        <th>{{__('messages.task')}}</th>
                        <th>&nbsp;</th>
                        </thead>
                        @foreach ($tasks as $task)
                        <tr>
                            <td class="table-text"><div>{{ $task->name }}</div></td>
                            <td><input type="checkbox" name="task[]" value="{{$task->id}}" ></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-plus"></i>{{__('messages.addtask')}}
                    </button>
                    <input type="button" id="btn1" value="{{__('messages.selectall')}}"/>
                    <input type="button" id="btn2" value="{{__('messages.unselectall')}}"/>
                </form>
            </div>
            @else
            {{__('messages.notasktochoice')}} 
            @endif
            <form action="{{ route('userDetail',['id' => $users->id]) }}" method="GET">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-btn fa-chevron-circle-left"></i>{{__('messages.back')}}
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
