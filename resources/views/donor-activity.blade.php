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
                    <table>
                    <th></th>
                    <tbody>
                    @foreach($da as $activity) 
                        <tr>
                            <td>{{ $activity->id}}</td>
                            <td>{{ $activity->title}}</td>
                            <td>{{ $activity->summary}}</td>
                            <td>{{ $activity->amount}}</td>
                            <td>{{ $activity->currency}}</td>
                            <td>{{ $activity->funding_source}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
