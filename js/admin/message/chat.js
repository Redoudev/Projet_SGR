const form = document.querySelector(".typing-area"),
  inputField = form.querySelector(".input-field"),
  sendBtn = form.querySelector("button"),
  chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
  e.preventDefault(); //Desactive le comportement par defaut
};

sendBtn.onclick = () => {
  // Ajax ci-dessous
  let xhr = new XMLHttpRequest(); // creation de l'objet XML
  //xhr.open prend deux paramétre la methode, url , async
  xhr.open("POST", "/SGRC/php/Traitement_chat/insert-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        inputField.value = ""; // once message inserted into database then leave blank the input field
        scrollToBottom();
      }
    }
  };
  // Nous devrons envoyer les données du formulaire via ajax en php
  let formData = new FormData(form); // creation de l'objet formData
  xhr.send(formData); // envoi des donnée du formuliare en php
};

chatBox.onmouseenter = () => {
  chatBox.classList.add("active");
};
chatBox.onmouseleave = () => {
  chatBox.classList.remove("active");
};

setInterval(() => {
  // Ajax ci-dessous
  let xhr = new XMLHttpRequest(); // creation de l'objet XML
  //xhr.open prend deux paramétre la methode, url , async
  // Nous mettons GET CAR NOUS DEVONS RECEVOIR DES DONNEES ET NON LES ENVOYER
  xhr.open("POST", "/SGRC/php/Traitement_chat/get-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // xhr.reponse donne la reponse de l'url passer en paramétre
        let data = xhr.response;
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains("active")) {
          // if active class not contains in chatbox the scroll
          scrollToBottom();
        }
      }
    }
  };
  // Nous devrons envoyer les données du formulaire via ajax en php
  let formData = new FormData(form); // creation de l'objet formData
  xhr.send(formData); // envoi des donnée du formuliare en php
}, 500); // cette fonction s'executera fréquement aprés 500ms

function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}
