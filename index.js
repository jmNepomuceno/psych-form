$(document).ready(function(){
    // Function to handle login
    // let modal_notif = new bootstrap.Modal(document.getElementById('modal-notif'));
    // modal_notif.hide();
    
    function handleLogin() {
        const username_input = $('#username').val();
        const password_input = $('#password').val();

        console.log(username_input, password_input);

        // Modal references
        const loginModal = $('#login-modal');
        const modalMessage = $('#login-modal .modal-message');

        // Close buttons
        $('#login-modal .close-btn, #login-modal .modal-ok-btn').click(function() {
            loginModal.removeClass('show');
        });

        // AJAX login
        $.ajax({
            url: './assets/php/login.php',
            method: "POST",
            data: {
                username: username_input,
                password: password_input
            },
            success: function(response) {
                if (response === "invalid") {
                    $('#login-modal .modal-title').text("Invalid Credentials");
                    modalMessage.text("The username or password you entered is incorrect.");
                    loginModal.addClass('show'); // ✅ THIS is the key
                } else {
                    window.location.href = response;
                }
            }
        });

    }

    // Trigger login on button click
    $('#login-btn').click(function(e) {
        e.preventDefault(); // Prevent form submission  
        handleLogin();
    });

    // Trigger login on Enter key press
    $('#username-txt, #password-txt').keydown(function(event) {
        if (event.key === "Enter" || event.keyCode === 13) {
            handleLogin();
        }
    });

})