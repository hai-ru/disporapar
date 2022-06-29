<h5 class="font-weight-semi-bold pt-4">Kategori</h5>
                    <ul class="nav nav-list flex-column mb-5">
                        @if($categories)
                            @include("binshopsblog::partials._category_partial", [
                                'category_tree' => $categories,
                                'name_chain' => $nameChain = "",
                                'lang_id' => $post->lang_id
                            ])
                        @else
                            <span>Belum ada Kategori</span>
                        @endif
                    </ul>