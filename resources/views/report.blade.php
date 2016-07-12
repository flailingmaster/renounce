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
      <th colspan=2>Name</th>
    </tr>
  </thead>
  <tbody>
@foreach ($report->names as $name)
    <tr><td>{{ $name->id }}</td><td colspan=2>{{ $name->name }}</td></tr>
@endforeach
  </tbody>
</table>
@endsection
