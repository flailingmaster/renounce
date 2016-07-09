@extends('layouts.app')

@section('content')
  <table class="table-borders">
    <thead>
      <tr>
        <th>ID</th>
        <th>Document Number</th>
        <th colspan=2>Name</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($names as $name)
        <tr>
          <td>{{ $name->id }}</td>
          <td>{{ $name->document_number }}</td>
          <td colspan=2>{{ $name->name }}</td>
        </tr>
      @endforeach

    </tbody>
  </table>
@endsection
