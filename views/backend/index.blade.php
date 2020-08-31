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
        <p class="text-gray-600 font-light leading-5 mb-4 text-sm">Lorem ipsum dolor sit amet, consectetur
            adipiscing elit. Proin interdum urna sit amet lorem iaculis, aliquet suscipit sapien venenatis.
            Sed congue vitae velit vitae varius. Mauris egestas consequat mauris sit amet mollis. Proin porta
            tortor in urna tincidunt vehicula. Integer urna nulla, porttitor ac imperdiet eu, mattis vel lacus.
            Sed et porttitor ex. Morbi pellentesque massa a velit gravida, vitae rutrum tortor consequat. Donec
            interdum lacus ut sem consectetur elementum. Proin pellentesque maximus sem sed rhoncus. Cras eget
            neque a nisi posuere mollis vitae vitae magna. Praesent non volutpat sem, a maximus libero. </p>
        <table class="w-full border shadow mb-4">
            <tbody>
                <tr class="border-b bg-cool-gray-100">
                    <th class="text-left whitespace-no-wrap text-sm uppercase font-semibold p-2 px-4">Page Title</th>
                    <th class="text-left whitespace-no-wrap text-sm uppercase font-semibold p-2 px-4">Excerpt</th>
                    <th class="text-left whitespace-no-wrap text-sm uppercase font-semibold p-2 px-4">Updated At</th>
                    <th class="text-left whitespace-no-wrap text-sm uppercase font-semibold p-2 px-4">Created At</th>
                    <th class="text-right whitespace-no-wrap text-sm uppercase font-semibold p-2 px-4">Actions
                    </th>
                </tr>
                </thead>
            <tbody>
                @foreach ($pages as $page)
                <tr class="border-b hover:bg-indigo-100 bg-white {{$loop->last ? 'rounded-b' : ''}}">
                    <td class="p-3 px-4 whitespace-no-wrap font-semibold {{$loop->last ? 'rounded-bl' : ''}}">
                        {{$page->page_title}}</td>
                    <td class="p-3 px-4 w-full whitespace-no-wrap">{{trim(strip_tags($page->page_excerpt))}}</>
                    <td class="p-3 px-4 whitespace-no-wrap">{{$page->updated_at ?? ""}}</td>
                    <td class="p-3 px-4 whitespace-no-wrap">{{$page->created_at}}</td>
                    <td class="p-3 px-4 whitespace-no-wrap text-right flex {{$loop->last ? 'rounded-br' : ''}}">
                        <a href='{{route("paksuco.pages.show", $page->id)}}'
                            class="shadow text-sm bg-gray-500 hover:bg-gray-400
                        whitespace-no-wrap focus:shadow-outline focus:outline-none
                        text-white font-semibold py-1 px-2 mr-1 rounded">View</a>
                        <a href="{{route('paksuco.pages.edit', $page->id)}}"
                            class="shadow text-sm bg-blue-500 hover:bg-blue-400
                        whitespace-no-wrap focus:shadow-outline focus:outline-none
                        text-white font-semibold py-1 px-2 mr-1 rounded">Edit</a>
                        <form class="inline"
                            action="{{route('paksuco.pages.destroy', $page->id)}}"
                            method="POST">
                            @method("DELETE")
                            @csrf
                            <button class="shadow text-sm bg-red-500 hover:bg-red-400
                            whitespace-no-wrap focus:shadow-outline focus:outline-none
                            text-white font-semibold py-1 px-2 rounded">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection