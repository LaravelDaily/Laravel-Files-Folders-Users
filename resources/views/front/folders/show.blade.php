@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Folder {{ $folder->name }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <a href="{{ route('folders.create') }}?parent_id={{ $folder->id }}" class="btn btn-success">Create a new folder</a>
                            <a href="{{ route('folders.upload') }}?folder_id={{ $folder->id }}" class="btn btn-primary">Upload images</a>
                        </div>

                        <div class="row">
                            @foreach ($folder->children as $folder)
                                <div class="col-lg-2 col-md-3 col-sm-4 mb-3">
                                    <div class="card">
                                        <a href="{{ route('folders.show', [$folder]) }}">
                                            <img class="card-img-top" src="{{ $folder->thumbnail ? $folder->thumbnail->thumbnail : url('images/empty-folder.png') }}" alt="{{ $folder->name }}">
                                        </a>
                                        <div class="card-footer text-center">
                                            <a href="{{ route('folders.show', [$folder]) }}">
                                                Folder {{ $folder->name }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($folder->files as $file)
                                <div class="col-lg-2 col-md-3 col-sm-4 mb-3">
                                    <div class="card">
                                        <a href="{{ $file->getUrl() }}" target="_blank">
                                            <img class="card-img-top" src="{{ $file->thumbnail ? $file->thumbnail : url('images/file-thumbnail.png') }}" alt="{{ $file->name }}">
                                        </a>
                                        <div class="card-footer text-center">
                                            <a href="{{ $file->getUrl() }}" target="_blank">
                                                {{ $file->file_name }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            @if ($folder->parent)
                                <a href="{{ route('folders.show', [$folder->parent]) }}" class="btn btn-primary">
                                    Back to folder {{ $folder->parent->name }}
                                </a>
                            @else
                                <a href="{{ route('projects.index') }}" class="btn btn-primary">Back to assigned projects</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
