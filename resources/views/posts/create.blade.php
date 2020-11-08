@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h3>Add New Post</h3>
                    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data" id="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Photo</label>
                            <div class="input-group image-preview">
                                <input type="file" accept="image/png, image/jpeg, image/gif" name="photo"/> <!-- rename it -->
                            </div>
                            @if ($errors->has('photo'))
                                <span class="help-block posts-help">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" />
                            @if ($errors->has('title'))
                                <span class="help-block posts-help">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea rows="5" class="form-control" name="description" ></textarea>
                            @if ($errors->has('description'))
                                <span class="help-block posts-help">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success" id="save">Save</button>
                            <a href="{{route('users.index')}}" class="btn btn-danger cancel">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
