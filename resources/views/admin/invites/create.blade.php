@extends('admin.layouts.app')
@section('content')

    <div class="form-group ">
        <h1> Invite user</h1>

        <a class="btn btn-warning" href="{{route('users.index')}}">Back</a>
    </div>

    <div class="card">

        <form action="{{route('invite.store')}}" method="POST" class="d-inline-block">
            {{csrf_field()}}

            <div class="card-body">

                <div class="form-group">
                    @if ($errors->has('email'))

                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <label for="email" class="control-label">Invite email</label>
                    <input type="email"
                           class="form-control"
                           id="email"
                           placeholder="Enter email"
                           name="email"
                           value="">
                </div>

                <div class="border-top">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">Send invite</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection