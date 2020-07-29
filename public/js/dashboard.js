$(document).ready(function () {
    $('#DropdownItems').hide();
    $('#dashboard').on('click', function () {
            $('#DropdownItems').toggle().toggleClass('d-flex flex-column position-absolute');
    })
})
