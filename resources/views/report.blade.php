@extends('layouts.app')

@section('content')
<section>
<h1> {{ $report->title }}</h1>
</section>

<section><aside> publication_date: </aside><detail>{{ $report->publication_date }}</detail></section>
<section><aside>type: </aside><detail>{{ $report->type }}</detail></section>
<section><aside>public_inspection_pdf_url: </aside><detail>{{ $report->public_inspection_pdf_url }}</detail></section>
<section><aside>html_url: </aside><detail>{{ $report->html_url }}</detail></section>
<section><aside>pdf_url: </aside><detail>{{ $report->pdf_url }}</detail></section>
<section><aside>title: </aside><detail>{{ $report->title }}</detail></section>
<section><aside>excerpts: </aside><detail>{{ $report->excerpts }}</detail></section>
<section><aside>agencies: </aside><detail>{{ $report->agencies }}</detail></section>
<section><aside>document_number: </aside><detail>{{ $report->document_number }}</detail></section>
<section><aside>abstract: </aside><detail>{{ $report->abstract }}</detail></section>
<section><aside>full_text_xml_url: </aside><detail>{{ $report->full_text_xml_url }}</detail></section>


<table class="table-borders">
  <thead>
    <tr>
      <th>ID</th>
      <th>Document Number</th>
      <th colspan=2>Name</th>
      <th>Donation Count</th>
      <th>Queried?</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($report->names as $name)
      <tr>
        <td><a href=/name/{{ $name->id }}>{{ $name->id }}</a></td>
        <td>{{ $name->document_number }}</td>
        <td colspan=2><a href=/name/{{ $name->id }}>{{ $name->name }}</a></td>
        <td>{{ $name->raw_count }}</td>
        <td>{{ $name->queried }}</td>
      </tr>
    @endforeach

  </tbody>
</table>

@endsection
