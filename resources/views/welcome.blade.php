@extends('layouts.app')

@section('content')
    <div id="app">
        <appnav v-if="!$route.meta.admin"></appnav>
        <router-view></router-view>

        <appfooter v-if="!$route.meta.admin"></appfooter>

    </div>

@endsection
