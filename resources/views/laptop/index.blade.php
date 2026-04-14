<x-laptop-layout>
    <x-slot name="title">
        Kết quả tìm kiếm
    </x-slot>

    <div class="container-fluid mt-4 mb-5">
        
        <div class="d-flex justify-content-between align-items-center mb-4 px-4">
            <h3>
                @if(!empty($keyword))
                    Kết quả cho: <span class="text-primary">"{{ $keyword }}"</span>
                @else
                    Tất cả sản phẩm
                @endif
            </h3>
            @if(empty($keyword))
            <div class="d-flex align-items-center">
                <span class="mr-3" style="font-weight: bold; color: #122333;">Sắp xếp theo:</span>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}" class="btn btn-sm btn-outline-secondary mr-2">
                    Giá tăng dần
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="btn btn-sm btn-outline-secondary">
                    Giá giảm dần
                </a>
            </div>
            @endif
        </div>

        <div class="list-laptop">
            @forelse($laptops as $item)
                    <div >
                        <a href="{{ route('laptop.detail', $item->id) }}" class="text-decoration-none">
                            
                            <img src="{{ asset('storage/image/' . $item->hinh_anh) }}" 
                                 alt="{{ $item->tieu_de }}" 
                                 class="card-img-top p-2"
                                 style="height: 160px; width: 100%; object-fit: contain;"
                                 onerror="this.src='{{ asset('images/no-image.png') }}'">
                            
                            <div class="card-body p-1 mt-2">
                                <div style="font-weight:bold; color: #122333; font-size: 14px; height: 42px; overflow: hidden; line-height: 1.4;">
                                    {{ $item->tieu_de }}
                                </div>
                                <div style="color: #d9534f; font-weight: bold; font-size: 16px; margin-top: 10px;">
                                    <i style="font-style: italic;">{{ number_format($item->gia, 0, ',', '.') }} VNĐ</i>
                                </div>
                            </div>
                        </a>
                </div>
            @empty
                <div class="col-12 text-center mt-5">
                    <h5 class="text-muted">Không tìm thấy sản phẩm nào phù hợp.</h5>
                </div>
            @endforelse
        </div>

    </div>

    <style>
        /* Responsive chia cột */
        @media (min-width: 992px) {
            .col-custom {
                flex: 0 0 20%;
                max-width: 20%;
                padding: 10px;
            }
        }
      
        @media (max-width: 991px) {
            .col-custom {
                flex: 0 0 33.333%;
                max-width: 33.333%;
                padding: 10px;
            }
        }
        @media (max-width: 576px) {
            .col-custom {
                flex: 0 0 50%;
                max-width: 50%;
                padding: 5px;
            }
        }

        /* Hiệu ứng di chuột */
        .card:hover {
            border-color: #007bff !important;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
            transition: all 0.3s ease;
        }
    </style>
</x-laptop-layout>