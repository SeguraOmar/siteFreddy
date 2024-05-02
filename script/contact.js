function sendEmail() {
    var email = document.getElementById("email").value;
    var message = document.getElementById("message").value;
    var subject = "Contact Form Submission";
    var body = "Email: " + email + "\n\nMessage: " + message;

    window.location.href = "mailto:omarsegura76300@gmail.com?subject=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(body);
}