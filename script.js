document.addEventListener("DOMContentLoaded", function() {
    // Smooth scrolling for anchor links
    const scrollLinks = document.querySelectorAll('a[href^="#"]');
    scrollLinks.forEach(link => {
        link.addEventListener("click", function(e) {
            e.preventDefault();

            const targetId = this.getAttribute("href").slice(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                const offsetTop = targetElement.offsetTop;
                window.scrollTo({
                    top: offsetTop,
                    behavior: "smooth"
                });
            }
        });
    });

    // Form validation for contact form
    const contactForm = document.getElementById("contact-form");
    if (contactForm) {
        contactForm.addEventListener("submit", function(e) {
            e.preventDefault();

            const nameInput = document.getElementById("name");
            const emailInput = document.getElementById("email");
            const messageInput = document.getElementById("message");

            const nameValue = nameInput.value.trim();
            const emailValue = emailInput.value.trim();
            const messageValue = messageInput.value.trim();

            if (nameValue === "") {
                setErrorFor(nameInput, "Name cannot be blank");
            } else {
                setSuccessFor(nameInput);
            }

            if (emailValue === "") {
                setErrorFor(emailInput, "Email cannot be blank");
            } else if (!isValidEmail(emailValue)) {
                setErrorFor(emailInput, "Email is not valid");
            } else {
                setSuccessFor(emailInput);
            }

            if (messageValue === "") {
                setErrorFor(messageInput, "Message cannot be blank");
            } else {
                setSuccessFor(messageInput);
            }
        });
    }

    function setErrorFor(input, message) {
        const formControl = input.parentElement;
        const errorMessage = formControl.querySelector(".error-message");

        formControl.classList.add("error");
        errorMessage.innerText = message;
    }

    function setSuccessFor(input) {
        const formControl = input.parentElement;
        formControl.classList.remove("error");
    }

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});
