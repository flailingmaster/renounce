@extends('layouts.app')

@section('content')
<section>
<h1> {{ $report->title }}</h1>
</section>
<section>
<aside> publication_date: </aside><detail>{{ $report->publication_date }}</detail>
<aside>type: </aside><detail>{{ $report->type }}</detail>
<aside>public_inspection_pdf_url: </aside><detail>{{ $report->public_inspection_pdf_url }}</detail>
<aside>html_url: </aside><detail>{{ $report->html_url }}</detail>
<aside>pdf_url: </aside><detail>{{ $report->pdf_url }}</detail>
<aside>title: </aside><detail>{{ $report->title }}</detail>
<aside>excerpts: </aside><detail>{{ $report->excerpts }}</detail>
<aside>agencies: </aside><detail>{{ $report->agencies }}</detail>
<aside>document_number: </aside><detail>{{ $report->document_number }}</detail>
<aside>abstract: </aside><detail>{{ $report->abstract }}</detail>
<aside>full_text_xml_url: </aside><detail>{{ $report->full_text_xml_url }}</detail>
<aside>names: </aside><detail>{{ $report->names }}</detail>
<aside>full_text_xml: </aside><detail>{{ $report->full_text_xml }}</detail>
</section>

@endsection
