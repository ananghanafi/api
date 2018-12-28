@extends('header')
@section('content')

<div class="col-md-8">
<div class="card card-default">
    <div class="card-header">
        <form action="peran" method="get">
            <select name="role_id" onchange="submit();">
                @foreach($roles as $rol)
                <option value="{{ $rol->id }}" @if($rol->id == $role->id) {{'selected'}} @endif >{{$rol->display_name}}</option>
                @endforeach
            </select>
        </form>
        
<div class="card-body">

            <form action="perans" method="get" class="form-horizontal">
<fieldset>
    <!-- Multiple Checkboxes -->
    @foreach($groups as $group)
    <div class="form-group row">
        <label class="col-md-3 control-label" for="permissions">{{$group->display_name}}</label>
        <div class="col-md-9">
            @foreach($group->permissions as $perm)
                <div class="checkbox">
                    <label>
                        <input @if(count($perm->roles)){{ "checked"}} @endif name="perms[]" type="checkbox" value="{{$perm->id}}"> {{ $perm->display_name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
    @endforeach
    
    <!-- Button -->
    <div class="form-group row">
        <div class="col-md-12">
            <input type="hidden" name="role_id" value="{{$role->id}}"/>
            <button type="submit" id="savebutton" name="savebutton" class="btn btn-success">Simpan</button>
        </div>
    </div>

</fieldset>
</form>
</div>
</div>
@endsection
