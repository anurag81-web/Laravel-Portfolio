<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-8 py-4 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-wide transition-all duration-300 ease-in-out relative overflow-hidden']) }} style="background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 50%, #60a5fa 100%); 
           background-size: 200% 200%;
           box-shadow: 0 6px 20px rgba(29, 78, 216, 0.4), 0 0 20px rgba(29, 78, 216, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.2);
           animation: pulseGlow 2s ease-in-out infinite;
           letter-spacing: 1px;"
    onmouseover="this.style.background='linear-gradient(135deg, #0f3cc9 0%, #1d4ed8 50%, #3b82f6 100%)'; 
                 this.style.transform='translateY(-3px) scale(1.02)'; 
                 this.style.boxShadow='0 10px 35px rgba(29, 78, 216, 0.5), 0 0 40px rgba(29, 78, 216, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.3), 0 0 0 3px rgba(29, 78, 216, 0.1)';"
    onmouseout="this.style.background='linear-gradient(135deg, #1d4ed8 0%, #3b82f6 50%, #60a5fa 100%)'; 
                this.style.transform='translateY(0) scale(1)'; 
                this.style.boxShadow='0 6px 20px rgba(29, 78, 216, 0.4), 0 0 20px rgba(29, 78, 216, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.2)';"
    onmousedown="this.style.transform='translateY(-1px) scale(0.98)'; this.style.boxShadow='0 4px 15px rgba(29, 78, 216, 0.4), inset 0 2px 4px rgba(0, 0, 0, 0.1)';"
    onmouseup="this.style.transform='translateY(-3px) scale(1.02)'; this.style.boxShadow='0 10px 35px rgba(29, 78, 216, 0.5), 0 0 40px rgba(29, 78, 216, 0.3)';">
    {{ $slot }}
</button>

<style>
    @keyframes pulseGlow {

        0%,
        100% {
            filter: brightness(1);
        }

        50% {
            filter: brightness(1.1);
        }
    }
</style>