const themeToggleBtn = document.getElementById('theme-toggle');
const bodyElement = document.body;

// Controleer of er al een thema in localStorage is opgeslagen en pas het toe
const savedTheme = localStorage.getItem('theme');
if (savedTheme) {
    bodyElement.classList.add(savedTheme);
} else {
    // Als er geen thema is opgeslagen, gebruik dan het standaard thema
    bodyElement.classList.add('default-theme');
}

// Thema's wisselen bij het klikken op de knop
themeToggleBtn.addEventListener('click', () => {
    if (bodyElement.classList.contains('default-theme')) {
        // Wissel naar licht thema
        bodyElement.classList.remove('default-theme');
        bodyElement.classList.add('light-theme');
        localStorage.setItem('theme', 'light-theme');
    } else if (bodyElement.classList.contains('light-theme')) {
        // Wissel naar donker thema
        bodyElement.classList.remove('light-theme');
        bodyElement.classList.add('dark-theme');
        localStorage.setItem('theme', 'dark-theme');
    } else {
        // Wissel terug naar standaard thema
        bodyElement.classList.remove('dark-theme');
        bodyElement.classList.add('default-theme');
        localStorage.removeItem('theme');  // Verwijder opgeslagen thema
    }
});