@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Menu</div>

                <div class="card-body">
                    <ul>
                        <li><a href="{{url('/donor-mapping')}}">Donor Activity</a></li>
                        <li><a href="{{url('/donor-report')}}">Report<a></li>
                        <li><a href="{{url('/add-donor')}}">Tambah Donor</a></li>
                        <li><a href="{{url('/add-donor-activity')}}">Tambah Activity</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Donor Activity</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('add-donor') }}">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
                            <div >
                                    <label for="Country" class="col-md-4 control-label">Country</label>
                                    <div class="col-md-6">
                                        <input id="country" type="text" class="form-control" name="country" value="{{ old('country') }}" autofocus>
                                        <!-- @if ($errors->has('tittle'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tittle') }}</strong>
                                            </span>
                                        @endif -->
                                    </div>
                            </div>
                            <div>
                                    <label for="Nama" class="col-md-4 control-label">Name of Institution</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                                        <!-- @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif -->
                                    </div>
                            </div>
                            <div>
                                    <label for="upload" class="col-md-4 control-label">Upload Logo</label>
                                    <div class="col-md-6">
                                        <input id="upload" type="file" class="form-control" name="upload[]" value="{{ old('upload') }}" >
                                        <!-- @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif -->
                                    </div>
                            </div>
                            <div>
                                    <label for="key" class="col-md-4 control-label">Key Activity</label>
                                    <div class="col-md-6">
                                    <select class="form-control input-sm" name="key">
                                        <option value="{{ old('key') }}">National NGO</option>
                                        <option value="{{ old('key') }}">International NGO</option>
                                        <option value="{{ old('key') }}">Bilateral</option>
                                        <option value="{{ old('key') }}">Trust Fund</option>
                                        <option value="{{ old('key') }}">University</option>
                                        <option value="{{ old('key') }}">Implementing Partner/Contractor</option>
                                        <option value="{{ old('key') }}">Government</option>
                                        <option value="{{ old('key') }}">Development Bank</option>
                                        <option value="{{ old('key') }}">Research Center</option>
                                        <option value="{{ old('key') }}">Institution</option>
                                        <option value="{{ old('key') }}">Konsorsium</option>
                                        <option value="{{ old('key') }}">Multilateral</option>
                                        <option value="{{ old('key') }}">Other</option>
                                    </select>
                                    </div>
                            </div>
                            <div>
                                    <label for="focal" class="col-md-4 control-label">Focal Point to BRG</label>
                                    <div class="col-md-6">
                                        <input id="focal" type="text" class="form-control" name="focal" value="{{ old('focal') }}" autofocus>
                                        <!-- @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif -->
                                    </div>
                            </div>
                            <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Kirim
                                </button>
                            </div>
                    </form>
                    </div>
                    </div>
                    <table>
                    <th></th>
                    <tbody>
                    <!-- @foreach($da as $activity) 
                        <tr>
                            <td>{{ $activity->id}}</td>
                            <td>{{ $activity->title}}</td>
                            <td>{{ $activity->summary}}</td>
                            <td>{{ $activity->amount}}</td>
                            <td>{{ $activity->currency}}</td>
                            <td>{{ $activity->funding_source}}</td>
                        </tr>
                    @endforeach -->

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
