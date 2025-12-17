document.addEventListener("DOMContentLoaded", () => {
  const roleSelect = document.getElementById("roleSelect")
  const divCoach = document.getElementById("divCoach")
  const divClient = document.getElementById("divClient")
  const fileInput = document.getElementById("photo")
  const fileDisplay = document.querySelector(".file-input-display span")

  // Handle role selection
  if (roleSelect) {
    roleSelect.addEventListener("change", function () {
      const selectedText = this.options[this.selectedIndex].text.toLowerCase()

      // Hide both sections first
      divCoach.classList.remove("active")
      divClient.classList.remove("active")

      // Show appropriate section based on role
      if (selectedText.includes("coach") || selectedText.includes("entraineur")) {
        divCoach.classList.add("active")
      } else if (selectedText.includes("client") || selectedText.includes("membre")) {
        divClient.classList.add("active")
      }
    })
  }

  // Handle file input display
  if (fileInput && fileDisplay) {
    fileInput.addEventListener("change", function () {
      if (this.files && this.files[0]) {
        fileDisplay.textContent = this.files[0].name
      } else {
        fileDisplay.textContent = "Choisir une photo"
      }
    })
  }

  // Add input animations
  const inputs = document.querySelectorAll("input, select, textarea")
  inputs.forEach((input) => {
    input.addEventListener("focus", function () {
      this.parentElement.classList.add("focused")
    })

    input.addEventListener("blur", function () {
      this.parentElement.classList.remove("focused")
    })
  })

  // Form validation visual feedback
  const form = document.querySelector("form")
  if (form) {
    form.addEventListener("submit", (e) => {
      const requiredInputs = form.querySelectorAll("input[required]")
      let isValid = true

      requiredInputs.forEach((input) => {
        if (!input.value.trim()) {
          input.style.borderColor = "#ef4444"
          isValid = false
        } else {
          input.style.borderColor = ""
        }
      })

      if (!isValid) {
        e.preventDefault()
      }
    })
  }
})
