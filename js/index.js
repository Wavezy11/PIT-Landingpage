
function togglePopup(title = "", description = "", image = "", link = "") {
    // Als de beschrijving langer is dan 400 tekens, kort deze in
    if (description.length > 400) {
        description = description.substring(0, 400) + "...";
    }
    var popup = document.getElementById("myPopup");
    var overlay = document.getElementById("popupOverlay");
    document.getElementById("popupTitle").innerText = title;
    document.getElementById("popupDescription").innerText = description;

    // Verwijzen naar de popup-afbeelding
    var popupImage = document.getElementById("popupImage");
    if (image) {
        popupImage.src = image;
        popupImage.style.display = "block"; 
    } else {
        popupImage.style.display = "none"; 
    }

    // Update de knoplink naar de applicatie
    var popupButton = document.getElementById("popupbutton");
    popupButton.onclick = function() {
        window.open(link, '_blank'); // Open de link in een nieuw tabblad
    };

    // Toon of verberg de popup met een transitie
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

// Voeg click-event toe aan alle apps op de pagina
document.querySelectorAll('.app').forEach(function(app) {
    app.addEventListener('click', function(event) {
        event.stopPropagation(); 
        // Haal data op van het aangeklikte element
        var title = this.getAttribute('data-title');
        var description = this.getAttribute('data-description');
        var image = this.getAttribute('data-image'); // Dit is de popup-afbeelding
        var link = this.getAttribute('data-link'); // Dit is de link naar de applicatie
        // Toon de popup met de opgehaalde data
        togglePopup(title, description, image, link);
    });
});