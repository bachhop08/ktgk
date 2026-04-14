<h2>Cảm ơn bạn đã đặt hàng!</h2>
<table border="1" cellspacing="0" cellpadding="10" style="border-collapse: collapse; width: 100%;">
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
            <td>{{ $item['ten_laptop'] }}</td>
            <td align="center">{{ $item['so_luong'] }}</td>
            <td align="right">{{ number_format($item['don_gia'], 0, ',', '.') }}đ</td>
            <td align="right">{{ number_format($item['so_luong'] * $item['don_gia'], 0, ',', '.') }}đ</td>
        </tr>
        @php $total += $item['so_luong'] * $item['don_gia']; @endphp
        @endforeach
        <tr>
            <td colspan="3" align="right"><b>Tổng tiền</b></td>
            <td align="right"><b>{{ number_format($total, 0, ',', '.') }}đ</b></td>
        </tr>
    </tbody>
</table>