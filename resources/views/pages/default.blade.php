@extends('layouts.app')
@section('title', ($page->meta_title ?: $page->title) . ' — AMFDF')

@section('content')
<section class="py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display text-3xl font-bold text-brand-blue mb-8">{{ $page->title }}</h1>
        <div class="prose prose-lg max-w-none prose-headings:font-display prose-headings:text-brand-blue">
            {!! $page->body !!}
        </div>
    </div>
</section>
@endsection
