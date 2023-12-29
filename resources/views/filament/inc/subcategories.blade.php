@foreach ($subcategories as $sub)
    <li class="flex justify-between items-center">
        <span>{{$sub['title']}}</span>
        <span>{{$sub['subCategorySum']}}</span>
    </li>
    @if(!empty($sub['subCategory']))
        <ul class="ml-4 space-y-2">
            @include('filament.inc.subcategories', ['subcategories' => $sub['subCategory']])
        </ul>
    @endif
@endforeach
