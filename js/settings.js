$(document).ready(function () {

    $('#airavaraSettingsForm #airavataSettings').tabs();


    $("#airavaraSettingsForm #airavataSettingsSubmit").on('click', function (event) {

        event.preventDefault();

        var postData = $('#airavaraSettingsForm').serialize();
        var method = $('#airavaraSettingsForm').attr('method');
        var url = OC.generateUrl('/apps/airavata-nextcloud-app/settings/save');

        $.ajax({
            method: method,
            url: url,
            data: postData,
            success: function (data) {

                var notification = OC.Notification.show(data.message);

                setTimeout(function () {
                    OC.Notification.hide(notification);
                }, 5000);

            },
            error: function (data) {

                var notification = OC.Notification.show(data.message);

                setTimeout(function () {
                    OC.Notification.hide(notification);
                }, 5000);
            }
        });
    });
});
