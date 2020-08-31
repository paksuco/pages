@extends($extends)

@section("body")
<div class="my-8 container">
<h1 class="font-alternative px-6 text-3xl font-semibold mb-6">{{$page->page_title}}</h1>
{!!$page->page_content!!}
</div>
@endsection