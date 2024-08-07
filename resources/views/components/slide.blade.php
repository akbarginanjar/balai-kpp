@php
use App\Models\Tb_slide;
$slide = Tb_slide::all();
@endphp
<div>
    <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ($slide as $key => $item)
                    <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="{{ $key }}"
                        class="{{ $key == 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide 1">
                        <img class="img-fluid" src="{{ $item->gambar() }}" alt="Image">
                    </button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach ($slide as $key => $item)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img class="w-100" src="{{ $item->gambar() }}" alt="Image">
                        <div class="carousel-caption">
                            <div class="p-3" style="max-width: 900px;">
                                {{-- <h4 class="text-white text-uppercase mb-4 animated zoomIn">We Are Leader In</h4> --}}
                                <h1 class="display-1 text-white mb-0 animated zoomIn">{{ $item->deskripsi }}
                                </h1>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
