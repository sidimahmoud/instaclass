@extends('layouts.app')

@section('content')
    <div id="app">
        <appnav v-if="!$route.meta.admin"></appnav>
        <div style="min-height: 70vh">
            <router-view></router-view>
        </div>

        <appfooter v-if="!$route.meta.admin"></appfooter>
    </div>
@endsection
