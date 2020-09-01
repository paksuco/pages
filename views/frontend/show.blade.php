@extends($extends)

@section("body")
<div class="my-8 container mx-auto mb-48">
<h1 class="py-8 text-5xl font-semibold">{{$page->page_title}}</h1>
{!!$page->page_content!!}
</div>
@endsection