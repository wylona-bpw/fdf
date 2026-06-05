<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#0A1D52] via-[#16348C] to-[#1E3FA0] relative overflow-hidden">

    {{-- Decorative --}}
    <div class="absolute top-20 left-[10%] w-32 h-32 border border-[#D9A521]/10 rounded-full"></div>
    <div class="absolute bottom-20 right-[15%] w-20 h-20 bg-[#D9A521]/5 rounded-lg rotate-45"></div>
    <div class="absolute top-[40%] right-[8%] w-3 h-3 bg-[#D9A521]/20 rounded-full"></div>

    <div class="w-full max-w-md mx-4 relative z-10">
        {{-- Header --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-[#D9A521] rounded-2xl shadow-lg mb-4">
                <span class="text-[#0A1D52] font-bold text-xl" style="font-family: 'Playfair Display', serif;">FDF</span>
            </div>
            <h1 class="text-white text-2xl font-bold" style="font-family: 'Playfair Display', serif;">
                Mouvement des Femmes de Foi
            </h1>
            <p class="text-[#F1CE6E] italic mt-1" style="font-family: 'Playfair Display', serif;">
                &laquo; Avec la foi, tout est possible &raquo;
            </p>
            <p class="text-white/40 text-sm mt-3">Espace d'administration</p>
        </div>

        {{-- Login card --}}
        <div class="bg-white/[0.07] backdrop-blur-xl rounded-2xl border border-white/10 shadow-2xl p-8">
            <h2 class="text-white font-semibold text-lg mb-6">Connexion</h2>

            {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE) }}

            <x-filament-panels::form wire:submit="authenticate">
                {{ $this->form }}

                <x-filament-panels::form.actions
                    :actions="$this->getCachedFormActions()"
                    :full-width="$this->hasFullWidthFormActions()"
                />
            </x-filament-panels::form>

            {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER) }}
        </div>

        {{-- Footer --}}
        <p class="text-center text-white/20 text-xs mt-8">
            &copy; {{ date('Y') }} AMFDF &mdash; Administration s&eacute;curis&eacute;e
        </p>
    </div>
</div>
