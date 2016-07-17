@extends('layouts.app')

@section('content')
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
      @foreach ($names as $name)
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
<div class="pagination">
{!! $names->render() !!}
</div>
@endsection
