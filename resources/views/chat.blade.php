@extends('layout.app')
@section('content')
<div id="content"> 
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="chat-panel panel panel-info">
                    <div class="panel-heading">
                        <i class="icon-comments"></i> 
                        {{$chattingWith->first_name}} {{$chattingWith->last_name}}
                    </div>
                    <div class="panel-body" style="height: 62vh;">
                        <chat-messages
                        :messages="messages"
                        :room_id="{{ $room_id->id }}"
                        :texter="{{$chattingWith->id}}">                                
                        </chat-messages>
                    </div>
                    <div class="panel-footer">
                        <chat-form
                            v-on:messagesent="addMessage"
                            :user="{{ Auth::user() }}"
                            :room_id="{{ $room_id->id }}"
                        ></chat-form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection