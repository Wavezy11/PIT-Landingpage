document.addEventListener('DOMContentLoaded', function() {
    const descriptionField = document.getElementById('description');
    const charCountDisplay = document.getElementById('charCount');

    descriptionField.addEventListener('input', function() {
        const currentLength = this.value.length;
        charCountDisplay.textContent = currentLength;

        if (currentLength > 400) {
            alert('Beschrijving mag niet meer dan 400 karakters bevatten.');
            this.value = this.value.substring(0, 400); // Trim to 400 characters
            charCountDisplay.textContent = 400; // Update counter to max 400
        }
    });
});