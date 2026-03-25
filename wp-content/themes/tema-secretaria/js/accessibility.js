document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Crear la Barra de Accesibilidad
    // CAMBIO: Se implementaron Google Material Symbols
    const toolbarHTML = `
        <div id="access-toolbar" class="access-toolbar" style="display:none;">
            <div class="access-container">
                <button type="button" id="btn-dyslexia" class="access-btn">
                    <span class="icon" style="font-family: 'OpenDyslexic', sans-serif; font-weight:bold; display:flex; align-items:center; justify-content:center;">D</span> Dislexia
                </button>
                <button type="button" id="btn-contrast" class="access-btn">
                    <span class="icon material-symbols-outlined" style="display:flex; align-items:center; justify-content:center; font-size:20px;">brightness_6</span> Contraste
                </button>
                <button type="button" id="btn-invert" class="access-btn">
                    <span class="icon material-symbols-outlined" style="display:flex; align-items:center; justify-content:center; font-size:20px;">ev_shadow</span> Modo Oscuro
                </button>
                <button type="button" id="btn-decrease" class="access-btn">
                    <span class="icon material-symbols-outlined" style="display:flex; align-items:center; justify-content:center; font-size:20px;">text_decrease</span> Disminuir
                </button>
                <button type="button" id="btn-reset" class="access-btn">
                    <span class="icon material-symbols-outlined" style="display:flex; align-items:center; justify-content:center; font-size:20px;">text_format</span> Normal
                </button>
                <button type="button" id="btn-increase" class="access-btn">
                    <span class="icon material-symbols-outlined" style="display:flex; align-items:center; justify-content:center; font-size:20px;">text_increase</span> Aumentar
                </button>
                <button type="button" id="btn-pause" class="access-btn">
                    <span class="icon material-symbols-outlined" style="display:flex; align-items:center; justify-content:center; font-size:20px;">pause</span> Animaciones
                </button>
                <button type="button" id="btn-close-bar" class="access-close">
                   <span class="material-symbols-outlined" style="font-size:20px; font-weight:bold;">close</span>
                </button>
            </div>
        </div>
    `;
    
    if (!document.getElementById('access-toolbar')) {
        document.body.insertAdjacentHTML('afterbegin', toolbarHTML);
    }

    const toggleBtn = document.querySelector('.accessibility-icon');
    const toolbar = document.getElementById('access-toolbar');
    const closeBtn = document.getElementById('btn-close-bar');
    const body = document.body;

    if(toggleBtn) {
        toggleBtn.style.cursor = 'pointer';
        toggleBtn.addEventListener('click', function() {
            toolbar.style.display = (toolbar.style.display === 'none' || toolbar.style.display === '') ? 'block' : 'none';
        });
    }

    if(closeBtn) {
        closeBtn.addEventListener('click', function() {
            toolbar.style.display = 'none';
        });
    }

    // --- DISLEXIA ---
    document.getElementById('btn-dyslexia').addEventListener('click', function() {
        body.classList.toggle('dyslexia-mode');
        this.classList.toggle('active');
    });

    // --- CONTRASTE (Saturación/Nitidez) ---
    document.getElementById('btn-contrast').addEventListener('click', function() {
        body.classList.toggle('high-contrast');
        if(body.classList.contains('inverted-colors')) {
            body.classList.remove('inverted-colors');
            document.getElementById('btn-invert').classList.remove('active');
        }
        this.classList.toggle('active');
    });

    // --- MODO OSCURO (Fondo Negro) ---
    document.getElementById('btn-invert').addEventListener('click', function() {
        body.classList.toggle('inverted-colors');
        if(body.classList.contains('high-contrast')) {
            body.classList.remove('high-contrast');
            document.getElementById('btn-contrast').classList.remove('active');
        }
        this.classList.toggle('active');
    });

    // --- TAMAÑO DE TEXTO (AGRESIVO) ---
    let currentLevel = 0;
    const maxLevel = 3;  
    const minLevel = -2; 
    const scaleFactor = 0.25; // ¡50% de aumento por clic!

    function updateFontSize() {
        const newScale = 1 + (currentLevel * scaleFactor);
        document.documentElement.style.fontSize = (newScale * 100) + '%';
    }

    document.getElementById('btn-increase').addEventListener('click', function() {
        if(currentLevel < maxLevel) {
            currentLevel++;
            updateFontSize();
        }
    });

    document.getElementById('btn-decrease').addEventListener('click', function() {
        if(currentLevel > minLevel) {
            currentLevel--;
            updateFontSize();
        }
    });

    document.getElementById('btn-reset').addEventListener('click', function() {
        currentLevel = 0;
        document.documentElement.style.fontSize = ''; 
    });

    // --- PAUSAR ANIMACIONES ---
    document.getElementById('btn-pause').addEventListener('click', function() {
        body.classList.toggle('pause-animations');
        this.classList.toggle('active');
    });
});