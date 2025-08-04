{{-- Travel Guide Component --}}
<div class="travel-guide-section mb-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="section-title mb-4">
                    <i class="fas fa-user-tie me-2"></i>
                    Meet Our Expert Guides
                </h3>
                <p class="text-muted mb-4">Our experienced and knowledgeable guides are here to make your journey unforgettable.</p>
            </div>
        </div>
        
        <div class="row">
            @foreach(\App\Models\Guide::where('is_active', true)->take(4)->get() as $guide)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card guide-card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="guide-photo mb-3">
                                <img src="{{ $guide->profile_photo_url }}" 
                                     alt="{{ $guide->name }}" 
                                     class="rounded-circle guide-img"
                                     style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #f8f9fa;">
                            </div>
                            
                            <h5 class="card-title guide-name">{{ $guide->name }}</h5>
                            <p class="text-muted guide-location">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ $guide->location }}
                            </p>
                            
                            <div class="guide-experience mb-3">
                                <span class="badge bg-primary">
                                    <i class="fas fa-star me-1"></i>
                                    {{ $guide->experience_years }} Years Experience
                                </span>
                            </div>
                            
                            <p class="card-text guide-bio">
                                {{ Str::limit($guide->bio, 100) }}
                            </p>
                            
                            <div class="guide-languages mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-language me-1"></i>
                                    <strong>Languages:</strong> {{ $guide->languages_list }}
                                </small>
                            </div>
                            
                            @if($guide->specializations)
                                <div class="guide-specializations">
                                    <small class="text-muted">
                                        <i class="fas fa-award me-1"></i>
                                        <strong>Specializations:</strong> {{ Str::limit($guide->specializations, 80) }}
                                    </small>
                                </div>
                            @endif
                            
                            <div class="guide-contact mt-3">
                                @if($guide->phone)
                                    <small class="d-block text-muted">
                                        <i class="fas fa-phone me-1"></i>
                                        {{ $guide->phone }}
                                    </small>
                                @endif
                                @if($guide->email)
                                    <small class="d-block text-muted">
                                        <i class="fas fa-envelope me-1"></i>
                                        {{ $guide->email }}
                                    </small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('admin.guides.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-users me-2"></i>
                    View All Guides
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.guide-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
    border-radius: 15px;
}

.guide-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.guide-img {
    transition: transform 0.3s ease;
}

.guide-card:hover .guide-img {
    transform: scale(1.05);
}

.guide-name {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.guide-location {
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.guide-bio {
    font-size: 0.9rem;
    line-height: 1.5;
    color: #6c757d;
}

.guide-languages, .guide-specializations {
    font-size: 0.8rem;
}

.guide-contact {
    border-top: 1px solid #e9ecef;
    padding-top: 1rem;
    margin-top: 1rem;
}

.section-title {
    color: #2c3e50;
    font-weight: 600;
    text-align: center;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, #007bff, #28a745);
    border-radius: 2px;
}
</style> 