<h2>Cảm ơn bạn đã đặt hàng!</h2>

<table border="1" cellspacing="0" cellpadding="10">
    <thead>
        <tr style="background: #eee;">
            <th>Tên Laptop</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0; @endphp
        @foreach($data as $item)
        <tr>
            <td>{{ $item->ten }}</td>
            <td>{{ $item->so_luong }}</td>
            <td>{{ number_format($item->don_gia) }}đ</td>
            <td>{{ number_format($item->so_luong * $item->don_gia) }}đ</td>
        </tr>
        @php $total += $item->so_luong * $item->don_gia; @endphp
        @endforeach
        <tr>
            <td colspan="3"><b>Tổng tiền</b></td>
            <td><b>{{ number_format($total) }}đ</b></td>
        </tr>
    </tbody>
</table>