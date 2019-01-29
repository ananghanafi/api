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
                                    <label for="Tittle" class="col-md-4 control-label">Tittle</label>
                                    <div class="col-md-6">
                                        <input id="title" type="text" class="form-control" name="tittle" value="{{ old('title') }}" autofocus>
                                        <!-- @if ($errors->has('tittle'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tittle') }}</strong>
                                            </span>
                                        @endif -->
                                    </div>
                            <div>
                                    <label for="Amount" class="col-md-4 control-label">Amount</label>
                                    <div class="col-md-6">
                                        <input id="amount" type="number" class="form-control" name="amount" value="{{ old('amount') }}" autofocus>
                                        <!-- @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif -->
                                    </div>
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
