@extends('layouts.app')
@section('title', 'Devenir bénévole — AMFDF')

@section('content')
<section class="bg-brand-blue py-12 text-center">
    <h1 class="font-display text-3xl md:text-4xl font-bold text-white">Devenir b&eacute;n&eacute;vole</h1>
    <p class="text-brand-gold-lt italic font-display mt-2">&laquo; Femmes, rejoignez-nous en masse. &raquo;</p>
</section>

<section class="py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-ink-grey mb-8">Vous souhaitez contribuer &agrave; nos actions ? Remplissez ce formulaire et nous vous recontacterons.</p>

        <form action="{{ route('volunteer.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-ink-dark mb-1">Pr&eacute;nom *</label>
                    <input type="text" name="first_name" required value="{{ old('first_name') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                    @error('first_name')<p class="text-brand-red text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-ink-dark mb-1">Nom *</label>
                    <input type="text" name="last_name" required value="{{ old('last_name') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                    @error('last_name')<p class="text-brand-red text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-ink-dark mb-1">E-mail *</label>
                    <input type="email" name="email" required value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-ink-dark mb-1">T&eacute;l&eacute;phone</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-ink-dark mb-1">Ville</label>
                    <input type="text" name="city" value="{{ old('city') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-ink-dark mb-1">Pays</label>
                    <input type="text" name="country" value="{{ old('country') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-ink-dark mb-1">Comp&eacute;tences / centres d'int&eacute;r&ecirc;t</label>
                <input type="text" name="skills" value="{{ old('skills') }}" placeholder="Ex : logistique, communication, cuisine..."
                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
            </div>
            <div>
                <label class="block text-sm font-medium text-ink-dark mb-1">Message / motivation</label>
                <textarea name="message" rows="4"
                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">{{ old('message') }}</textarea>
            </div>
            <button type="submit" class="px-8 py-3 bg-brand-gold text-brand-blue-dk font-bold rounded-xl hover:bg-brand-gold-lt transition shadow-md">Envoyer ma candidature</button>
        </form>
    </div>
</section>
@endsection
