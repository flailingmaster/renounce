@extends('layouts.app')

@section('content')
  <table>
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
          <td>{{ $report->id }}</td>
          <td>{{ $report->publication_date }}</td>
          <td>{{ $report->document_number }}</td>
          <td colspan=2>{{ $report->title }}</td>
          <td>flailing</td>
        </tr>
      @endforeach

    </tbody>
  </table>
@endsection
