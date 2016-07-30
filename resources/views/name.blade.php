@extends('layouts.app')

@section('content')
<section>
<h1> {{ $name->name }}</h1>
</section>

<section><aside>id:</aside><detail>{{ $name->id }}</detail></section>
<section><aside>name:</aside><detail>{{ $name->name }}</detail></section>
<section><aside>document_number:</aside><detail><a href=/report/{{$name->report->id}}>{{ $name->document_number }}</a></detail></section>
<section><aside>document publication date:</aside><detail>{{$name->report->publication_date}}</detail></section>
<section><aside>service_run:</aside><detail>{{  ($service_run) ? "True" : "False"  }}</detail></section>
<section><aside>raw_count:</aside><detail>{{ $name->raw_count }}</detail></section>
<section><aside>queried:</aside><detail>{{ $name->queried }}</detail></section>
@if ($name->raw_count == 0)
<section><aside>cached_raw:</aside><detail>{{ $name->cached_raw }}</detail></section>
@endif
@if ($name->raw_count != 0)
<h2>Raw Donations from Open Secrets</h2>
<table class="table-borders">
  <thead>
    <tr>
    <th>name</th>
    <th>location</th>
    <th>occupation</th>
    <th>date</th>
    <th>amount</th>
    <th>recipient</th>
    </tr>
  </thead>
  <tbody>
@foreach($parsed_donations as $row)
  <tr><td>{{ $row->name }}</td>
  <td>{{ $row->location }}</td>
  <td>{{ $row->occupation }}</td>
  <td>{{ $row->date }}</td>
  <td>{{ $row->amount }}</td>
  <td>{{ $row->recipient }}</td></tr>
@endforeach
</tbody>
</table>
@endif
@endsection
