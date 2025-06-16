@props([
    'title' => '',
    'value' => 0,
    'icon' => 'fa-chart-line',
    'color' => 'primary',
    'link' => null,
    'linkText' => 'Lihat detail',
])

@php
$colors = [
    'primary' => 'primary',
    'success' => 'success',
    'info' => 'info',
    'warning' => 'warning',
    'danger' => 'danger',
    'secondary' => 'secondary',
];

$colorClass = $colors[$color] ?? 'primary';
$iconClass = $icon;

// Jika ikon tidak memiliki prefix fa-, tambahkan
if (!Str::startsWith($icon, ['fa-', 'fas ', 'far ', 'fab '])) {
    $iconClass = 'fa-' . $icon;
}
@endphp

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-{{ $colorClass }} shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-{{ $colorClass }} text-uppercase mb-1">
                        {{ $title }}
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $value }}</div>
                    @if($link)
                    <div class="mt-2">
                        <a href="{{ $link }}" class="text-xs text-{{ $colorClass }}">
                            {{ $linkText }} <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                    @endif
                </div>
                <div class="col-auto">
                    <i class="fas {{ $iconClass }} fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
