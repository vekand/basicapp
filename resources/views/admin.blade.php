@extends('main')

@section('title', 'Asign Roles')
@section('stylesheets')
{!! Html::style('css/style2.css') !!}

@endsection
@section('content')
<div class="input-append text-center">
<form action="{{ route('adminfilter') }}" method="GET" style="float: left;">
    <input name="search" id="search" value="{{ $search }}" placeholder="last name" />
    <input type="submit" class="btn btn-primary" name="submit" value="Filter last name">
    </form>
    <form action="{{ route('admin') }}" method="get" style="float:left; display: inline;">
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-primary" name="nofilter" value="No filter">
    </form>
</div>
<table class="table">
    <thead>
        <th>Last Name</th>
        <th>First Name</th>       
        <th>Address</th>
        <th>City</th>
        <th>Teacher</th>
        @if (Auth::user()->prof_id == 1)
        <th>Profesorul</th>
        @endif
        <th>E-Mail</th>
        <th>Prl</th>

        <th>Activ</th>
        <th>-</th>
        <th>Visitor</th>
        <th>Blogger</th>
        <th>Referee</th>
        <th>Teacher</th>
        <th>Student</th>
        <th>Author</th>
        <th>Admin</th>
        @if (Auth::user()->prof_id == 1)
        <th>Super</th>
        @endif
        <th></th>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <form action="{{ route('admin.assign') }}" method="POST">           
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->adresa }}</td>
                <td>{{ $user->oras }}</td>
                <td>{{ $user->prof->nick_name }}</td>
                @if (Auth::user()->prof_id == 1)
                <td><select class="form-control" name="profesor"> 
                    @foreach($profs as $prof) 
                    @if ($prof->id == $user->prof_id)
                    <option value="{{ $prof->id }}" selected="selected">{{ $prof->nick_name }}</option>
                    @else
                    <option value="{{ $prof->id }}">{{ $prof->nick_name }}</option>
                    @endif
                    @endforeach 
                </select></td>
                @endif
                <td>{{ $user->email }} <input type="hidden" name="email" value="{{ $user->email }}">  </td>
                <td>{{ $user->prl }}</td>
                
                    {{-- <td><input type="checkbox"  id="squaredOne" {{ $user->activ==1 ? 'checked' : '' }} name="activ"></td> --}}
                    <td><input type="checkbox" {{ $user->activ == 1 ? 'checked' : '' }} id="checkbox{{ $user->id.'0'}}" class="regular-checkbox" name="activ"/><label for="checkbox{{ $user->id.'0' }}"></label></td>
                    <td>|</td>

                    <td><input type="checkbox" {{ $user->hasRole('Visitor') ? 'checked' : '' }} id="checkbox{{ $user->id.'1' }}" class="regular-checkbox" name="role_visitor"/><label for="checkbox{{ $user->id.'1' }}"></label></td>

                    <td><input type="checkbox" {{ $user->hasRole('Blogger') ? 'checked' : '' }} id="checkbox{{ $user->id.'2' }}" class="regular-checkbox" name="role_blogger"/><label for="checkbox{{ $user->id.'2' }}"></label></td>
     
                    <td><input type="checkbox" {{ $user->hasRole('Referee') ? 'checked' : '' }} id="checkbox{{ $user->id.'3' }}" class="regular-checkbox" name="role_referee"/><label for="checkbox{{ $user->id.'3' }}"></label></td>

                    <td><input type="checkbox" {{ $user->hasRole('Teacher') ? 'checked' : '' }} id="checkbox{{ $user->id.'4' }}" class="regular-checkbox" name="role_teacher"/><label for="checkbox{{ $user->id.'4' }}"></label></td>

                    <td><input type="checkbox" {{ $user->hasRole('Student') ? 'checked' : '' }} id="checkbox{{ $user->id.'5' }}" class="regular-checkbox" name="role_student"/><label for="checkbox{{ $user->id.'5' }}"></label></td>

                    <td><input type="checkbox" {{ $user->hasRole('Author') ? 'checked' : '' }} id="checkbox{{ $user->id.'6' }}" class="regular-checkbox" name="role_author"/><label for="checkbox{{ $user->id.'6' }}"></label></td>

                    <td><input type="checkbox" {{ $user->hasRole('Admin') ? 'checked' : '' }} id="checkbox{{ $user->id.'7' }}" class="regular-checkbox" name="role_admin"/><label for="checkbox{{ $user->id.'7' }}"></label></td>
                    @if (Auth::user()->prof_id == 1 && $user->prof_id == 1)               
                    <td><input type="checkbox" {{ $user->hasRole('Super') ? 'checked' : '' }} id="checkbox{{ $user->id.'8' }}" class="regular-checkbox" name="role_super"/><label for="checkbox{{ $user->id.'8' }}"></label></td>
                    @else
                    <td></td>
                    @endif

                {{ csrf_field() }}
                <td><button type="submit" class="btn btn-success">Assign Roles</button></td>
            </form>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="text-center">
@if ($paginate)
{!! $users->links() !!}
@endif
</div>
@endsection