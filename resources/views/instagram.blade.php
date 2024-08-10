@extends('layouts.member')

@section('content')
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .gradient-btn {
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
            border: none;
            color: white;
            padding: 10px 20px;
            width: 100%;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            transition: background 0.3s ease-in-out;
            border-radius: 25px;
        }

        .gradient-btn:hover {
            background: linear-gradient(45deg, #bc1888 0%, #cc2366 25%, #dc2743 50%, #e6683c 75%, #f09433 100%);
        }

        
    </style>
    <br><br><br>
    <div class="container py-3">
        <div class="container">
            <h5 class="text-center text--primary mb-4 mt-5">Konten Instagram</h5>
            <div class="row">
                @foreach ($posts as $post)
                <div class="col-md-3 mb-3">
                    <div class="card shadow border-0" style="border-radius: 20px; height: 450px;">
                        <div class="card-body">
                            @if ($post['media_type'] === 'IMAGE')
                                <img src="{{ $post['media_url'] }}" class="card-img-top"
                                     style="border-radius: 10px; height: 300px; object-fit: cover;">
                            @elseif ($post['media_type'] === 'VIDEO')
                                <video controls class="card-img-top" style="border-radius: 10px; height: 300px;">
                                    <source src="{{ $post['media_url'] }}" type="video/mp4">
                                </video>
                            @elseif ($post['media_type'] === 'CAROUSEL_ALBUM')
                                <div id="carousel-{{ $post['id'] }}" class="carousel slide">
                                    <div class="carousel-inner">
                                        @foreach ($post['carousel_media'] as $index => $media)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                @if ($media['media_type'] === 'IMAGE')
                                                    <img src="{{ $media['media_url'] }}" class="d-block w-100"
                                                         style="border-radius: 10px; height: 300px; object-fit: cover;">
                                                @elseif ($media['media_type'] === 'VIDEO')
                                                    <video controls class="d-block w-100" style="border-radius: 10px; height: 300px;">
                                                        <source src="{{ $media['media_url'] }}" type="video/mp4">
                                                    </video>
                                                @endif
                                            </div>
                                        @endforeach
                                        <a class="carousel-control-prev" href="#carousel-{{ $post['id'] }}" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carousel-{{ $post['id'] }}" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ Str::limit($post['caption'], 27) }}.</p>
                            <a href="{{ $post['permalink'] }}" target="_blank" class="btn btn-primary gradient-btn">Show Content</a>
                        </div>
                    </div>
                </div>
            @endforeach
            

            </div>
        </div>
    </div>
@endsection
