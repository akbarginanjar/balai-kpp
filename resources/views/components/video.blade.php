@php
    use App\Models\Tb_video;
    $video = Tb_video::orderBy('created_at', 'desc')->paginate(10);
@endphp
<div>
    <div class="container">
        <section id="recent-blog-posts" class="recent-blog-posts">
            <div class="" data-aos="fade-up">
                <div class="row">
                    @foreach ($video as $item)
                        <div class="col-lg-4">
                            <div class="post-box">
                                <div class="post-img"><img
                                        src="https://img.youtube.com/vi/{{ $item->link }}/hqdefault.jpg"
                                        class="img-fluid" alt=""></div>
                                {{-- <span class="post-date"></span> --}}
                                <h5 class="post-title">{{ Str::limit($item->judul, 50) }}</h5>
                                <a href="/video/{{ $item->slug }}" class="readmore stretched-link mt-auto"><span>Lihat
                                        Video</span><i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <br>
            <center>
                {!! $video->links() !!}
            </center>
        </section>
    </div>
</div>
