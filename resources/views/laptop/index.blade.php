<x-laptop-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <div class="mt-3 mb-3 d-flex justify-content-center align-items-center">
    <span class="mr-3" style="font-weight: bold;">Tìm kiếm theo:</span>

    <a href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}" class="btn btn-sm btn-outline-secondary mr-2">
        Giá tăng dần
    </a>

    <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="btn btn-sm btn-outline-secondary">
        Giá giảm dần
    </a>
</div>

    <div class="list-laptop">
        @foreach($laptops as $item)
            <div class="laptop">
                <a href="{{ route('laptop.detail', $item->id) }}">
                    <img src="{{ asset('storage/app/public/image/' . $item->hinh_anh) }}" alt="{{ $item->ten }}" style="width:100%; height: 150px; object-fit: contain; padding: 5px;">
                    <div class="laptop-info p-2 text-left">
                        <div style="font-weight:bold; color: #122333; font-size: 13px; height: 34px; overflow: hidden;">
                            {{ $item->ten }}
                        </div>
                        <div style="color: #d9534f; font-weight: bold; font-size: 14px; margin-top: 5px;">
                            <i style="font-style: italic;">{{ number_format($item->gia) }} đ</i>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</x-laptop-layout>