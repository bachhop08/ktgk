<x-laptop-layout>
    <x-slot name="title">
        Kết quả tìm kiếm
    </x-slot>

    <h3>Kết quả cho: "{{ $keyword }}"</h3>

    <div class="list-movie">
        @foreach($laptops as $laptop)
            <div class="movie">

                <a href="{{ url('/laptop/chitiet/'.$laptop->id) }}">
                    <img src="{{ asset('storage/image/' . $laptop->image) }}" alt="{{ $laptop->laptop_name }}">
                </a>

                <h6>{{ $laptop->laptop_name }}</h6>
                <p>{{ number_format($laptop->price) }} VNĐ</p>

            </div>
        @endforeach
    </div>

</x-laptop-layout>