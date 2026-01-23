@props(['type' => 'wave', 'flip' => false, 'color' => 'white'])

@php
    $flipClass = ($flip === true || $flip === 'true' || $flip === '1') ? 'flip' : '';
    $uniqueId = uniqid('divider-');
    // Determine gradient colors based on the base color
    if ($color === '#ffffff' || $color === 'white' || $color === '#f9fafb') {
        $gradientColor1 = '#ffffff';
        $gradientColor2 = '#f9fafb';
    } elseif ($color === '#142F32') {
        $gradientColor1 = '#142F32';
        $gradientColor2 = '#1a3f44';
    } else {
        $gradientColor1 = $color;
        $gradientColor2 = $color;
    }
@endphp

@if($type === 'wave')
    <div class="section-divider-modern {{ $flipClass }}" style="background-color: {{ $color }};">
        <svg class="w-full h-20 md:h-28" viewBox="0 0 1440 120" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="modernGradient{{ $uniqueId }}" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:{{ $gradientColor1 }};stop-opacity:1" />
                    <stop offset="50%" style="stop-color:{{ $gradientColor2 }};stop-opacity:1" />
                    <stop offset="100%" style="stop-color:{{ $gradientColor1 }};stop-opacity:1" />
                </linearGradient>
            </defs>
            <path d="M0,60 C180,100 360,20 540,60 C720,100 900,20 1080,60 C1260,100 1440,20 1440,60 L1440,120 L0,120 Z" fill="url(#modernGradient{{ $uniqueId }})"/>
        </svg>
    </div>
@elseif($type === 'curve')
    <div class="section-divider-modern {{ $flipClass }}" style="background-color: {{ $color }};">
        <svg class="w-full h-24 md:h-32" viewBox="0 0 1440 120" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="modernCurveGradient{{ $uniqueId }}" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:{{ $gradientColor1 }};stop-opacity:1" />
                    <stop offset="100%" style="stop-color:{{ $gradientColor2 }};stop-opacity:1" />
                </linearGradient>
            </defs>
            <path d="M0,0 C360,80 720,40 1080,60 C1260,70 1350,30 1440,60 L1440,120 L0,120 Z" fill="url(#modernCurveGradient{{ $uniqueId }})"/>
        </svg>
    </div>
@elseif($type === 'slant')
    <div class="section-divider-modern {{ $flipClass }}" style="background-color: {{ $color }};">
        <svg class="w-full h-16 md:h-20" viewBox="0 0 1440 120" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <polygon points="0,0 1440,120 1440,0" fill="{{ $color }}"/>
        </svg>
    </div>
@endif
