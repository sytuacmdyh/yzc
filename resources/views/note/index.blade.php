@extends('layouts.app')

@section('content')
<div class="container" id="noteContainer">
	<div class="row">
		<ol class="breadcrumb" style="background-color: #fff">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="#">note</a></li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-3">
			<ul class="list-group">
			  <a href="{{ route('notes.index') }}" class="list-group-item"><span class="badge">{{ $counts['pendingCount']}}</span> Pending </a>
			  <a href="{{ route('notes.index').'?status=completed' }}" class="list-group-item"><span class="badge">{{ $counts['completedCount']}}</span> Completed</a>
			  <a href="{{ route('notes.index').'?deleted=1' }}" class="list-group-item"><span class="badge">{{ $counts['deletedCount']}}</span> Deleted</a>
			</ul>
		</div>
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					<button class="btn-block btn btn-primary" data-toggle="modal" data-target="#addNoteModal">add a note</button>
					<table class="table table-striped table-hover">
					<thead>
					  <tr>
						<th>Title</th>
						<th>Classification</th>
						<th>CreateTime</th>
						@if (!$deleted && ($status=='pending' || !$status))
							<th>Actions</th>
						@endif
					  </tr>
					</thead>
					<tbody>
					  @foreach ($notes as $note)
					  <tr data-toggle="tooltip" title="{{$note->content}}">
						<td>{{$note->title}}</td>
						<td>{{$note->type}}</td>
						<td>{{$note->created_at}}</td>
						@if (!$deleted && ($status=='pending' || !$status))
						<td>
							<button class="btn btn-sm" v-on:click="completeNote('{{$note->id}}')"><span class="glyphicon glyphicon-ok"></span></button>
							<button class="btn btn-sm" v-on:click="deleteNote('{{$note->id}}')"><span class="glyphicon glyphicon-trash"></span></button>
							{{-- <button class="btn btn-sm" v-on:click="editNote('{{$note->id}}')"><span class="glyphicon glyphicon-edit"></span></button> --}}
						</td>
						@elseif ($deleted)
						<td>
							<button class="btn btn-sm" v-on:click="deleteNoteForce('{{$note->id}}')"><span class="glyphicon glyphicon-trash"></span></button>
						</td>
						@endif
					  </tr>
					  @endforeach
					</tbody>
					{{ $notes->links() }}
				  </table>
				</div>
			</div>
		</div>
	</div>
  <div class="modal fade" id="addNoteModal" role="dialog">
	<div class="modal-dialog">
	
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4>Add Note</h4>
		</div>
		<div class="modal-body">
		  <form role="form">
		  	<div class="form-group" v-if="errors.length>0">
		  		<div class="alert alert-danger">
			        <ul>
			            <li v-for="error in errors">@{{ error }}</li>
			        </ul>
			    </div>
		  	</div>
			<div class="form-group">
			  <label><span class="glyphicon glyphicon-tag"></span> Title</label>
			  <input type="text" class="form-control" v-model="title" placeholder="Enter title">
			</div>
			<div class="form-group">
			  <label for="classification"><span class="glyphicon glyphicon-flag"></span> Classificaion</label>
			  <input type="text" class="form-control" v-model="classification" placeholder="Enter classification">
			</div>
			<div class="form-group">
			  <label for="content"><span class="glyphicon glyphicon-book"></span> Content</label>
			  <textarea class="form-control" v-model="content" rows="10" placeholder="Enter content"></textarea>
			</div>
		  </form>
		</div>
		<div class="modal-footer">
		  <button class="btn btn-danger btn-default pull-left" data-dismiss="modal">
			<span class="glyphicon glyphicon-remove"></span> Cancel
		  </button>
		  <button class="btn btn-success pull-right" v-on:click="submitAddNoteForm">
			<span class="glyphicon glyphicon-ok"></span> Add
		  </button>
		</div>
	  </div>
	</div>
  </div> 
</div>
@endsection
