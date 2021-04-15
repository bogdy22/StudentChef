$('#profile-submit').click(function() {
    if ($('#detailsName').val()) {
    	$('#change-details-form').submit();
    }
    else {
        $("#alert").slideDown();
        setTimeout(function() {
            $("#alert").slideUp();
        }, 3000);
    }
});
