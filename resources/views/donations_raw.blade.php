@foreach ($donations as $donation)
"{{$donation->name->name}}",
"{{$donation->name->document_number}}",
"{{$donation->name->report->publication_date}}",
"{{$donation->raw_name}}",
"{{$donation->donation_date}}",
"{{$donation->location}}",
"{{$donation->occupation}}",
"{{$donation->amount}}",
"{{$donation->recipient}}"<br>
@endforeach
