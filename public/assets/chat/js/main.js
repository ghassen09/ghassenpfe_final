function sendMessage() {
    // 1. Récupérer le texte dans l'input text de la page => on récupère zefrerfr
    // 2. Afficher ce texte dans une nouvelle div dans la zone ou y'a tous les messages => on affiche zefrefr
    // 3. reset le texte de l'input => on enleve zefrefr

    // 1.
    let message = document.getElementById("chat_message").value; // Récupère la valeur du formulaire

    //2. Afficher le texte
    // ICI c'est le conteneur de tous les messages
    let messageContainer = document.getElementById("messages-container");
    
    //2.1 On créé le conteneur du message
    let messageDiv = document.createElement("div"); // Créer un élément
    messageDiv.classList.add("red"); // Ajoute une classe red à l'élément
    messageContainer.appendChild(messageDiv); // Ajoute l'élément à son parent
    let messageText = document.createElement("p"); // Créer un élément <p>
    messageDiv.appendChild(messageText); // Ajoute l'élément à son parent
    messageText.innerHTML = message; // Ajoute la valeur du formulaire dans le <p></p>
    
    //3. 
    document.getElementById("chat_message").value = ''; // Reset la valeur du formulaire 



}
function replace() {
    let message = document.getElementById("replace").value;

    let messageText = document.createElement("p"); 
    messageContainer.appendChild(messageText);
let messageContainer = document.getElementById("surname");
messageText.innerHTML = message;
}


function Change(){
    let message= document.getElementById("Change");
    let messageContainer = document.getElementById("msg");

    let imgNewEn = document.createElement('img');
    messageContainer.appendChild(imgNewEn);
    
    imgNewEn.innerHTML = message;

    document.getElementById("testbox").innerHTML = "<img src=\""+ imgNewEn.src + "\">";
}

function changeColor(color) { 
    document.body.style.background = color; 
}
