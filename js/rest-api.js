document.addEventListener("DOMContentLoaded", function(event) { 

    // Define some constants
    const openButtons  = document.getElementsByClassName('open-modal');
    const closeButton  = document.getElementById('close-modal');
    const dimmer       = document.getElementById('dimmer');
    const modalWindow  = document.getElementById('modal-window');
    const modalContent = document.getElementById('modal-window-content');

    // Add click listeners to all elements with 'open-modal' class
    Array.from(openButtons).forEach(function(openButton) {
        openButton.addEventListener('click', function(e){
            e.preventDefault();

            // Set focus on Close button
            closeButton.focus();

            // Get the element's data ID and build a REST API URL
            const api_ID = this.dataset.id;
            const url    = rest_object.api_url + 'posts/' + api_ID;

            // Fetch and output the data
            fetch( url )
                .then( response => response.json() )
                .then( data => {
                    modalContent.innerHTML = `<h1>${data['title']['rendered']}</h1>${data['content']['rendered']}`;
                    modalWindow.classList.add('fade');
                    dimmer.classList.add('fade');
                })
                .catch( error => {
                    console.error(error);
                });
            
        });
    });

    // Close Modal Window when X button is clicked
    closeButton.addEventListener('click', function(){
        modalWindow.classList.remove('fade');
        dimmer.classList.remove('fade');
    });

    // Close Modal Window when anywhere outside of Modal is clicked
    dimmer.addEventListener('click', function(){
        modalWindow.classList.remove('fade');
        dimmer.classList.remove('fade');
    });

    // Close Modal Window when Escape key is used
    window.addEventListener('keydown', function(e) {
        if(e.key === "Escape" || e.key === "Esc") {
            modalWindow.classList.remove('fade');
            dimmer.classList.remove('fade');
        }
    });
  
});