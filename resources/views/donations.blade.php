@extends('layouts.app')

@section('content')
<table>
    <thead>
      <td>raw_name</td>
  <td>donation_date</td>
  <td>location</td>
  <td>occupation</td>
  <td>amount</td>
  <td>recipient</td>
</thead>
  @foreach ($donations as $donation)
    <tr>
    <td><a href=/name/{{$donation->name_id}}>{{$donation->raw_name}}</a></td>
    <td>{{$donation->donation_date}}</td>
    <td>{{$donation->location}}</td>
    <td>{{$donation->occupation}}</td>
    <td>{{$donation->amount}}</td>
    <td>{{$donation->recipient}}</td>
    </tr>
  @endforeach
</table>
<div class="pagination">
{!! $donations->render() !!}
</div>
@endsection
