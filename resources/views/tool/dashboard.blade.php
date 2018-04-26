@extends('layouts.app')

@section('content')
    <div class="container" id="fontPrune" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="row panel panel-default">
            <div class="panel-heading">
                Font Pruner
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form action="{{route('fontPrune')}}" method="post" enctype="multipart/form-data"
                          class="form form-horizontal col-md-8">
                        {{csrf_field()}}
                        <div class="form-group{{ $errors->has('file_ttf') ? ' has-error' : '' }}">
                            <label class="pull-left control-label">Select The .ttf</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control file" data-show-upload="false"
                                       v-on:change="fileInputChange"
                                       data-show-preview="false" name="file_ttf" placeholder="select">
                                @if ($errors->has('file_ttf'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file_ttf') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class="form-group{{ $errors->has('file_txt') ? ' has-error' : '' }}">
                            <label class="pull-left control-label">Select The .txt</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control file" data-show-upload="false"
                                       v-on:change="fileInputChange"
                                       data-show-preview="false" name="file_txt" placeholder="select">
                                @if ($errors->has('file_txt'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file_txt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default" @click="showLoading" type="submit">
                                Start Prune
                            </button>
                        </div>
                    </form>
                    <div class="alert alert-info col-md-4">
                        <b>1</b> .ttf is the font file <br>
                        <b>2</b> and the .txt is the whitelist <br>
                        <b>3</b> click the button and wait a while, a smaller .ttf you will get
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/fontPrune.js') }}"></script>
    <div>
        <?php
                dump(@$downloadUrl);
        ?>
    </div>

    @if(@$downloadUrl)
        <script>console.log("{{ $downloadUrl }}")</script>
    @endif
@endsection
