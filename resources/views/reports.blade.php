@extends('layouts.app')

@section('content')
<h1>Summary</h1>

<section><aside>num_reports:</aside><detail>{{ $num_reports }}</detail></section>
<section><aside>names_w_donations:</aside><detail>{{ $names_w_donations }}</detail></section>
<section><aside>num_names:</aside><detail>{{ $num_names }}</detail></section>
<br><br>
<h1>Details</h1>

  <table class="table-borders">
    <thead>
      <tr>
        <th>ID</th>
        <th>Publication Date</th>
        <th>Document Number</th>
        <th colspan=2>Title</th>
        <th>Names Count</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($reports as $report)
        <tr>
          <td><a href=/report/{{ $report->id }}>{{ $report->id }}</a></td>
          <td>{{ $report->publication_date }}</td>
          <td><a href=/report/{{ $report->id }}>{{ $report->document_number }}</a></td>
          <td colspan=2><a href=/report/{{ $report->id }}>{{ $report->title }}</a></td>
          <td>{{ $report->names()->count() }}</td>
        </tr>
      @endforeach

    </tbody>
  </table>
@endsection
