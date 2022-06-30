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
        <a class="dropdown-item dropdown-toggle" href="index.html">
            DESTINASI
        </a>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="index.html">
                    WISATA ALAM
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="index.html">
                    WISATA BUDAYA
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="index.html">
                    MINAT KHUSUS
                </a>
            </li>
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
        <a class="dropdown-item" href="index.html">
            REKAPITULASI
        </a>
    </li>
</ul>