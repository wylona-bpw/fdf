@extends('layouts.app')
@section('title', 'Contact — AMFDF')

@section('content')
<section class="py-16 md:py-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-brand-gold font-semibold text-sm uppercase tracking-wider mb-2">Nous &eacute;crire</p>
        <h1 class="font-display text-3xl md:text-4xl font-bold text-brand-blue mb-8">Contactez-nous</h1>

        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-ink-dark mb-1">Nom complet *</label>
                    <input type="text" id="name" name="name" required value="{{ old('name') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                    @error('name')<p class="text-brand-red text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-ink-dark mb-1">E-mail *</label>
                    <input type="email" id="email" name="email" required value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                    @error('email')<p class="text-brand-red text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="phone" class="block text-sm font-medium text-ink-dark mb-1">T&eacute;l&eacute;phone</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                </div>
                <div>
                    <label for="subject" class="block text-sm font-medium text-ink-dark mb-1">Sujet</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                </div>
            </div>
            <div>
                <label for="message" class="block text-sm font-medium text-ink-dark mb-1">Message *</label>
                <textarea id="message" name="message" rows="6" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">{{ old('message') }}</textarea>
                @error('message')<p class="text-brand-red text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="flex items-start gap-3">
                <input id="consent" type="checkbox" name="consent" required
                    class="mt-1 w-4 h-4 rounded border-gray-300 text-brand-blue focus:ring-brand-blue/40">
                <label for="consent" class="text-sm text-ink-grey">
                    J'accepte que mes informations soient utilisées pour traiter ma demande, conformément à la
                    <a href="{{ route('privacy') }}" class="text-brand-blue underline hover:text-brand-gold">politique de confidentialité</a>. *
                </label>
                @error('consent')<p class="text-brand-red text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="px-8 py-3 bg-brand-blue text-white font-semibold rounded-xl hover:bg-brand-blue-dk transition shadow-md">Envoyer le message</button>
        </form>

        <div class="mt-12 pt-8 border-t border-gray-100 grid md:grid-cols-3 gap-6 text-sm text-ink-grey">
            <div>
                <h3 class="font-semibold text-ink-dark mb-1">E-mail</h3>
                <p>{{ setting('email', 'contact@amfdf.org') }}</p>
            </div>
            <div>
                <h3 class="font-semibold text-ink-dark mb-1">T&eacute;l&eacute;phone / WhatsApp</h3>
                @if(setting('whatsapp_number'))
                <p><a href="https://wa.me/{{ setting('whatsapp_number') }}" class="hover:text-brand-blue transition" target="_blank" rel="noopener noreferrer">{{ setting('phone') }}</a></p>
                @else
                <p>{{ setting('phone', '—') }}</p>
                @endif
            </div>
            <div>
                <h3 class="font-semibold text-ink-dark mb-1">Localisation</h3>
                <p>{{ setting('address', 'France / International') }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
