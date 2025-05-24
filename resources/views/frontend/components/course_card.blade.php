<div class="card course-card h-100 p-3">
    <div class="card-body">
        <h5 class="card-title fw-bold">{{ $course->name }}</h5>
        <p class="card-text">{{ $course->description }}</p>
        <ul class="list-unstyled mb-2">
            <li><i class="bi bi-cash-coin text-success"></i> <strong>Học phí:</strong> {{ number_format($course->fee, 0, ',', '.') }}đ</li>
            <li><i class="bi bi-calendar-event text-primary"></i> <strong>Khai giảng:</strong> {{ \Carbon\Carbon::parse($course->start_date)->format('d/m/Y') }}</li>
            <li><i class="bi bi-clock text-warning"></i> <strong>Lịch học:</strong> {{ $course->schedule }}</li>
            <li><i class="bi bi-star-fill text-warning"></i> <strong>Ưu đãi:</strong> {{ $course->discount_info }}</li>
        </ul>
        <a href="{{ route('frontend.courses.show', $course->slug) }}" class="btn btn-outline-primary btn-sm px-4 fw-bold shadow-sm">Xem chi tiết</a>
    </div>
</div> 