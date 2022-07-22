{{-- @extends("layouts.app",['title'=>$title]) --}}
@extends('template.porto_video.layouts.master')
@section("content")

<div role="main" class="main">

    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-self-center p-static order-2 text-center">
                    <h1 class="text-dark font-weight-bold text-8">Hasil Pencarian : {{$query}}</h1>
                    @if(\Auth::check() && \Auth::user()->canManageBinshopsBlogPosts())
                        <div class="text-center">
                            <p class='mb-1'>You are logged in as a blog admin user.
                                <br>
                                <a href='{{route("binshopsblog.admin.index")}}'
                                class='btn border  btn-outline-primary btn-sm '>
                                    <i class="fa fa-cogs" aria-hidden="true"></i>
                                    Go To Blog Admin Panel</a>
                            </p>
                        </div>
                    @endif
                </div>
                <div class="col-md-12 align-self-center order-1">
                    <ul class="breadcrumb d-block text-center">
                        <li><a href="{{ route("/") }}">BERANDA</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-4">
        <div class="row">
            <div class="col-lg-3 order-lg-2">
                <aside class="sidebar">
                    @include("template.porto_video.partials.search_forms")
                    @include("template.porto_video.partials.category_list")
                    @include("template.porto_video.partials.recent_populer")
                </aside>
            </div>
            <div class="col-lg-9 order-lg-1">
                <p>Tentang {{$query}} : {{count($search_results)}} hasil pencarian</p>
                <div class="row">
                    @forelse($search_results as $result)
                        @if(isset($result->indexable))
                            <?php $post = $result->indexable; ?>
                            @if($post && is_a($post,\BinshopsBlog\Models\BinshopsPostTranslation::class))
                                @include("binshopsblog::partials.index_loop")
                            @else

                                <div class='alert alert-danger'>Unable to show this search result - unknown type</div>
                            @endif
                        @endif
                    @empty
                        <div class='col-md-12 alert alert-danger'>Sorry, but there were no results!</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
