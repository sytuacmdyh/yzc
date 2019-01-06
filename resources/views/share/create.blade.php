@extends('layouts.app')

@section('content')
    <div class="container" id="createShare">
        <div class="row panel panel-default">
            <div class="panel-heading">
                Add New
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form action="{{route('shares.store')}}" method="post" enctype="multipart/form-data"
                          class="form form-horizontal">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="is_public" class="pull-left control-label">Visibility</label>
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
                            <input type="text" name="file" v-model="fileName" style="display: none;">
                            <input type="file" class="form-control"
                                   @change="uploadOss($event, {{ $config }}, {{ Auth::user()->id }})">
                            @if ($errors->has('file'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                            @endif
                            <div class="progress" v-if="progress_int > 0" style="margin-top: 10px">
                                <div class="progress-bar progress-bar-success progress-bar-striped active"
                                     role="progressbar" :aria-valuenow="progress_int" aria-valuemin="0"
                                     aria-valuemax="100"
                                     :style="{ width: progress_int + '%' }">
                                    @{{progress_int}}%
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button :disabled="!canSubmit" class="btn btn-default pull-right" @click="showLoading" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/shareCreate.js') }}"></script>
@endsection
