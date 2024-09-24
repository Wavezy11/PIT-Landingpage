function togglePopup(title = "", description = "", image = "") {
    if (description.length > 400) {
        description = description.substring(0, 400) + "...";
    }
    document.getElementById('description').addEventListener('input', function() {
    if (this.value.length > 400) {
        alert('Beschrijving mag niet meer dan 400 karakters bevatten.');
        this.value = this.value.substring(0, 400); // Truncate the description
    }
});



    var popup = document.getElementById("myPopup");
    var overlay = document.getElementById("popupOverlay");
    document.getElementById("popupTitle").innerText = title;
    document.getElementById("popupDescription").innerText = description;

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


    var popupImage = document.getElementById("popupImage");

    if (image) {
        popupImage.src = image;
        popupImage.style.display = "block"; 
    } else {
        popupImage.style.display = "none"; 
    }

    if (popup.style.display === "block") {
        popup.style.opacity = "0";
        popup.style.transform = "translateY(-20px)";
        overlay.style.opacity = "0";
        setTimeout(function() {
            popup.style.display = "none";
            overlay.style.display = "none";
        }, 300);
    } else {
        popup.style.display = "block";
        overlay.style.display = "block";
        setTimeout(function() {
            popup.style.opacity = "1";
            popup.style.transform = "translateY(0)";
            overlay.style.opacity = "1";
        }, 10);
    }
}

document.querySelectorAll('.app').forEach(function(app) {
    app.addEventListener('click', function(event) {
        event.stopPropagation(); 

        var title = this.getAttribute('data-title');
        var description = this.getAttribute('data-description');
        var image = this.getAttribute('data-image'); 

        togglePopup(title, description, image);
    });
});