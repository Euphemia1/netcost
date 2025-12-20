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

// Image preview function for multiple images
function previewImages(event) {
  const files = event.target.files
  const preview = document.getElementById("imagePreview")
  
  preview.innerHTML = ""
  
  if (files && files.length > 0) {
    for (let i = 0; i < files.length; i++) {
      const file = files[i]
      if (file) {
        const reader = new FileReader()
        reader.onload = function(e) {
          const fileName = file.name.length > 15 ? file.name.substring(0, 12) + '...' : file.name;
          const imageElement = `
            <div class="preview-image">
              <img src="${e.target.result}" alt="Preview of ${file.name}">
              <p>${fileName}</p>
            </div>
          `
          preview.innerHTML += imageElement
        }
        reader.readAsDataURL(file)
      }
    }
  }
}

// Video preview function for multiple videos
function previewVideos(event) {
  const files = event.target.files
  const preview = document.getElementById("videoPreview")
  
  preview.innerHTML = ""
  
  if (files && files.length > 0) {
    for (let i = 0; i < files.length; i++) {
      const file = files[i]
      if (file) {
        const fileName = file.name.length > 15 ? file.name.substring(0, 12) + '...' : file.name;
        const videoElement = `
          <div class="preview-video">
            <div class="video-placeholder">
              <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M23 7L16 12L23 17V7Z" fill="currentColor"/>
                <path d="M14 5H3C2.45 5 2 5.45 2 6V18C2 18.55 2.45 19 3 19H14C14.55 19 15 18.55 15 18V6C15 5.45 14.55 5 14 5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
            <p>${fileName}</p>
          </div>
        `
        preview.innerHTML += videoElement
      }
    }
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


