@extends('user')

@section('css')

@stop
@section('content')


    <div class="container" id="app">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$page_title = "Chat"}}</div>

                    <div class="panel-body">
                        <chat-messages :messages="messages"></chat-messages>
                    </div>
                    <div class="panel-footer">
                        <chat-form
                                v-on:messagesent="addMessage"
                                :user="{{ Auth::user() }}"
                        ></chat-form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection