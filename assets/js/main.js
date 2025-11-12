// Mobile menu toggle
const mobileMenuToggle = document.getElementById("mobileMenuToggle")
const navMenu = document.getElementById("navMenu")

if (mobileMenuToggle) {
  mobileMenuToggle.addEventListener("click", () => {
    navMenu.classList.toggle("active")
    mobileMenuToggle.classList.toggle("active")
  })
}

// Close mobile menu when clicking outside
document.addEventListener("click", (e) => {
  if (navMenu && navMenu.classList.contains("active")) {
    if (!navMenu.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
      navMenu.classList.remove("active")
      mobileMenuToggle.classList.remove("active")
    }
  }
})

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    const href = this.getAttribute("href")
    if (href !== "#" && href !== "#demo") {
      e.preventDefault()
      const target = document.querySelector(href)
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        })

        // Close mobile menu if open
        if (navMenu && navMenu.classList.contains("active")) {
          navMenu.classList.remove("active")
          mobileMenuToggle.classList.remove("active")
        }
      }
    }
  })
})

// Header scroll effect
let lastScroll = 0
const header = document.querySelector(".site-header")

window.addEventListener("scroll", () => {
  const currentScroll = window.pageYOffset

  if (currentScroll > 100) {
    header.style.boxShadow = "0 2px 8px rgba(0, 0, 0, 0.1)"
  } else {
    header.style.boxShadow = "none"
  }

  lastScroll = currentScroll
})

// Intersection Observer for fade-in animations
const observerOptions = {
  threshold: 0.1,
  rootMargin: "0px 0px -50px 0px",
}

const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = "1"
      entry.target.style.transform = "translateY(0)"
    }
  })
}, observerOptions)

// Observe elements for animation
document.querySelectorAll(".product-card, .service-item, .team-card, .client-card").forEach((el) => {
  el.style.opacity = "0"
  el.style.transform = "translateY(20px)"
  el.style.transition = "opacity 0.6s ease, transform 0.6s ease"
  observer.observe(el)
})

// Video background fallback
const heroVideo = document.getElementById("heroVideo")
if (heroVideo) {
  heroVideo.addEventListener("error", () => {
    console.log("[v0] Video failed to load, using fallback background")
    const videoBackground = document.querySelector(".video-background")
    if (videoBackground) {
      videoBackground.style.background = "linear-gradient(135deg, #1A1A1A 0%, #2D2D2D 100%)"
    }
  })
}

// Form validation
const contactForm = document.getElementById("contactForm")
if (contactForm) {
  contactForm.addEventListener("submit", (e) => {
    const email = contactForm.querySelector("#email").value
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/

    if (!emailRegex.test(email)) {
      e.preventDefault()
      alert("Please enter a valid email address")
      return false
    }
  })
}

function animateCounter(element, target, duration = 2000) {
  const start = 0
  const increment = target / (duration / 16)
  let current = start

  const timer = setInterval(() => {
    current += increment
    if (current >= target) {
      element.textContent = target + (target < 100 ? "%" : "+")
      clearInterval(timer)
    } else {
      element.textContent = Math.floor(current) + (target < 100 ? "%" : "+")
    }
  }, 16)
}

const heroStats = document.querySelectorAll(".stat-item[data-count]")
if (heroStats.length > 0) {
  const statsObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting && !entry.target.classList.contains("counted")) {
          entry.target.classList.add("counted")
          const target = Number.parseFloat(entry.target.dataset.count)
          const numberElement = entry.target.querySelector(".stat-number")
          animateCounter(numberElement, target)
        }
      })
    },
    { threshold: 0.5 },
  )

  heroStats.forEach((stat) => statsObserver.observe(stat))
}

// Declare AOS variable before using it
const AOS = window.AOS

if (typeof AOS !== "undefined") {
  AOS.init({
    duration: 800,
    easing: "ease-out",
    once: true,
    offset: 100,
    disable: "mobile",
  })
}

