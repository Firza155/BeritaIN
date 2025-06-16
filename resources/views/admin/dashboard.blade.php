@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="{{ route('berita.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Berita
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
        :link="route('admin.berita.index')"
    />

    <!-- Total Kategori Card -->
    <x-stat-card 
        title="Total Kategori" 
        :value="$totalKategori ?? 0" 
        icon="list" 
        color="success"
        :link="route('admin.kategori.index')"
    />

    <!-- Total User Card -->
    <x-stat-card 
        title="Total User" 
        :value="$totalUser ?? 0" 
        icon="users" 
        color="info"
        :link="route('admin.user.index')"
    />

    <!-- Pending Approval Card -->
    <x-stat-card 
        title="Approval Berita" 
        :value="$pendingApproval ?? 0" 
        icon="clock" 
        color="warning"
        :link="route('admin.berita.pending') ?? ''"
    />
</div>

<!-- Content Row -->

<div class="row">
    <!-- Recent Berita -->
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Berita Terbaru</h6>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-sm btn-primary">Lihat detail</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBerita as $berita)
                            <tr>
                                <td>{{ Str::limit($berita->title, 50) }}</td>
                                <td>{{ $berita->category->name ?? $berita->category->name ?? 'Tanpa Kategori' }}</td>
                                <td>{{ $berita->user->name ?? '-' }}</td>
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
                                    <a href="{{ route('admin.berita.show', $berita->id) }}" class="btn btn-sm btn-info" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada berita terbaru</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
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
                data: [{{ $statusCounts['draft'] ?? 0 }}, {{ $statusCounts['pending'] ?? 0 }}, {{ $statusCounts['published'] ?? 0 }}, {{ $statusCounts['rejected'] ?? 0 }}],
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
