@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-xl shadow-sm transition-all duration-300 ease-in-out font-sans']) }}
    style="padding: 13px 16px; background: rgba(248, 250, 252, 0.8); border: 2px solid rgba(203, 213, 225, 0.5); font-size: 1rem; font-family: 'Poppins', sans-serif;"
    onfocus="this.style.borderColor='#1d4ed8'; this.style.background='#ffffff'; this.style.boxShadow='0 0 0 4px rgba(29, 78, 216, 0.1)'; this.style.transform='translateY(-2px)';"
    onblur="this.style.borderColor='rgba(203, 213, 225, 0.5)'; this.style.background='rgba(248, 250, 252, 0.8)'; this.style.boxShadow='none'; this.style.transform='translateY(0)';">