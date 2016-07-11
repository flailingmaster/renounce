@extends('layouts.app')

@section('content')
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
