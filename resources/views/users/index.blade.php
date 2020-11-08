@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                    {{$auth->name}}
                </div>
                <div class="profile-usertitle-job">
                    {{$role}}
                </div>
                <div class="profile-usertitle-job">
                    {{$date}}
                </div>
            </div>
        </div>
    </div>
@endsection

