@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit <strong>{{$user->first_name}}</strong></h5>

                    </div>

                    <div class="card-body">
                        <form action="{{route('users.update', $user)}}" method="POST">
                            @method('PATCH')
                            @csrf
                            @foreach($types as $type)
                                <div class="form-group form-check">
                                    <input type="checkbox" name="types[]" id="{{$type->id}}" value="{{$type->id}}"
                                           class="form-check-input"
                                           @foreach($user->types as $utype)
                                                @if ($utype->id===$type->id) checked @endif
                                           @endforeach
                                    >
                                    <label for="types[]">{{$type->name}}</label>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary">Save</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

