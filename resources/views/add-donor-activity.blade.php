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
                                    <label for="name" class="col-md-4 control-label">Nama Kegiatan</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                                        <!-- @if ($errors->has('tittle'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tittle') }}</strong>
                                            </span>
                                        @endif -->
                                    </div>
                            </div>
                            <div>
                                    <label for="start_date" class="col-md-4 control-label">Tanggal Mulai</label>
                                    <div class="col-md-6">
                                        <input id="start_date" type="date" class="form-control" name="start_date" value="{{ old('start_date') }}" autofocus>
                                        <!-- @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif -->
                                    </div>
                            </div>
                            <div>
                                    <label for="end_date" class="col-md-4 control-label">Tanggal Selesai</label>
                                    <div class="col-md-6">
                                        <input id="end_date" type="date" class="form-control" name="end_date" value="{{ old('end_date') }}" autofocus>
                                        <!-- @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif -->
                                    </div>
                            </div>
                            <div>
                                    <label for="implementing_agency" class="col-md-4 control-label">Ringkasan Kegiatan</label>
                                    <div class="col-md-6">
                                        <input id="implementing_agency" type="text" class="form-control" name="implementing_agency" value="{{ old('implementing_agency') }}" autofocus>
                                        <!-- @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif -->
                                    </div>
                            </div>
                            <div>
                                    <label for="currency" class="col-md-4 control-label">Mata Uang</label>
                                    <div class="col-md-6">
                                    <select class="form-control input-sm" name="currency" value="{{ old('currency') }}">
                                        <option value=1>USD</option>
                                        <option value=2>IDR</option>
                                    </select>
                                    </div>
                            </div>
                            <div>
                                    <label for="amount" class="col-md-4 control-label">Nominal Dana</label>
                                    <div class="col-md-6">
                                        <input id="amount" type="number" class="form-control" name="amount" value="{{ old('amount') }}" >
                                        <!-- @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif -->
                                    </div>
                            </div>
                            <div>
                                    <label for="funding_source" class="col-md-4 control-label">Sumber Dana</label>
                                    <div class="col-md-6">
                                    <select class="form-control input-sm" name="funding_source" value="{{ old('funding_source') }}">
                                        <option value=1>USD</option>
                                        <option value=2>IDR</option>
                                    </select>
                                    </div>
                            </div>
                            <div>
                                    <label for="mandat_id" class="col-md-4 control-label">Relevansi dengan Mandat BRG</label>
                                    <div class="col-md-6">
                                    <select class="form-control input-sm" name="key">
                                        <option value="{{ old('key') }}">National NGO</option>
                                    </select>
                                    </div>
                            </div>
                            <div>
                                    <label for="note" class="col-md-4 control-label">Catatan</label>
                                    <div class="col-md-6">
                                        <input id="note" type="text" class="form-control" name="note"  >
                                        <!-- @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif -->
                                    </div>
                            </div>
                            <div>
                                    <label for="province_id" class="col-md-4 control-label">Provinsi</label>
                                    <div class="col-md-6">
                                    <select class="form-control input-sm" name="provice_id" value="{{old('province_id')}}">
                                        <option value=0>Provinsi</option>
                                    </select>
                                    </div>
                            </div>
                            <div>
                                    <label for="city_id" class="col-md-4 control-label">Kota/Kabupaten</label>
                                    <div class="col-md-6">
                                    <select class="form-control input-sm" name="city_id"value="{{old('city_id')}}">
                                        <option value=0>Kota/Kabupaten</option>
                                    </select>
                                    </div>
                            </div>
                            <div>
                                    <label for="sub_district_id" class="col-md-4 control-label">Kecamatan</label>
                                    <div class="col-md-6">
                                    <select class="form-control input-sm" name="sub_district_id"value="{{old('sub_district_id')}}">
                                        <option value=0>Kecamatan</option>
                                    </select>
                                    </div>
                            </div>
                            <div>
                                    <label for="village" class="col-md-4 control-label">Kecamatan</label>
                                    <div class="col-md-6">
                                    <select class="form-control input-sm" name="village"value="{{old('village')}}">
                                        <option value=0>Village</option>
                                    </select>
                                    </div>
                            </div>
                            <div>
                                    <label for="khg" class="col-md-4 control-label">KHG</label>
                                    <div class="col-md-6">
                                    <select class="form-control input-sm" name="khg"value="{{old('city_id')}}">
                                        <option value=0>Village</option>
                                    </select>
                                    </div>
                            </div>
                            <div>
                                    <label for="x" class="col-md-4 control-label">Latitude</label>
                                    <div class="col-md-6">
                                        <input id="x" type="text" class="form-control" name="x" value="{{old ('x')}}"  >
                                        <!-- @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif -->
                                    </div>
                            </div>
                            <div>
                                    <label for="y" class="col-md-4 control-label">Longitude</label>
                                    <div class="col-md-6">
                                        <input id="y" type="text" class="form-control" name="y" value="{{old('y')}}"  >
                                        <!-- @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif -->
                                    </div>
                            </div>
                            <div>
                                    <label for="note" class="col-md-4 control-label">Catatan</label>
                                    <div class="col-md-6">
                                        <input id="note" type="text" class="form-control" name="note"  >
                                        <!-- @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif -->
                                    </div>
                            </div>
                            <div>
                                    <label for="focal" class="col-md-4 control-label">Document</label>
                                    <div class="col-md-6">
                                        <input id="focal" type="file" class="form-control" name="focal"  autofocus>
                                        <!-- @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif -->
                                    </div>
                            </div>
                            <div>
                                    <label for="focal" class="col-md-4 control-label">Foto Kegiatan</label>
                                    <div class="col-md-6">
                                        <input id="foto" type="file" class="form-control" name="focal" autofocus>
                                        <!-- @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif -->
                                    </div>
                            </div>
                            <br>
                            <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Kirim
                                </button>
                            </div>
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
