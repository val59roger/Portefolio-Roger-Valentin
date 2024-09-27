// Sélectionne tous les boutons "Voir"
const buttons = document.querySelectorAll('.toggle-btn');

// Ajoute un événement à chaque bouton
buttons.forEach(button => {
    button.addEventListener('click', function() {
        // Récupère la carte parent
        const card = this.parentElement;

        // Ajoute ou enlève la classe "expanded" pour gérer l'agrandissement/réduction
        card.classList.toggle('expanded');

        // Change le texte du bouton selon l'état de la carte
        if (card.classList.contains('expanded')) {
            this.textContent = 'Fermer'; // Si le texte est visible
        } else {
            this.textContent = 'Voir'; // Si le texte est masqué
        }
    });
});