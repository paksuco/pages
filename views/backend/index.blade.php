@extends($extends)
@section("content")
<div class="p-8 bg-white border-t">
    <div class="w-full items-end">
        <div class="flex">
            <div class="w-2/3">
                <h2 class="text-3xl font-semibold mb-3" style="line-height: 1em">@lang("Static Pages")</h2>
            </div>
            <div class="w-1/3 text-right">
                <a href="{{route('paksuco.pages.create')}}"
                    class="shadow bg-indigo-500 hover:bg-indigo-400 whitespace-no-wrap
                focus:shadow-outline focus:outline-none text-white font-normal
                py-2 px-3 rounded">
                    <i class="fa fa-plus mr-2"></i>Create a new Page
                </a>
            </div>
        </div>
        @include('pages-ui::backend.submitresults')
        <p class="text-gray-600 font-light leading-5 mb-4 text-sm">Lorem ipsum dolor sit amet, consectetur
            adipiscing elit. Proin interdum urna sit amet lorem iaculis, aliquet suscipit sapien venenatis.
            Sed congue vitae velit vitae varius. Mauris egestas consequat mauris sit amet mollis. Proin porta
            tortor in urna tincidunt vehicula. Integer urna nulla, porttitor ac imperdiet eu, mattis vel lacus.
            Sed et porttitor ex. Morbi pellentesque massa a velit gravida, vitae rutrum tortor consequat. Donec
            interdum lacus ut sem consectetur elementum. Proin pellentesque maximus sem sed rhoncus. Cras eget
            neque a nisi posuere mollis vitae vitae magna. Praesent non volutpat sem, a maximus libero. </p>
        @livewire('paksuco-table::table', ['class' => new \Paksuco\Pages\Tables\PagesTable()])
    </div>
</div>
@endsection