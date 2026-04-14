<x-laptop-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <div class="mt-4 mb-4 d-flex justify-content-center align-items-center">
        <span class="mr-3" style="font-weight: bold; color: #122333;">Tìm kiếm theo:</span>
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}" class="btn btn-sm btn-outline-secondary mr-2">
            Giá tăng dần
        </a>
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="btn btn-sm btn-outline-secondary">
            Giá giảm dần
        </a>
    </div>

    <div class="container-fluid">
        <div class="row px-4">
            @foreach($laptops as $item)
                <div class="col-custom mb-4">
                    <div class="card h-100 shadow-sm border text-center p-2" style="border-radius: 8px;">
                        <a href="{{ route('laptop.detail', $item->id) }}" class="text-decoration-none">
                            <img src="{{ asset('storage/image/' . $item->hinh_anh) }}" 
                                 alt="{{ $item->ten }}" 
                                 style="height: 150px; width: 100%; object-fit: contain;"
                                 onerror="this.src='{{ asset('image/no-image.png') }}'">
                            
                            <div class="card-body p-1">
                                <div style="font-weight:bold; color: #122333; font-size: 13px; height: 38px; overflow: hidden; line-height: 1.3;">
                                    {{ $item->ten }}
                                </div>
                                <div style="color: #d9534f; font-weight: bold; font-size: 15px; margin-top: 10px;">
                                    <i style="font-style: italic;">{{ number_format($item->gia) }} VNĐ</i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
       
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
        .card:hover {
            border-color: #007bff;
            transform: scale(1.02);
            transition: 0.3s;
        }
    </style>
</x-laptop-layout>