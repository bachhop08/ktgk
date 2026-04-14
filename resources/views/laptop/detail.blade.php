<x-laptop-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <div class="row mt-4">
        <div class="col-md-5">
            <img src="{{ asset('storage/image/' . $laptop->hinh_anh) }}" class="img-fluid border">
        </div>
        <div class="col-md-7">
            <h2 style="color: #122333; font-weight:bold">{{ $laptop->ten }} ({{ $laptop->mau_sac }}) </h2>
            <hr>
            <div class="specs">
                <ul class="list-unstyled">
                    <li>CPU: {{ $laptop->cpu }}</li>
                    <li>RAM: {{ $laptop->ram }}</li>
                    <li>Ổ cứng: {{ $laptop->luu_tru }}</li>
                    <li>Chip đồ họa: {{ $laptop->chip_do_hoa }}</li>
                    <li>Nhu cầu: {{ $laptop->nhu_cau }}</li>
                    <li>Màn hình: {{ $laptop->man_hinh }}</li>
                    <li>Hệ điều hành: {{ $laptop->he_dieu_hanh }}</li>
                    <li>Giá: <i class="text-danger" style="font-style: italic;">{{ number_format($laptop->gia) }} VNĐ</i></li>

                </ul>
            </div>

            <form action="{{ url('/them-gio-hang') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="laptop_id" value="{{ $laptop->id }}">
                
                <div class="d-flex align-items-center">
                    <div class="form-group d-flex align-items-center mb-0 mr-3">
                        <label class="mr-2 mb-0" style="white-space: nowrap;">Số lượng mua :</label>
                        <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 80px;">
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="height: 35px; font-weight: bold; padding: 0 15px; font-size: 14px; display: flex; align-items: center;">
                        <i class="fa fa-cart-plus mr-2"></i> THÊM VÀO GIỎ HÀNG
                    </button>
                </div>

                <hr style="border-top: 1px solid #dbdbdb; margin: 20px 0;">

                <p style="font-size: 20px;"><strong>Thông tin khác:</strong></p>
                <ul class="list-unstyled" style="padding-left: 0;">
                    <li>Khối lượng: {{ $laptop->khoi_luong }}</li>
                    <li>Webcam: {{ $laptop->webcam }}</li>
                    <li>Pin: {{ $laptop->pin }}</li>
                    <li>Kết nối không dây: {{ $laptop->ket_noi_khong_day }}</li>
                    <li>Bàn phím: {{ $laptop->ban_phim }}</li>
                    <li>Cổng kết nối: {{ $laptop->cong_ket_noi }}</li>
                </ul>
            </form>
        </div>
    </div>
</x-laptop-layout>