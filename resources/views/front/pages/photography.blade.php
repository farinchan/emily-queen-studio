@extends('front.app')

@section('title', $photography->title)
@section('meta_description', $photography->subtitle ?: $photography->description)
@section('meta_image', $photography->image)
@section('meta_keywords', is_array($photography->keywords) ? implode(', ', $photography->keywords) : ($photography->keywords ?: ''))

@section('content')
    <section class="page-hero relative min-h-[760px] overflow-hidden bg-black text-white">
        <img src="{{ $photography->image }}" alt="{{ $photography->title }}" class="absolute inset-0 h-full w-full object-cover opacity-60">
        <div class="relative z-10 mx-auto flex min-h-[760px] max-w-[1600px] items-end px-6 pb-20 pt-40 sm:px-10 sm:pb-28 lg:px-16">
            <div class="max-w-5xl">
                @if ($photography->label)
                    <p class="mb-5 text-[9px] uppercase tracking-[.34em] text-white/70">{{ $photography->label }}</p>
                @endif
                <h1 class="font-display text-6xl leading-[.88] sm:text-8xl lg:text-[118px]">{{ $photography->title }}</h1>
                @if ($photography->subtitle)
                    <p class="mt-7 max-w-2xl text-sm font-light uppercase leading-7 tracking-[.16em] text-white/75">{{ $photography->subtitle }}</p>
                @endif
            </div>
        </div>
    </section>
    @if ($photography->content)
        <div class="grapesjs-custom-content">
            {!! $photography->content !!}
        </div>
    @elseif ($photography->description)
        <section class="py-24 px-6 sm:px-10 lg:px-16 max-w-4xl mx-auto">
            <p class="text-base sm:text-lg font-light leading-relaxed text-black/80">
                {{ $photography->description }}
            </p>
        </section>
    @endif
@endsection
