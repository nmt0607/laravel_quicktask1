@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{__('messages.task')}}: {{$tasks->name}}
            </div>
            @if (count($users) > 0)
            <div class="panel-body">
                <form action="{{ route('addUserToTask',['id' => $tasks->id]) }}" method="GET">
                    {{ csrf_field() }}
                    <tbody>
                    <table class="table table-striped task-table">
                        <thead>
                        <th>{{__('messages.user')}}</th>
                        <th>&nbsp;</th>
                        </thead>
                        @foreach ($users as $user)
                        <tr>
                            <td class="table-text"><div>{{ $user->name }}</div></td>
                            <td><input type="checkbox" name="user[]" value="{{$user->id}}" ></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-plus"></i>{{__('messages.adduser')}} 
                    </button>
                    <input type="button" id="btn1" value="{{__('messages.selectall')}}"/>
                    <input type="button" id="btn2" value="{{__('messages.unselectall')}}"/>
                </form>                       
            </div>
            @else
            {{__('messages.nousertochoice')}} 
            @endif
            <form action="{{ route('taskDetail',['id' => $tasks->id]) }}" method="GET">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-btn fa-chevron-circle-left"></i>{{__('messages.back')}}
                </button>
            </form>
        </div>
    </div>
</div>

@endsection