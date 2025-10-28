// News modal functions
function showAddNewsModal() {
  const modal = document.getElementById("newsModal")
  const modalTitle = document.getElementById("modalTitle")
  const newsForm = document.getElementById("newsForm")
  const newsAction = document.getElementById("newsAction")
  const newsId = document.getElementById("newsId")
  const newsTitle = document.getElementById("newsTitle")
  const newsContent = document.getElementById("newsContent")

  modalTitle.textContent = "Add News"
  newsAction.value = "add"
  newsId.value = ""
  newsTitle.value = ""
  newsContent.value = ""
  newsForm.reset()

  modal.classList.add("active")
}

function editNews(id, title, content) {
  const modal = document.getElementById("newsModal")
  const modalTitle = document.getElementById("modalTitle")
  const newsAction = document.getElementById("newsAction")
  const newsId = document.getElementById("newsId")
  const newsTitle = document.getElementById("newsTitle")
  const newsContent = document.getElementById("newsContent")

  modalTitle.textContent = "Edit News"
  newsAction.value = "edit"
  newsId.value = id
  newsTitle.value = title
  newsContent.value = content

  modal.classList.add("active")
}

function closeNewsModal() {
  const modal = document.getElementById("newsModal")
  modal.classList.remove("active")
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

console.log("[v0] Admin panel initialized")
