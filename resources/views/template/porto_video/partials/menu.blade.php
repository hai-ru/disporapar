<ul class="nav nav-pills" id="mainNav">
    <li class="dropdown">
        <a class="dropdown-item" href="{{ route("/") }}">
            BERANDA
        </a>
    </li>
    <li class="dropdown">
        <a class="dropdown-item" href="{{ url("/".app()->getLocale()."/blog") }}">
            BERITA
        </a>
    </li>
    <li class="dropdown">
        <a class="dropdown-item dropdown-toggle" href="#">
            PROFIL
        </a>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="{{ route("pages","profil-pimpinan") }}">
                    PROFIL PIMPINAN
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route("pages","sambutan-kepala-dinas") }}">
                    SAMBUTAN KEPALA DINAS
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route("pages","struktur-organisasi") }}">
                    STRUKTUR ORGANISASI
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route("pages","profil-dinas") }}">
                    PROFIL DINAS
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route("pages","visi-misi") }}">
                    VISI & MISI
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route("pages","sumber-daya-aparatur") }}">
                    SUMBER DAYA APARATUR
                </a>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a class="dropdown-item dropdown-toggle" href="#">
            DATA LAPORAN
        </a>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="{{ route("pages","data-laporan-ppt") }}">
                    PPT
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route("pages","data-laporan-video") }}">
                    VIDEO
                </a>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a class="dropdown-item dropdown-toggle" href="{{ route("destinations") }}">
            DESTINASI
        </a>
        <ul class="dropdown-menu">
            @foreach (Helper::getCategoryPlace() as $item)    
                <li>
                    <a class="dropdown-item" href="{{ route("destinations",$item->slug) }}">
                        {{$item->name}}
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
    <li class="dropdown">
        <a class="dropdown-item dropdown-toggle" href="#">
            PROMOSI DIGITAL
        </a>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="https://www.instagram.com/disporaparkalbar/">
                    INSTAGRAM
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="https://www.facebook.com/disporapar.kalbar.75">
                    FACEBOOK
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="/">
                    VIRTUAL TOUR
                </a>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a class="dropdown-item dropdown-toggle" href="#">
            KAJIAN
        </a>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="{{ route("collecting",1) }}">
                    Identifikasi Sarana dan Prasarana Digital
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route("collecting",4) }}">
                    Pemasaran Produk Pariwisata
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route("collecting",2) }}">
                    Identifikasi Pengembangan Objek Wisata
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route("collecting",3) }}">
                    Target pasar wisata
                </a>
            </li>
        </ul>
    </li>
</ul>