@foreach($category_tree as $category)
    @php 
        $lang_id = $lang_id ?? Helper::getLocaleID();
        $trans =  $category->categoryTranslations->where('lang_id',$lang_id)->first();
    @endphp
    @if($trans != null)
        <li class="nav-item">
            @php $nameChain = $nameChain .'/'. $trans->slug @endphp

            <a 
                href="{{route("binshopsblog.view_category",[$locale, $nameChain ])}}"
                class="nav-link"
            >
                 <span class="category-item" value='{{$category->category_id}}'>

                    {{$trans->category_name}}
                    ({{$trans->category->posts->count()}})

                     @if( count($category->siblings) > 0)
                        <ul>
                            @include("binshopsblog::partials._category_partial", [
                                'category_tree' => $category->siblings,
                                'name_chain' => $nameChain
                            ])
                        </ul>
                     @endif
                 </span>
            </a>
        </li>
    @endif
@endforeach
