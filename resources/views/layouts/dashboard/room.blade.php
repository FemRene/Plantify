@extends('web-base')

@section('title', "Room ".$room->name)

@section('content')
    <div id="room-carousel" class="flex justify-center w-full">
        <div class="carousel h-80 overflow-x-auto" style="width: 75dvw;">
            <div
                class="carousel-body flex h-full gap-4 snap-x snap-mandatory scroll-smooth"
                style="padding-left: calc((75dvw - 80rem)/2); padding-right: calc((75dvw - 16rem)/2);"
            >
                @foreach($plants as $plant)
                    <a href="{{ route('dashboard.plant', ['id' => $plant->id]) }}" class="carousel-slide flex-shrink-0 w-64 sm:w-80 md:w-96 p-2 snap-center">
                        <div class="bg-gradient-end/60 flex h-full justify-center items-center p-6 rounded-lg shadow">
                        <span class="text-2xl sm:text-4xl text-center">
                            {{ $plant->name }} ({{ $plant->id }})
                        </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        const carousel = document.querySelector('#room-carousel .carousel');

        carousel.addEventListener('wheel', (evt) => {
            // prevent default vertical scroll
            evt.preventDefault();

            // scroll horizontally instead
            carousel.scrollLeft += evt.deltaY;
        }, { passive: false });
    </script>

    {{-- Charts per room --}}
    @php
        $chartData = $avgMeasurements
            ->groupBy('room_id')
            ->filter(function($entries) {
                // Only keep rooms where there is at least one non-null measurement
                return $entries->pluck('avg_humidity')
                            ->merge($entries->pluck('avg_temperature'))
                            ->merge($entries->pluck('avg_light'))
                            ->merge($entries->pluck('avg_water'))
                            ->filter() // remove nulls / zeros
                            ->count() > 0;
            })
            ->map(function($entries, $roomId){
                return [
                    'chart_id' => 'chart-room-' . $roomId,
                    'room_name' => $entries->first()->house . ' - ' . $entries->first()->room,
                    'time_slots' => $entries->pluck('time_slot'),
                    'humidity' => $entries->pluck('avg_humidity')->map(fn($v) => $v !== null ? floor($v * 100) / 100 : null),
                    'temperature' => $entries->pluck('avg_temperature')->map(fn($v) => $v !== null ? floor($v * 100) / 100 : null),
                    'light' => $entries->pluck('avg_light')->map(fn($v) => $v !== null ? floor($v * 100) / 100 : null),
                    'water' => $entries->pluck('avg_water')->map(fn($v) => $v !== null ? floor($v * 100) / 100 : null),
                ];
            });
    @endphp

    @foreach($chartData as $room)
        <h3 class="text-lg font-semibold my-2">{{ $room['room_name'] }}</h3>
        <div id="{{ $room['chart_id'] }}" class="w-full mb-8" style="height: 400px;"></div>
    @endforeach

@endsection

@push('scripts')
    <script type="module">
        const chartData = @json($chartData);

        document.addEventListener('DOMContentLoaded', () => {
            Object.values(chartData).forEach(room => {
                const el = document.querySelector('#' + room.chart_id);
                if (!el) {
                    console.warn('Chart element not found:', room.chart_id);
                    return; // skip rendering this chart
                }

                const options = {
                    chart: { type: 'area', height: 400, toolbar: { show: false }, zoom: { enabled: false } },
                    series: [
                        { name: 'Humidity', data: room.humidity.filter(v => v != null) },
                        { name: 'Temperature', data: room.temperature.filter(v => v != null) },
                        { name: 'Water', data: room.water.filter(v => v != null) },
                    ],
                    xaxis: {
                        categories: room.time_slots.filter(v => v != null),
                        title: { text: 'Time Slot', style: { color: 'var(--color-white)' } }
                    },
                    yaxis: { title: { text: 'Values', style: { color: 'var(--color-white)' } } },
                    stroke: { curve: 'smooth', width: 2 },
                    colors: ['var(--color-warning)','var(--color-accent)','var(--color-primary)'],
                    tooltip: { y: { formatter: v => v.toFixed(2) } }
                };

                new ApexCharts(el, options).render();
            });
        });

    </script>
@endpush
