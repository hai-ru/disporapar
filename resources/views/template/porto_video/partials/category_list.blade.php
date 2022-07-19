<h5 class="font-weight-semi-bold pt-4">Kategori</h5>
<ul class="nav nav-list flex-column mb-5">
    {{-- {{DD($categories)}} --}}
    @if($categories)
        @include("binshopsblog::partials._category_partial", [
            'category_tree' => $categories,
            'name_chain' => $nameChain = ""
        ])
    @else
        <span>Belum ada Kategori</span>
    @endif
</ul>