const searchBar = document.querySelector(".user .search input"),
  searchBtn = document.querySelector(".user .search button"),
  userList = document.querySelector(".user .user-list");

searchBtn.onclick = () => {
  searchBar.classList.toggle("active");
  searchBar.focus();
  searchBtn.classList.toggle("active");
  searchBar.value = "";
};

searchBar.onkeyup = () => {
  let searchTerm = searchBar.value;
  if (searchTerm != "") {
    searchBar.classList.add("active");
  } else {
    searchBar.classList.remove("active");
  }
  // Ajax ci-dessous
  let xhr = new XMLHttpRequest(); // creation de l'objet XML
  //xhr.open prend deux paramétre la methode, url , async
  // Nous mettons GET CAR NOUS DEVONS RECEVOIR DES DONNEES ET NON LES ENVOYER
  xhr.open("POST", "/SGRC/php/Traitement_chat/search.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // xhr.reponse donne la reponse de l'url passer en paramétre
        let data = xhr.response;
        userList.innerHTML = data;
      }
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("searchTerm=" + searchTerm);
};

setInterval(() => {
  // Ajax ci-dessous
  let xhr = new XMLHttpRequest(); // creation de l'objet XML
  //xhr.open prend deux paramétre la methode, url , async
  // Nous mettons GET CAR NOUS DEVONS RECEVOIR DES DONNEES ET NON LES ENVOYER
  xhr.open("GET", "/SGRC/php/Traitement_chat/users.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // xhr.reponse donne la reponse de l'url passer en paramétre
        let data = xhr.response;
        if (!searchBar.classList.contains("active")) {
          // if active active not contains in search bar then add this
          userList.innerHTML = data;
        }
      }
    }
  };
  xhr.send();
}, 500); // cette fonction s'executera fréquement aprés 500ms
