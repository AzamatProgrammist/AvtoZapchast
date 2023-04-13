@extends('layouts.admin')

@section('title')
    Update Password
@endsection

@section('content')

      <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Parolni o'zgartirish</h4>
              </div>
              <div class="card-body">
                <p class="text-muted">Yangi parolingizni kiriting</p>
                <form method="POST" action="{{ route('admin.users.update', $user->id)}}">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="name">Ismi</label>
                    <input id="name" value="{{ $user->name }}" type="name" class="form-control" name="name" tabindex="1" required autofocus>
                    @error('name') <span style="color: red;">{{ $message }} </span> @enderror
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input id="phone" value="{{ $user->phone }}" type="text" class="form-control" name="phone" tabindex="1" required autofocus>
                    @error('phone') <span style="color: red;">{{ $message }} </span> @enderror
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" value="{{ $user->email }}" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    @error('email') <span style="color: red;">{{ $message }} </span> @enderror
                  </div>

                  <div class="form-group">
                    <label>Roles</label>
                    <select name="roles[]" style="height: 100px;" class="form-control" multiple>
                      @foreach($roles as $role)
                      <option @if(in_array($role->id, $userRoles)) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="password">Yangi parol</label>
                    <input id="password" value="" type="password" class="form-control" name="password" tabindex="1">
                    @error('password') <span style="color: red;">{{ $message }} </span> @enderror
                  </div>  
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Saqlash
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
      

@endsection