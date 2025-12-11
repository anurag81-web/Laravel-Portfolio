@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-5 py-4 bg-white/50 border-2 border-gray-200 text-dark rounded-xl shadow-sm focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none transition-all duration-300 font-sans disabled:opacity-50 disabled:bg-gray-100 placeholder-gray-400']) }}>