@extends('layouts.app')

@section('content')
    <div class="container" id="createShare">
        <div class="row panel panel-default">
            <div class="panel-heading">
                Add New
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form action="{{route('shares.store')}}" method="post" enctype="multipart/form-data" class="form form-horizontal">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="visibility" class="pull-left control-label">Visibility</label>
                            <div class="col-md-4">
                                <select id="is_public" name="is_public" class="form-control">
                                    <option value="0" selected>self</option>
                                    <option value="1">public</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('shareData') ? ' has-error' : '' }}">
                            <textarea name="shareData" class="form-control" cols="30" rows="10"
                                      placeholder="please input the data to share"></textarea>
                            @if ($errors->has('shareData'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('shareData') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            <input type="file" class="form-control" name="file">
                            @if ($errors->has('file'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default pull-right" v-on:click="showLoading" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/shareCreate.js') }}"></script>
@endsection