const heroSection = document.querySelector(".hero-section")
if (heroSection) {
  window.addEventListener("scroll", () => {
    const scrolled = window.pageYOffset
    const heroContent = document.querySelector(".hero-content")
    if (heroContent && scrolled < window.innerHeight) {
      heroContent.style.transform = `translateY(${scrolled * 0.5}px)`
      heroContent.style.opacity = 1 - scrolled / window.innerHeight
    }
  })
}

const demoMenuItems = document.querySelectorAll(".demo-menu-item")
demoMenuItems.forEach((item, index) => {
  item.addEventListener("mouseenter", () => {
    demoMenuItems.forEach((i) => i.classList.remove("active"))
    item.classList.add("active")
  })
})

const chartBars = document.querySelectorAll(".chart-bar")
if (chartBars.length > 0) {
  const chartObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          chartBars.forEach((bar, index) => {
            setTimeout(() => {
              bar.style.animation = "growBar 1.5s ease-out forwards"
            }, index * 100)
          })
        }
      })
    },
    { threshold: 0.5 },
  )

  const demoChart = document.querySelector(".demo-chart")
  if (demoChart) {
    chartObserver.observe(demoChart)
  }
}

document.querySelectorAll(".btn").forEach((button) => {
  button.addEventListener("click", function (e) {
    const ripple = document.createElement("span")
    const rect = this.getBoundingClientRect()
    const size = Math.max(rect.width, rect.height)
    const x = e.clientX - rect.left - size / 2
    const y = e.clientY - rect.top - size / 2

    ripple.style.width = ripple.style.height = size + "px"
    ripple.style.left = x + "px"
    ripple.style.top = y + "px"
    ripple.classList.add("ripple")

    this.appendChild(ripple)

    setTimeout(() => ripple.remove(), 600)
  })
})

const productCards = document.querySelectorAll(".product-card")
if (productCards.length > 0) {
  const productObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
          setTimeout(() => {
            entry.target.style.opacity = "1"
            entry.target.style.transform = "translateY(0)"
          }, index * 100)
        }
      })
    },
    { threshold: 0.1 },
  )

  productCards.forEach((card) => {
    card.style.opacity = "0"
    card.style.transform = "translateY(30px)"
    card.style.transition = "opacity 0.6s ease, transform 0.6s ease"
    productObserver.observe(card)
  })
}

const featureCards = document.querySelectorAll(".feature-card")
featureCards.forEach((card) => {
  card.addEventListener("mouseenter", function () {
    this.style.transform = "translateY(-8px) scale(1.02)"
  })

  card.addEventListener("mouseleave", function () {
    this.style.transform = "translateY(0) scale(1)"
  })
})

const testimonialCards = document.querySelectorAll(".testimonial-card")
testimonialCards.forEach((card) => {
  card.addEventListener("mouseenter", function () {
    this.style.transform = "translateY(-4px) scale(1.02)"
  })

  card.addEventListener("mouseleave", function () {
    this.style.transform = "translateY(0) scale(1)"
  })
})

console.log("[v0] LT Software website initialized with enhanced interactions")

