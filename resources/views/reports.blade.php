@extends('layouts.app')

@section('content')
<section>
<h1>Summary</h1>

<section><aside>Total number of reports:</aside><detail>{{ $num_reports }}</detail></section>
<section><aside>Number of reports with 0 names:</aside><detail> {{ $num_empty_reports->count }}</detail></section>
<section><aside>Total number of names:</aside><detail>{{ $num_names }}</detail></section>
<section><aside>Number of names with donations:</aside><detail>{{ $names_w_donations }}</detail></section>
<section><aside>Total number of donations:</aside><detail>{{ $num_donations }}</detail></section>
<section><aside>Names unqueried:</aside><detail>{{ $num_unqueried }}</detail></section>
</section>
<section>
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
</section>
@endsection
