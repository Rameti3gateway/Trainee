@extends('site::layouts.app')
@section('content')
<h4>PDF Here</h4>
<table>
<tr>
<td><a href="{{url('/site/users/<?php Auth::user()->id ?>/report/checkincheckout'))}}">Checkin&Checkout Report </a></td>
<td><a href="{{url('/site/users/<?php Auth::user()->id ?>/report/todolist'))}}">Todolist Report </a></td>
</tr>
</table>

@endsection
