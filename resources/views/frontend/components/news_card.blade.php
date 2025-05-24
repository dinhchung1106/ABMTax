<div class="card news-card h-100">
    <img src="{{ $item->image }}" class="card-img-top" alt="{{ $item->title }}">
    <div class="card-body">
        <h5 class="card-title fw-bold">{{ $item->title }}</h5>
        <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 100) }}</p>
        <span class="badge bg-primary">{{ $item->category }}</span>
        <a href="{{ route('news.detail', $item->id) }}" class="btn btn-outline-primary btn-sm mt-2">Xem chi tiết</a>
    </div>
</div> 