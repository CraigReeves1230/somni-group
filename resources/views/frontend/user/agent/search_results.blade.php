@extends('layouts.frontend.main')
@section('title', 'Agents - Search Results')
@section('content')

    <div data-records="{{json_encode($records)}}" data-search_query="{{$search_query}}"
         data-search_type="{{$search_type}}" data-search_link="{{route('agent_search')}}"
          id="agent_results"></div>

    <script src="/js/agent_search_results.js"></script>

@endsection