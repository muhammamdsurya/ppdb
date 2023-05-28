function showSuccessAlert() {
  var newElement = document.createElement("div");
  newElement.className = "alert alert-warning";

  var message = "Silahkan Isi Formulir Pendaftaran Terlebih Dahulu!";
  newElement.textContent = message;

  // Mengatur properti CSS untuk elemen alert
  newElement.style.position = "absolute";
  newElement.style.width = "100%";
  newElement.style.zIndex = "9999";

  var targetElement = document.body;
  targetElement.prepend(newElement);

  setTimeout(() => {
    newElement.remove();
  }, 2000);
}
