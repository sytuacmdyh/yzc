@extends('layouts.app')

@section('content')
    <div class="container" id="noteContainer">
        <div class="row" style="margin-bottom: 10px">
            <a href="{{route('shares.create')}}" class="btn btn-success btn-block">添加</a>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Individual
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        @for ($i = 0;$i<10;$i++)
                            <li class="{{$i==0?'active':''}}"><a data-toggle="tab" href="#tab{{$i}}">TAB{{$i}}</a></li>
                        @endfor
                    </ul>

                    <div class="tab-content">
                        @for ($i = 0;$i<10;$i++)
                            <div id="tab{{$i}}" class="tab-pane fade{{$i==0?' in active':''}}">
                                <pre>
                                    <code class="">{{htmlspecialchars(@$shares[$i]['data'])}}</code>
                                </pre>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Public
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        @for ($i = 0;$i<10;$i++)
                            <li class="{{$i==0?'active':''}}"><a data-toggle="tab" href="#tabPublic{{$i}}">TAB{{$i}}</a></li>
                        @endfor
                    </ul>

                    <div class="tab-content">
                        @for ($i = 0;$i<10;$i++)
                            <div id="tabPublic{{$i}}" class="tab-pane fade{{$i==0?' in active':''}}">
                                <pre>
                                    <code class="">{{htmlspecialchars(@$sharesPublic[$i]['data'])}}</code>
                                </pre>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
