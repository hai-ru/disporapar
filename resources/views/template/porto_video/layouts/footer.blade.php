<footer id="footer" class="mt-0">
    <div class="container">
        <div class="footer-ribbon">
            <span>Get in Touch</span>
        </div>
        <div class="row py-5 my-4">
            <div class="col-md-6 mb-4 mb-lg-0">
                <a href="{{ route("/") }}" class="logo pe-0 pe-lg-3">
                    <img alt="Porto Website Template" 
                    src="{{Helper::getThemeAssets()}}img/logo_disporapar_white.svg"
                    class="opacity-7 bottom-4" height="32">
                </a>
                <p class="mb-2 mt-2">Dinas Kepemudaan, Olahraga dan Pariwisata  bertugas melaksanakan urusan Pemerintah Provinsi di Bidang Pemuda, Olahraga, Pariwisata melaksanakan tugas dekonsentrasi dan tugas lainnya yang diserahkan oleh Gubernur sesuai dengan Perundang-undangan yang berlaku.</p>
                <p class="mb-0"><a href="#" class="btn-flat btn-xs text-color-light"><strong class="text-2">VIEW MORE</strong><i class="fas fa-angle-right p-relative top-1 ps-2"></i></a></p>
            </div>
            <div class="col-md-6">
                <h5 class="text-3 mb-3">CONTACT US</h5>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list list-icons list-icons-lg">
                            <li class="mb-1"><i class="far fa-dot-circle text-color-primary"></i><p class="m-0">Jl. Letnan Jendral Sutoyo
                                Parit Tokaya, Pontianak Selatan.
                                Kota Pontianak
                                Kalimantan Barat
                                78113</p></li>
                            <li class="mb-1"><i class="fab fa-whatsapp text-color-primary"></i><p class="m-0"><a href="tel:+6281257609099">+62 812 5760 9099</a></p></li>
                            <li class="mb-1"><i class="far fa-envelope text-color-primary"></i><p class="m-0"><a href="mailto:halo@disporapar.kalbarprov.go.id">halo@disporapar.kalbarprov.go.id</a></p></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list list-icons list-icons-sm">
                            <li><i class="fas fa-angle-right"></i><a href="{{ route("pages","faq") }}" class="link-hover-style-1 ms-1"> FAQ's</a></li>
                            <li><i class="fas fa-angle-right"></i><a href="sitemap.html" class="link-hover-style-1 ms-1"> Sitemap</a></li>
                            <li><i class="fas fa-angle-right"></i><a href="{{route("pages","hubungi-kami")}}" class="link-hover-style-1 ms-1"> Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright footer-copyright-style-2">
        <div class="container py-2">
            <div class="row py-4">
                <div class="col d-flex align-items-center justify-content-center">
                    <p>© Copyright 2022. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>