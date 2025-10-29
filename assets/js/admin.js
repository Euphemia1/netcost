// News modal functions
function showAddNewsModal() {
  const modal = document.getElementById("newsModal")
  const modalTitle = document.getElementById("modalTitle")
  const newsForm = document.getElementById("newsForm")
  const newsAction = document.getElementById("newsAction")
  const newsId = document.getElementById("newsId")
  const newsTitle = document.getElementById("newsTitle")
  const newsContent = document.getElementById("newsContent")
  const currentImage = document.getElementById("currentImage")
  const imagePreview = document.getElementById("imagePreview")

  modalTitle.textContent = "Add News"
  newsAction.value = "add"
  newsId.value = ""
  newsTitle.value = ""
  newsContent.value = ""
  currentImage.value = ""
  imagePreview.innerHTML = ""
  newsForm.reset()

  modal.classList.add("active")
}

function editNews(id, title, content, image) {
  const modal = document.getElementById("newsModal")
  const modalTitle = document.getElementById("modalTitle")
  const newsAction = document.getElementById("newsAction")
  const newsId = document.getElementById("newsId")
  const newsTitle = document.getElementById("newsTitle")
  const newsContent = document.getElementById("newsContent")
  const currentImage = document.getElementById("currentImage")
  const imagePreview = document.getElementById("imagePreview")

  modalTitle.textContent = "Edit News"
  newsAction.value = "edit"
  newsId.value = id
  newsTitle.value = title
  newsContent.value = content
  currentImage.value = image

  // Show current image preview if exists
  if (image) {
    imagePreview.innerHTML = `
      <div class="preview-image">
        <img src="${image}" alt="Preview">
        <p>Current image</p>
      </div>
    `
  } else {
    imagePreview.innerHTML = ""
  }

  modal.classList.add("active")
}

function closeNewsModal() {
  const modal = document.getElementById("newsModal")
  modal.classList.remove("active")
}

// Image preview function
function previewImage(event) {
  const file = event.target.files[0]
  const preview = document.getElementById("imagePreview")

  if (file) {
    const reader = new FileReader()
    reader.onload = function(e) {
      preview.innerHTML = `
        <div class="preview-image">
          <img src="${e.target.result}" alt="Preview">
          <p>New image</p>
        </div>
      `
    }
    reader.readAsDataURL(file)
  }
}

// Close modal when clicking outside
document.addEventListener("click", (e) => {
  const modal = document.getElementById("newsModal")
  if (modal && e.target === modal) {
    closeNewsModal()
  }
})

// Escape key to close modal
document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    closeNewsModal()
  }
})

console.log("[v1] Admin panel initialized with image support")

