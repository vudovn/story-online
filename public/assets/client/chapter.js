document.addEventListener('DOMContentLoaded', function () {
    // Settings panel
    const settingsButton = document.getElementById('settingsButton');
    const settingsPanel = document.getElementById('settingsPanel');
    const closeSettings = document.getElementById('closeSettings');
    // const bgColor = document.getElementById('bg-color');
    const fontFamily = document.getElementById('font-family');
    const fontSize = document.getElementById('font-size');
    const fontSizeValue = document.getElementById('font-size-value');
    const lineHeight = document.getElementById('line-height');
    const lineHeightValue = document.getElementById('line-height-value');
    const chapterContent = document.getElementById('chapter-content');

    // Open settings panel
    settingsButton.addEventListener('click', function () {
        settingsPanel.classList.toggle('translate-x-full');
    });

    // Close settings panel
    closeSettings.addEventListener('click', function () {
        settingsPanel.classList.add('translate-x-full');
    });

    // Background color
    // bgColor.addEventListener('change', function () {
    //     chapterContent.style.backgroundColor = this.value;
    //     localStorage.setItem('chapter_bg_color', this.value);
    // });

    // Font family
    fontFamily.addEventListener('change', function () {
        chapterContent.style.fontFamily = this.value;
        localStorage.setItem('chapter_font_family', this.value);
    });

    // Font size
    fontSize.addEventListener('input', function () {
        fontSizeValue.textContent = this.value + 'px';
        chapterContent.style.fontSize = this.value + 'px';
        localStorage.setItem('chapter_font_size', this.value);
    });

    // Line height
    lineHeight.addEventListener('input', function () {
        lineHeightValue.textContent = this.value;
        chapterContent.style.lineHeight = this.value;
        localStorage.setItem('chapter_line_height', this.value);
    });

    // Load saved settings
    if (localStorage.getItem('chapter_bg_color')) {
        const savedBgColor = localStorage.getItem('chapter_bg_color');
        bgColor.value = savedBgColor;
        chapterContent.style.backgroundColor = savedBgColor;
    }

    if (localStorage.getItem('chapter_font_family')) {
        const savedFontFamily = localStorage.getItem('chapter_font_family');
        fontFamily.value = savedFontFamily;
        chapterContent.style.fontFamily = savedFontFamily;
    }

    if (localStorage.getItem('chapter_font_size')) {
        const savedFontSize = localStorage.getItem('chapter_font_size');
        fontSize.value = savedFontSize;
        fontSizeValue.textContent = savedFontSize + 'px';
        chapterContent.style.fontSize = savedFontSize + 'px';
    }

    if (localStorage.getItem('chapter_line_height')) {
        const savedLineHeight = localStorage.getItem('chapter_line_height');
        lineHeight.value = savedLineHeight;
        lineHeightValue.textContent = savedLineHeight;
        chapterContent.style.lineHeight = savedLineHeight;
    }

    // Keyboard navigation
    document.addEventListener('keydown', function (e) {
        if (e.key === 'ArrowLeft') {
            const prevButton = document.querySelector('a.previous');
            if (prevButton) prevButton.click();
        } else if (e.key === 'ArrowRight') {
            const nextButton = document.querySelector('a.next');
            if (nextButton) nextButton.click();
        }
    });
});