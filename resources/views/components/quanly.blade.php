<x-laptop-layout>
    <x-slot name="title">Quản lý sản phẩm</x-slot>

    <div class="mt-4 mb-5">
        <h3 class="text-center text-primary font-weight-bold text-uppercase mb-4">QUẢN LÝ SẢN PHẨM</h3>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        <table id="productTable" class="table table-striped table-bordered table-hover w-100">
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>CPU</th>
                    <th>RAM</th>
                    <th>Ổ cứng</th>
                    <th>Khối lượng</th>
                    <th>Nhu cầu</th>
                    <th>Giá</th>
                    <th>Ảnh</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->tieu_de }}</td>
                    <td>{{ $product->cpu }}</td>
                    <td>{{ $product->ram }}</td>
                    <td>{{ $product->luu_tru }}</td>
                    <td>{{ $product->khoi_luong }} kg</td>
                    <td>{{ $product->ten_danh_muc }}</td> 
                    <td class="text-danger font-weight-bold">{{ number_format($product->gia, 0, ',', '.') }} đ</td>
                    <td class="text-center">
                        <img src="{{ asset("storage/image/$product->hinh_anh") }}" alt="Laptop" width="60">
                    </td>
                    <td class="text-center" style="min-width: 100px;">
                        <a href="{{ url("/laptop/chitiet/$product->id") }}" class="btn btn-primary btn-sm mb-1">Xem</a>
                        
                        <form action="{{ url("/quanly/xoa/$product->id") }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#productTable').DataTable({
                pageLength: 10, 
                language: {
                    zeroRecords: "Không có sản phẩm nào" 
                },
                columnDefs: [
                    { orderable: false, targets: [7, 8] } 
                ]
            });
        });
    </script>
</x-laptop-layout>