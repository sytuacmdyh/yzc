@extends('layouts.app')

@section('content')
    <div class="container" id="noteContainer">
        <div class="row panel panel-default">
            <div class="panel-heading">
                添加
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form action="{{route('shares.store')}}" method="post" class="form form-horizontal">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="visibility" class="pull-left control-label">可见性</label>
                            <div class="col-md-4">
                                <select id="is_public" name="is_public" class="form-control">
                                    <option value="0" selected>self</option>
                                    <option value="1">public</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea name="shareData" class="form-control" cols="30" rows="10"
                                      placeholder="请输入内容"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default pull-right" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
