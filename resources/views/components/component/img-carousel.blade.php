@props(['id', 'height' => '500px'])

@push('styles')
    <style>
        .carousel-inner {
            background-color: grey;
        }

        .carousel-item img {
            width: 100%;
            height: {{ $height }};
            object-fit: contain;
        }

        .carousel-thumbnails {
            margin-top: 10px;
        }

        .carousel-thumbnails img {
            width: 75px;
            height: 75px;
            object-fit: cover;
            cursor: pointer;
            opacity: 0.5;
            transition: opacity 0.3s;
        }

        .carousel-thumbnails img:hover,
        .carousel-thumbnails img.active {
            opacity: 1;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            const carousel = document.getElementById('{{ $id }}');

            const images = document.querySelectorAll('.carousel-item img');

            images.forEach((image, index) => {
                $('#{{ $id }}Thumbnails').append(
                    `<img src="${image.src}" alt="${image.alt}" class="mx-1" data-bs-target="#{{ $id }}" data-bs-slide-to="${index}">`
                );

            });

            carousel.addEventListener('slide.bs.carousel', function(e) {
                thumbnails.forEach(thumb => thumb.classList.remove('active'));
                thumbnails[e.to].classList.add('active');
            });

            const thumbnails = document.querySelectorAll('.carousel-thumbnails img');

            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    thumbnails.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
@endpush

<div class="mb-3">
    <div id="{{ $id }}" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner rounded">
            {{-- <div class="carousel-item active">
                <img src="https://via.placeholder.com/400x500?text=Contoh+1" class="d-block" alt="Contoh 1">
            </div> --}}
            {{ $slot }}
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#{{ $id }}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#{{ $id }}" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="carousel-thumbnails d-flex justify-content-center" id="{{ $id }}Thumbnails">

    </div>
</div>
