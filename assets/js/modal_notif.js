function showNotificationModal(title, message, type = 'info') {
    const modal = $('#login-modal');

    modal.find('.modal-title').text(title);
    modal.find('.modal-message').html(message);

    const iconMap = {
        info: 'fa-info-circle',
        warning: 'fa-triangle-exclamation',
        error: 'fa-circle-xmark',
        success: 'fa-circle-check'
    };

    modal.find('.modal-icon i')
        .attr('class', `fas ${iconMap[type] || iconMap.info}`);

    modal.addClass('show');
}

$('.modal-ok-btn, .close-btn').on('click', function () {
    if($(this).text() === 'Return'){
       window.location.href = 'http://192.168.42.15:8035/public/home.php';
       this.text("OK")
    }
    $('#login-modal').removeClass('show');
}); 