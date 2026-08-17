@extends('layouts.app')
@section('title', 'Devenir bénévole — AMFDF')

@section('content')
<x-page-hero title="Devenir bénévole" quote="Femmes, rejoignez-nous en masse." />

{{-- Opportunités concrètes --}}
<section class="bg-paper-gold/30 py-14">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header kicker="Comment aider" title="Ce que vous pouvez faire avec nous" />
        <div class="grid sm:grid-cols-3 gap-5">
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm border border-stone-100">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-paper-gold flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <h3 class="font-display font-bold text-brand-blue-dk mb-1">Sur le terrain</h3>
                <p class="text-sm text-ink-grey">Distribution alimentaire, logistique, accompagnement lors des missions.</p>
            </div>
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm border border-stone-100">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-paper-blue flex items-center justify-center">
                    <svg class="w-6 h-6 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2h2m0-4h10v4H7V4z"/></svg>
                </div>
                <h3 class="font-display font-bold text-brand-blue-dk mb-1">À distance</h3>
                <p class="text-sm text-ink-grey">Communication, réseaux sociaux, recherche de partenaires, traduction.</p>
            </div>
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm border border-stone-100">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-paper-gold flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <h3 class="font-display font-bold text-brand-blue-dk mb-1">Ponctuellement</h3>
                <p class="text-sm text-ink-grey">Un coup de main pour une collecte, un événement, une occasion précise.</p>
            </div>
        </div>
    </div>
</section>

@php
    // Si le formulaire revient avec des erreurs, on rouvre directement l'étape concernée
    $stepFields = [
        1 => ['first_name', 'last_name', 'email', 'phone'],
        2 => ['country', 'country_other', 'city', 'availability', 'skills'],
        3 => ['message'],
    ];
    $errorStep = 1;
    foreach ($stepFields as $step => $fields) {
        if ($errors->hasAny($fields)) { $errorStep = $step; break; }
    }
@endphp

