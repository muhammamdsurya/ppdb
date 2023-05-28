function updateWaktu() {
  var waktuSekarang = new Date().toLocaleString("en-US", {
    timeZone: "Asia/Jakarta",
  });
  $("#time").text("Waktu: " + waktuSekarang);
}

setInterval(updateWaktu, 1000);

function checkPasswordMatch() {
  const password1 = $("#exampleInputPassword").val();
  const password2 = $("#exampleRepeatPassword").val();
  const passwordError = $("#passwordError");

  if (password1 !== password2) {
    passwordError.text("Password tidak cocok");
    passwordError.show();
    $("#daftar").prop("disabled", true); // Menonaktifkan tombol daftar
  } else {
    passwordError.text("");
    passwordError.hide();
    $("#daftar").prop("disabled", false); // Mengaktifkan kembali tombol daftar
  }
}

// Menangkap elemen tombol "Preview" berdasarkan classnya
var previewButtons = document.querySelectorAll(".preview-button");

// Loop melalui setiap tombol "Preview" dan menambahkan event listener
previewButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    var targetClass = button.getAttribute("data-target");
    var imageURL = button.getAttribute("data-image");

    // Membuat lightbox overlay
    var overlay = document.createElement("div");
    overlay.classList.add("lightbox-overlay");

    // Membuat elemen gambar dan menambahkannya ke lightbox overlay
    var img = document.createElement("img");
    img.src = imageURL;
    img.classList.add("lightbox-image");
    overlay.appendChild(img);

    // Menambahkan lightbox overlay ke dalam body dokumen
    document.body.appendChild(overlay);

    // Menampilkan lightbox overlay
    overlay.style.display = "flex";

    // Menutup lightbox overlay ketika diklik di luar gambar
    overlay.addEventListener("click", function (e) {
      if (e.target === overlay) {
        overlay.style.display = "none";
        overlay.remove();
      }
    });
  });
});
