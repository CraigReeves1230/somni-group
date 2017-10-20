@extends('layouts.frontend.main')
@section('title', 'Listings Results')
@section('content')
    <div class="container">
            <div data-listings="{{ json_encode($listings) }}"
                 data-search-query="{{$search_query}}"
                 data-search-type="{{$search_type}}"
                 data-search-link="{{route('listings_search')}}"
                 id="search_results"></div>
    </div>


    <script src="/js/bundle.js"></script>
@endsection