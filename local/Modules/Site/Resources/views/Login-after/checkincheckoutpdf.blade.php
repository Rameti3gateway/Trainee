@extends('site::layouts.app')
@section('content')
<h4>PDF Here</h4>
<td><a href="{{url('/site/users/<?php Auth::user()->id ?>/report/checkincheckout'))}}">Checkin&Checkout Report </a></td>

@endsection
