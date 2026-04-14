<x-laptop-layout>
    <x-slot name="title">
        Kết quả tìm kiếm
    </x-slot>

    <div class="container mt-5">
        <h3>Kết quả cho: "{{ $keyword ?? '' }}"</h3>

        <div class="row list-laptop">
            @foreach($laptops as $laptop)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        
                        <a href="{{ url('/laptop/chitiet/'.$laptop->id) }}">
                            <img src="{{ asset('storage/' . $laptop->hinh_anh) }}" 
                                 class="card-img-top p-3" 
                                 alt="{{ $laptop->tieu_de }}"
                                 style="height: 200px; object-fit: contain;"
                                 onerror="this.src='https://via.placeholder.com/200x200?text=No+Image'">
                        </a>

                        <div class="card-body text-center">
                            <h6 class="font-weight-bold">{{ $laptop->tieu_de }}</h6>
                            
                            <p class="text-danger">{{ number_format($laptop->gia, 0, ',', '.') }} VNĐ</p>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $laptops->appends(['keyword' => $keyword ?? ''])->links() }}
        </div>
    </div>
</x-laptop-layout>