document.addEventListener("DOMContentLoaded", () => {
  function openModal(modal) {
    if (!modal) return
    modal.style.display = "flex"
    setTimeout(() => modal.classList.add("active"), 10)
    document.body.style.overflow = "hidden"
  }

  function closeModal(modal) {
    if (!modal) return
    modal.classList.remove("active")
    setTimeout(() => (modal.style.display = "none"), 200)
    document.body.style.overflow = ""
  }

  document.querySelectorAll('[data-modal-target]').forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault()
      const selector = btn.getAttribute("data-modal-target")
      const modal = document.querySelector(selector)
      openModal(modal)
    })
  })

  document.querySelectorAll(".modal .modal-close").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      const modal = btn.closest(".modal")
      closeModal(modal)
    })
  })

  document.querySelectorAll(".modal").forEach((modal) => {
    modal.addEventListener("click", (e) => {
      if (e.target === modal) {
        closeModal(modal)
      }
    })
  })

  // Close with ESC
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      document.querySelectorAll(".modal").forEach((m) => {
        if (m.style.display === "flex") closeModal(m)
      })
    }
  })

  // Demo booking form handler - Pure Google Calendar integration
  const demoBookingForm = document.getElementById("demoBookingForm")
  if (demoBookingForm) {
    // Set minimum date to tomorrow
    const bookingDateInput = document.getElementById("bookingDate")
    const today = new Date()
    const tomorrow = new Date(today)
    tomorrow.setDate(tomorrow.getDate() + 1)
    const minDate = tomorrow.toISOString().split("T")[0]
    bookingDateInput.setAttribute("min", minDate)

    demoBookingForm.addEventListener("submit", (e) => {
      e.preventDefault()

      const submitBtn = demoBookingForm.querySelector('button[type="submit"]')
      const originalText = submitBtn.textContent
      submitBtn.disabled = true
      submitBtn.textContent = "Adding to Calendar..."

      // Get form values
      const name = document.getElementById("bookingName").value
      const email = document.getElementById("bookingEmail").value
      const company = document.getElementById("bookingCompany").value
      const phone = document.getElementById("bookingPhone").value
      const date = document.getElementById("bookingDate").value
      const time = document.getElementById("bookingTime").value
      const product = document.getElementById("bookingProduct").value
      const message = document.getElementById("bookingMessage").value

      // Validate required fields
      if (!name || !email || !date || !time || !product) {
        alert("Please fill in all required fields.")
        submitBtn.disabled = false
        submitBtn.textContent = originalText
        return
      }

      // Create Google Calendar event URL
      const [year, month, day] = date.split("-")
      const [hours, minutes] = time.split(":")
      
      // Format start time (ISO 8601 format for Google Calendar)
      const startDateTime = new Date(year, month - 1, day, hours, minutes)
      const endDateTime = new Date(startDateTime)
      endDateTime.setHours(endDateTime.getHours() + 1) // 1 hour demo

      // Function to format date for Google Calendar
      function formatGoogleCalendarDate(dateObj) {
        const year = dateObj.getFullYear()
        const month = String(dateObj.getMonth() + 1).padStart(2, '0')
        const day = String(dateObj.getDate()).padStart(2, '0')
        const hours = String(dateObj.getHours()).padStart(2, '0')
        const mins = String(dateObj.getMinutes()).padStart(2, '0')
        const secs = String(dateObj.getSeconds()).padStart(2, '0')
        return `${year}${month}${day}T${hours}${mins}${secs}`
      }

      const startTime = formatGoogleCalendarDate(startDateTime)
      const endTime = formatGoogleCalendarDate(endDateTime)

      // Build event details
      const eventTitle = `NetCost Demo - ${product}`
      const eventDetails = `Demo with: ${name}
Email: ${email}
Company: ${company}
Phone: ${phone}
Product: ${product}
${message ? 'Notes: ' + message : ''}`

      // Create Google Calendar link
      const googleCalendarUrl = `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(eventTitle)}&dates=${startTime}/${endTime}&details=${encodeURIComponent(eventDetails)}&location=Online%20Meeting&trp=true`

      // Send email to admin via Formspree or similar (optional fallback)
      // For now, we'll just open Google Calendar
      
      // Show confirmation
      const confirmMsg = `Demo scheduled!\n\nName: ${name}\nEmail: ${email}\nProduct: ${product}\nDate: ${date} at ${time}\n\nClick OK to add to your Google Calendar.`
      
      if (confirm(confirmMsg)) {
        // Open Google Calendar in new tab
        window.open(googleCalendarUrl, '_blank')
        
        // Also send a quick email notification (using a simple service)
        // You can integrate this with a service like Formspree
        sendBookingNotification(name, email, company, phone, date, time, product, message)
      }

      // Reset form and close modal
      demoBookingForm.reset()
      const modal = demoBookingForm.closest(".modal")
      closeModal(modal)
      
      submitBtn.disabled = false
      submitBtn.textContent = originalText
    })
  }

  // Send booking notification email (using FormSubmit or similar service)
  function sendBookingNotification(name, email, company, phone, date, time, product, message) {
    // Optional: Send notification via Formspree or your backend
    // This is a fallback - Google Calendar is primary
    console.log("Demo booked:", {name, email, company, phone, date, time, product, message})
    
    // You could add an optional email service here if needed
    // Example: Send to Formspree for email notification
  }
})
