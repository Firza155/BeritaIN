@extends('layouts.app')

@section('title', 'Dashboard Wartawan')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Wartawan</h1>
    <a href="{{ route('news.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Buat Berita Baru
    </a>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Total Berita Card -->
    <x-stat-card 
        title="Total Berita" 
        :value="$totalBerita ?? 0" 
        icon="newspaper" 
        color="primary"
        :link="route('news.index')"
    />

    <!-- Published Berita Card -->
    <x-stat-card 
        title="Diterbitkan" 
        :value="$publishedBerita ?? 0" 
        icon="check-circle" 
        color="success"
        :link="route('news.index', ['status' => 'published'])"
    />

    <!-- Pending Approval Card -->
    <x-stat-card 
        title="Menunggu Review" 
        :value="$pendingBerita ?? 0" 
        icon="clock" 
        color="warning"
        :link="route('news.index', ['status' => 'pending'])"
    />

    <!-- Draft Berita Card -->
    <x-stat-card 
        title="Draft" 
        :value="$draftBerita ?? 0" 
        icon="file-alt" 
        color="info"
        :link="route('news.index', ['status' => 'draft'])"
    />
</div>

<!-- Content Row -->

<div class="row">
    <!-- Recent Berita -->
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Berita Terbaru Saya</h6>
                <a href="{{ route('news.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBerita as $berita)
                            <tr>
                                <td><a href="{{ route('news.show', $berita->id) }}">{{ Str::limit($berita->title, 50) }}</a></td>
                                <td>{{ $berita->category->name ?? 'Tanpa Kategori' }}</td>
                                <td>{{ $berita->created_at->format('d M Y') }}</td>
                                <td>
                                    @if($berita->status == 'draft')
                                        <span class="badge badge-secondary">Draft</span>
                                    @elseif($berita->status == 'pending')
                                        <span class="badge badge-warning">Menunggu</span>
                                    @elseif($berita->status == 'published')
                                        <span class="badge badge-success">Diterbitkan</span>
                                    @elseif($berita->status == 'rejected')
                                        <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('news.show', $berita->id) }}" class="btn btn-sm btn-info" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($berita->status == 'draft' || $berita->status == 'rejected')
                                    <a href="{{ route('news.edit', $berita->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Anda belum memiliki berita</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('news.create') }}" class="btn btn-primary btn-block">
                            <i class="fas fa-plus-circle mr-2"></i>Buat Berita Baru
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('news.index', ['status' => 'draft']) }}" class="btn btn-secondary btn-block">
                            <i class="fas fa-file-alt mr-2"></i>Lihat Draft
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('news.index', ['status' => 'pending']) }}" class="btn btn-warning btn-block">
                            <i class="fas fa-clock mr-2"></i>Lihat Pending
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistik -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistik Berita Saya</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Draft
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-warning"></i> Menunggu
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Diterbitkan
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-danger"></i> Ditolak
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Page level plugins -->
<script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
if (ctx) {
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Draft", "Menunggu", "Diterbitkan", "Ditolak"],
            datasets: [{
                data: [{{ $draftBerita ?? 0 }}, {{ $pendingBerita ?? 0 }}, {{ $publishedBerita ?? 0 }}, {{ $rejectedBerita ?? 0 }}],
                backgroundColor: ['#4e73df', '#f6c23e', '#1cc88a', '#e74a3b'],
                hoverBackgroundColor: ['#2e59d9', '#dda20a', '#17a673', '#be2617'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });
}
</script>
@endpush
