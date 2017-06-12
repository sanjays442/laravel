@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">
                <?php
                    foreach ($users as $user) {
                        echo $user->name." <a href='users/edit_user/".$user->id."'>Edit user</a> <a href='users/manage_images/".$user->id."'>Manage Images</a><br>";
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
