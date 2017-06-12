@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add an image</div>
                    <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data"  role="form" method="POST" action="{{ url('users/add_image/'.$user_id) }}">
                    {{ csrf_field() }}
                        <div class="form-group">

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control" name="image" value="" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
            </div>
         </div>
    </div>

    <div class="row">
    <h2>User Images</h2>
     <?php
        foreach ($images as $image) { ?>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <img class="img-responsive" src="{{ url('images/'.$image->image_name) }}" >
                    <br>
                    <a href="{{ url('users/delete_image/'.$user_id.'/'.$image->id) }}">Delete</a>
                </div>
            </div>
        </div>

        <?php } ?>
    </div>
</div>
@endsection
