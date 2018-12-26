@extends('layouts.app')

@section('content')
    <div class="container" id="home">
        <vue-canvas-nest :config="{color:'100,100,100', count: 128}"></vue-canvas-nest>
        <div class="row">
            <ol class="breadcrumb" style="background-color: #fff">
                <li><a href="#">Home</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Home
                    </div>
                    <div class="panel-body">
                        <a href="{{url('/notes')}}" class="btn btn-default btn-block">Note</a>
                        <a href="{{url('/shares')}}" class="btn btn-default btn-block">Share</a>
                        <a href="{{'http://git.yzccz.cn/'}}" class="btn btn-default btn-block">Git</a>
                        <a href="{{url('/notebook')}}" class="btn btn-default btn-block">Jupyter Notebook</a>
                    </div>
                </div>
                <div class="alert alert-info">
                    {{$ip}}
                </div>
            </div>
        </div>

    </div>
    <script src="{{ mix('js/home.js') }}"></script>
@endsection
