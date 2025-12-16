// Tab Switching
const tabBtns = document.querySelectorAll(".tab-btn")
const loginForm = document.getElementById("login-form")
const registerForm = document.getElementById("register-form")
const tabIndicator = document.querySelector(".tab-indicator")

tabBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    const tab = btn.dataset.tab

    // Update active tab button
    tabBtns.forEach((b) => b.classList.remove("active"))
    btn.classList.add("active")

    // Update tab indicator position
    if (tab === "register") {
      tabIndicator.style.transform = "translateX(100%)"
    } else {
      tabIndicator.style.transform = "translateX(0)"
    }

    // Show/hide forms
    if (tab === "login") {
      loginForm.classList.add("active")
      registerForm.classList.remove("active")
    } else {
      loginForm.classList.remove("active")
      registerForm.classList.add("active")
    }
  })
})

// Password Toggle
const toggleBtns = document.querySelectorAll(".toggle-password")

toggleBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    const input = btn.parentElement.querySelector("input")
    const eyeOpen = btn.querySelector(".eye-open")
    const eyeClosed = btn.querySelector(".eye-closed")

    if (input.type === "password") {
      input.type = "text"
      eyeOpen.classList.add("hidden")
      eyeClosed.classList.remove("hidden")
    } else {
      input.type = "password"
      eyeOpen.classList.remove("hidden")
      eyeClosed.classList.add("hidden")
    }
  })
})

// Password Strength Checker
const registerPassword = document.getElementById("register-password")
const strengthProgress = document.getElementById("strength-progress")
const strengthText = document.getElementById("strength-text")

if (registerPassword) {
  registerPassword.addEventListener("input", () => {
    const password = registerPassword.value
    const strength = checkPasswordStrength(password)

    strengthProgress.className = "strength-progress"

    if (password.length === 0) {
      strengthProgress.style.width = "0%"
      strengthText.textContent = "Force du mot de passe"
      return
    }

    if (strength === 1) {
      strengthProgress.classList.add("weak")
      strengthText.textContent = "Faible - Ajoutez plus de caractères"
    } else if (strength === 2) {
      strengthProgress.classList.add("fair")
      strengthText.textContent = "Moyen - Ajoutez des symboles"
    } else if (strength === 3) {
      strengthProgress.classList.add("good")
      strengthText.textContent = "Bon - Presque parfait!"
    } else {
      strengthProgress.classList.add("strong")
      strengthText.textContent = "Excellent - Mot de passe sécurisé!"
    }
  })
}

function checkPasswordStrength(password) {
  let strength = 0

  if (password.length >= 8) strength++
  if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++
  if (password.match(/[0-9]/)) strength++
  if (password.match(/[^a-zA-Z0-9]/)) strength++

  return strength
}

const roleSelect = document.getElementById("role-select")
const coachFields = document.getElementById("coach-fields")
const clientFields = document.getElementById("client-fields")

if (roleSelect) {
  roleSelect.addEventListener("change", () => {
    const selectedRole = roleSelect.value

    // Hide both sections first
    coachFields.classList.remove("active")
    clientFields.classList.remove("active")

    // Show the appropriate section based on role
    if (selectedRole === "coach") {
      coachFields.classList.add("active")
      // Make coach fields required
      document.getElementById("biographie").setAttribute("required", "")
      document.getElementById("annes-experience").setAttribute("required", "")
      document.getElementById("certification").setAttribute("required", "")
      // Remove required from client fields
      document.getElementById("telephone").removeAttribute("required")
    } else if (selectedRole === "client") {
      clientFields.classList.add("active")
      // Make client fields required
      document.getElementById("telephone").setAttribute("required", "")
      // Remove required from coach fields
      document.getElementById("biographie").removeAttribute("required")
      document.getElementById("annes-experience").removeAttribute("required")
      document.getElementById("certification").removeAttribute("required")
    }
  })
}

const photoInput = document.getElementById("photo")
const fileName = document.getElementById("file-name")
const fileLabel = document.querySelector(".file-label")

if (photoInput) {
  photoInput.addEventListener("change", () => {
    if (photoInput.files.length > 0) {
      fileName.textContent = photoInput.files[0].name
      fileLabel.classList.add("has-file")
    } else {
      fileName.textContent = "Choisir une image..."
      fileLabel.classList.remove("has-file")
    }
  })
}

// Form Submissions
loginForm.addEventListener("submit", (e) => {
  e.preventDefault()

  const email = document.getElementById("login-email").value
  const password = document.getElementById("login-password").value

  // Simulate login
  showModal("Connexion réussie! Bienvenue sur ELITE COACH.")

  // Reset form
  loginForm.reset()
})

registerForm.addEventListener("submit", (e) => {
  e.preventDefault()

  const nom = document.getElementById("nom").value
  const prenom = document.getElementById("prenom").value
  const email = document.getElementById("register-email").value
  const password = document.getElementById("register-password").value
  const role = document.getElementById("role-select").value
  const terms = document.getElementById("terms").checked

  if (!terms) {
    alert("Veuillez accepter les conditions d'utilisation.")
    return
  }

  // Collect role-specific data
  let roleData = {}
  if (role === "coach") {
    roleData = {
      biographie: document.getElementById("biographie").value,
      photo: document.getElementById("photo").files[0],
      annesExperience: document.getElementById("annes-experience").value,
      certification: document.getElementById("certification").value,
    }
  } else if (role === "client") {
    roleData = {
      telephone: document.getElementById("telephone").value,
    }
  }

  // Simulate registration
  const roleLabel = role === "coach" ? "Coach" : "Client"
  showModal(`Bienvenue ${prenom} ${nom}! Votre compte ${roleLabel} a été créé avec succès.`)

  // Reset form
  registerForm.reset()
  coachFields.classList.remove("active")
  clientFields.classList.remove("active")
  if (fileLabel) fileLabel.classList.remove("has-file")
  if (fileName) fileName.textContent = "Choisir une image..."
  strengthProgress.className = "strength-progress"
  strengthProgress.style.width = "0%"
  strengthText.textContent = "Force du mot de passe"
})

// Modal Functions
const modal = document.getElementById("success-modal")
const modalMessage = document.getElementById("modal-message")

function showModal(message) {
  modalMessage.textContent = message
  modal.classList.add("active")
}

function closeModal() {
  modal.classList.remove("active")
}

// Close modal on backdrop click
modal.addEventListener("click", (e) => {
  if (e.target === modal) {
    closeModal()
  }
})

// Add input focus effects
const inputs = document.querySelectorAll("input, select")

inputs.forEach((input) => {
  input.addEventListener("focus", () => {
    input.parentElement.classList.add("focused")
  })

  input.addEventListener("blur", () => {
    input.parentElement.classList.remove("focused")
  })
})

// Add ripple effect to buttons
const buttons = document.querySelectorAll(".submit-btn, .social-btn, .modal-btn")

buttons.forEach((button) => {
  button.addEventListener("click", function (e) {
    const rect = this.getBoundingClientRect()
    const x = e.clientX - rect.left
    const y = e.clientY - rect.top

    const ripple = document.createElement("span")
    ripple.className = "ripple"
    ripple.style.left = x + "px"
    ripple.style.top = y + "px"

    this.appendChild(ripple)

    setTimeout(() => ripple.remove(), 600)
  })
})
