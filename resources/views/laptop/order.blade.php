<x-laptop-layout>
    <x-slot name="title">Giỏ hàng</x-slot>

    <style>
        .cart-table { border-collapse: collapse; width: 100%; margin-top: 20px; background: #fff; }
        .cart-table th, .cart-table td { border: 1px solid #dee2e6; padding: 12px; }
        .cart-table th { background-color: #f8f9fa; text-align: center; }
        .total-section { background: #fff; padding: 20px; border: 1px solid #dee2e6; margin-top: -1px; }
    </style>

    <div class="container mt-4">
        <h3 class="text-center font-weight-bold text-primary mb-4">GIỎ HÀNG CỦA BẠN</h3>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <table class="cart-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Laptop</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Xoá</th>
                </tr>
            </thead>
            <tbody>
                @php $tongTien = 0; @endphp
                @forelse($data as $key => $item)
                    @php 
                        $qty = $quantity[$item->id];
                        $thanhTien = $item->gia * $qty;
                        $tongTien += $thanhTien;
                    @endphp
                    <tr>
                        <td align="center">{{ $key + 1 }}</td>
                        <td><strong>{{ $item->ten }}</strong></td>
                        <td align="center">{{ $qty }}</td>
                        <td align="center">{{ number_format($item->gia, 0, ',', '.') }}đ</td>
                        <td align="center" class="text-danger font-weight-bold">{{ number_format($thanhTien, 0, ',', '.') }}đ</td>
                        <td align="center">
                            <form method="POST" action="{{ route('cartdelete') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xóa sản phẩm này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" align="center" class="py-4">Giỏ hàng trống!
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if(count($data) > 0)
            <div class="total-section text-right">
                <h5>Tổng cộng: <span class="text-danger font-weight-bold">{{ number_format($tongTien, 0, ',', '.') }}đ</span></h5>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-md-5 p-4 border bg-white shadow-sm">
                    <h5 class="text-center mb-3">THÔNG TIN THANH TOÁN</h5>
                    <form method="POST" action="{{ route('ordercreate') }}">
                        @csrf
                        <div class="form-group">
                            <label>Hình thức thanh toán:</label>
                            <select name="hinh_thuc_thanh_toan" class="form-control">
                                <option value="1">Tiền mặt (COD)</option>
                                <option value="2">Chuyển khoản</option>
                                <option value="3">VNPay</option>
                            </select>
                        </div>
                        @auth
                            <button type="submit" class="btn btn-primary btn-block">XÁC NHẬN ĐẶT HÀNG</button>
                        @else
                            <div class="alert alert-warning text-center">Vui lòng <a href="{{ route('login') }}">Đăng nhập</a> để đặt hàng</div>
                        @endauth
                    </form>
                </div>
            </div>
        @endif
    </div>
</x-laptop-layout>