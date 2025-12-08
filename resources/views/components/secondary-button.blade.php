<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-8 py-4 rounded-xl font-bold text-sm uppercase tracking-wide transition-all duration-300 ease-in-out relative overflow-hidden']) }} style="background: transparent; 
           border: 3px solid transparent;
           background-image: linear-gradient(white, white), linear-gradient(135deg, #1d4ed8, #3b82f6, #60a5fa);
           background-origin: border-box;
           background-clip: padding-box, border-box;
           color: #1d4ed8; 
           box-shadow: 0 4px 15px rgba(29, 78, 216, 0.15), inset 0 0 0 1px rgba(29, 78, 216, 0.1);
           letter-spacing: 1px;
           font-weight: 700;" onmouseover="this.style.background='linear-gradient(135deg, #1d4ed8, #3b82f6)'; 
                 this.style.color='#ffffff'; 
                 this.style.transform='translateY(-3px) scale(1.02)'; 
                 this.style.boxShadow='0 8px 25px rgba(29, 78, 216, 0.35), 0 0 30px rgba(29, 78, 216, 0.2)';"
    onmouseout="this.style.background='transparent'; 
                this.style.backgroundImage='linear-gradient(white, white), linear-gradient(135deg, #1d4ed8, #3b82f6, #60a5fa)';
                this.style.backgroundOrigin='border-box';
                this.style.backgroundClip='padding-box, border-box';
                this.style.color='#1d4ed8'; 
                this.style.transform='translateY(0) scale(1)'; 
                this.style.boxShadow='0 4px 15px rgba(29, 78, 216, 0.15), inset 0 0 0 1px rgba(29, 78, 216, 0.1)';">
    {{ $slot }}
</button>