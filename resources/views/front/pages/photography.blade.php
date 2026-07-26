@extends('front.app')

@section('content')
    <section class="page-hero relative min-h-[760px] overflow-hidden bg-black text-white"><img
        src="https://images.unsplash.com/photo-1523438885200-e635ba2c371e?auto=format&fit=crop&w=1600&q=88"
        alt="She Said Yes" class="absolute inset-0 h-full w-full object-cover">
      <div
        class="relative z-10 mx-auto flex min-h-[760px] max-w-[1600px] items-end px-6 pb-20 pt-40 sm:px-10 sm:pb-28 lg:px-16">
        <div class="max-w-5xl">
          <p class="mb-5 text-[9px] uppercase tracking-[.34em] text-white/70">{{ $photography->label }}</p>
          <h1 class="font-display text-6xl leading-[.88] sm:text-8xl lg:text-[118px]">She Said Yes</h1>
          <p class="mt-7 max-w-2xl text-sm font-light uppercase leading-7 tracking-[.16em] text-white/75">Editorial
            prewedding stories made around connection, place, and personality.</p>
        </div>
      </div>
    </section>
    {!! $photography->content !!}
@endsection
