const previewImage = document.getElementById('preview');

document.getElementById("imageInput").addEventListener('change', function () {
  const file = this.files[0];
  const reader = new FileReader();

reader.addEventListener('load', function () {
  previewImage.src = reader.result;
});

if (file) {
  reader.readAsDataURL(file);
} else {
  previewImage.src = '';
}
})
  