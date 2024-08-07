    @php
        use App\Models\Tb_ebook;
        $ebook = Tb_ebook::orderBy('created_at', 'desc')->paginate(10);
    @endphp
    <div>
        <div class="container">
            <section id="recent-blog-posts" class="recent-blog-posts">
                <div class="" data-aos="fade-up">
                    <div class="row">
                        @foreach ($ebook as $item)
                            <div class="col-lg-3">
                                <div class="card shadow border-0 mb-2">
                                    <div class="card-body">
                                        <center>
                                            <div class=""><img src="{{ $item->gambar() }}" class="rounded"
                                                    style="height: 200px; width: 100%; object-fit: cover;"
                                                    alt="">
                                            </div>
                                            <br>
                                            <h6 class=""><b> {{ Str::limit($item->judul, 50) }} </b></h6>
                                            <a href="/ebook/{{ $item->kategoriEbook->nama }}/{{ $item->slug }}"
                                                class="readmore stretched-link mt-auto">
                                            </a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <br>
                <center>
                    {!! $ebook->links() !!}
                </center>
            </section>
        </div>
    </div>
