@extends('layouts.app')

@section('content')
<section>
<h1> {{ $name->name }}</h1>
</section>

<section><aside>id:</aside><detail>{{ $name->id }}</detail></section>
<section><aside>name:</aside><detail>{{ $name->name }}</detail></section>
<section><aside>document_number:</aside><detail>{{ $name->document_number }}</detail></section>
<section><aside>service_run:</aside><detail>{{ $service_run }}</detail></section>
<section><aside>raw_count:</aside><detail>{{ $name->raw_count }}</detail></section>
<section><aside>queried:</aside><detail>{{ $name->queried }}</detail></section>
<section><aside>cached_raw:</aside><detail>{{ $name->cached_raw }}</detail></section>

@endsection
