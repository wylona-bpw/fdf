@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
     x-transition class="fixed top-20 right-4 z-50 max-w-sm bg-green-600 text-white px-5 py-3 rounded-lg shadow-xl text-sm font-medium">
    {{ session('success') }}
    <button @click="show = false" class="absolute top-1 right-2 text-white/70 hover:text-white">&times;</button>
</div>
@endif
@if(session('newsletter_success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
     x-transition class="fixed top-20 right-4 z-50 max-w-sm bg-brand-gold text-brand-blue-dk px-5 py-3 rounded-lg shadow-xl text-sm font-medium">
    {{ session('newsletter_success') }}
    <button @click="show = false" class="absolute top-1 right-2 text-brand-blue-dk/70 hover:text-brand-blue-dk">&times;</button>
</div>
@endif