<section class="py-16">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8"
         x-data="{
            step: {{ $errorStep }},
            total: 3,
            next() {
                const fs = this.$refs['fieldset' + this.step];
                if (fs && !fs.reportValidity()) { return; }
                if (this.step < this.total) this.step++;
            },
            back() { if (this.step > 1) this.step--; },
         }">

        {{-- Barre de progression --}}
        <div class="mb-10">
            <div class="flex items-center justify-between mb-2 text-xs font-semibold text-ink-grey">
                <span :class="step >= 1 ? 'text-brand-blue' : ''">1. Profil</span>
                <span :class="step >= 2 ? 'text-brand-blue' : ''">2. Disponibilités</span>
                <span :class="step >= 3 ? 'text-brand-blue' : ''">3. Message</span>
            </div>
            <div class="h-2 bg-paper-blue rounded-full overflow-hidden">
                <div class="h-full bg-brand-gold transition-all duration-300" :style="`width: ${(step / total) * 100}%`"></div>
            </div>
        </div>

        @if($errors->any())
        <div class="bg-error-bg border border-error/20 text-error rounded-xl p-4 mb-6 text-sm" role="alert">
            <p class="font-semibold mb-1">Merci de corriger {{ $errors->count() > 1 ? 'les champs suivants' : 'le champ suivant' }} :</p>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('volunteer.store') }}" method="POST" novalidate>
            @csrf

            {{-- Étape 1 : Profil --}}
            <fieldset x-ref="fieldset1" x-show="step === 1" x-cloak class="space-y-6">
                <legend class="sr-only">Votre profil</legend>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-ink-dark mb-1">Pr&eacute;nom *</label>
                        <input id="first_name" type="text" name="first_name" required autocomplete="given-name" value="{{ old('first_name') }}"
                            aria-describedby="first_name-error"
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                        @error('first_name')<p id="first_name-error" class="text-error text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-ink-dark mb-1">Nom *</label>
                        <input id="last_name" type="text" name="last_name" required autocomplete="family-name" value="{{ old('last_name') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                        @error('last_name')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-ink-dark mb-1">E-mail *</label>
                        <input id="email" type="email" name="email" required autocomplete="email" value="{{ old('email') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                        @error('email')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-ink-dark mb-1">T&eacute;l&eacute;phone</label>
                        <input id="phone" type="tel" name="phone" autocomplete="tel" placeholder="+33 6 12 34 56 78" value="{{ old('phone') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button" @click="next()" class="px-8 py-3 bg-brand-blue text-white font-semibold rounded-xl hover:bg-brand-blue-dk transition">Continuer</button>
                </div>
            </fieldset>

            {{-- Étape 2 : Disponibilités & compétences --}}
            <fieldset x-ref="fieldset2" x-show="step === 2" x-cloak class="space-y-6">
                <legend class="sr-only">Vos disponibilités et compétences</legend>
                <div class="grid md:grid-cols-2 gap-6">
                    <div x-data="{ other: {{ old('country') === 'Autre' ? 'true' : 'false' }} }">
                        <label for="country" class="block text-sm font-medium text-ink-dark mb-1">Pays</label>
                        <select id="country" name="country" @change="other = ($event.target.value === 'Autre')"
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                            <option value="">S&eacute;lectionner…</option>
                            @foreach(['France', 'Cameroun', 'Belgique', 'Suisse', 'Canada', "C&ocirc;te d'Ivoire", 'S&eacute;n&eacute;gal'] as $c)
                                <option value="{{ $c }}" @selected(old('country') === $c)>{{ $c }}</option>
                            @endforeach
                            <option value="Autre" @selected(old('country') === 'Autre')>Autre</option>
                        </select>
                        <input type="text" name="country_other" x-show="other" x-cloak placeholder="Pr&eacute;cisez votre pays" value="{{ old('country_other') }}"
                            class="w-full px-4 py-3 mt-2 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                    </div>
                    <div>
                        <label for="city" class="block text-sm font-medium text-ink-dark mb-1">Ville</label>
                        <input id="city" type="text" name="city" autocomplete="address-level2" value="{{ old('city') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                    </div>
                </div>
                <div>
                    <label for="availability" class="block text-sm font-medium text-ink-dark mb-1">Disponibilit&eacute;</label>
                    <select id="availability" name="availability"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                        <option value="">S&eacute;lectionner…</option>
                        <option value="Quelques heures par semaine" @selected(old('availability') === 'Quelques heures par semaine')>Quelques heures par semaine</option>
                        <option value="Le week-end" @selected(old('availability') === 'Le week-end')>Le week-end</option>
                        <option value="Ponctuellement (missions terrain)" @selected(old('availability') === 'Ponctuellement (missions terrain)')>Ponctuellement (missions terrain)</option>
                        <option value="&Agrave; distance" @selected(old('availability') === 'À distance')>&Agrave; distance</option>
                    </select>
                </div>
                <div>
                    <label for="skills" class="block text-sm font-medium text-ink-dark mb-1">Comp&eacute;tences / centres d'int&eacute;r&ecirc;t</label>
                    <input id="skills" type="text" name="skills" placeholder="Ex : logistique, communication, cuisine..." value="{{ old('skills') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">
                </div>
                <div class="flex justify-between">
                    <button type="button" @click="back()" class="px-6 py-3 text-brand-blue font-semibold hover:text-brand-gold transition">&larr; Retour</button>
                    <button type="button" @click="next()" class="px-8 py-3 bg-brand-blue text-white font-semibold rounded-xl hover:bg-brand-blue-dk transition">Continuer</button>
                </div>
            </fieldset>

            {{-- Étape 3 : Message + consentement --}}
            <fieldset x-ref="fieldset3" x-show="step === 3" x-cloak class="space-y-6">
                <legend class="sr-only">Votre message</legend>
                <div>
                    <label for="message" class="block text-sm font-medium text-ink-dark mb-1">Message / motivation</label>
                    <textarea id="message" name="message" rows="4"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition">{{ old('message') }}</textarea>
                </div>
                <div class="flex items-start gap-3">
                    <input id="consent" type="checkbox" name="consent" required
                        class="mt-1 w-4 h-4 rounded border-gray-300 text-brand-blue focus:ring-brand-blue/40">
                    <label for="consent" class="text-sm text-ink-grey">
                        J'accepte que mes informations soient utilisées pour traiter ma candidature, conformément à la
                        <a href="{{ route('privacy') }}" class="text-brand-blue underline hover:text-brand-gold">politique de confidentialit&eacute;</a>. *
                    </label>
                </div>
                <div class="flex justify-between items-center">
                    <button type="button" @click="back()" class="px-6 py-3 text-brand-blue font-semibold hover:text-brand-gold transition">&larr; Retour</button>
                    <button type="submit" class="px-8 py-3 bg-brand-gold text-brand-blue-dk font-bold rounded-xl hover:bg-brand-gold-lt transition shadow-md">Envoyer ma candidature</button>
                </div>
                <p class="text-xs text-ink-grey text-center">Nous vous r&eacute;pondons g&eacute;n&eacute;ralement sous une semaine.</p>
            </fieldset>
        </form>
    </div>
</section>
@endsection
