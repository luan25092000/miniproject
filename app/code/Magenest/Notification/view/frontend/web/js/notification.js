require(['jquery'], function ($) {
    $(document).ready(function () {
        $(".notification").append("<span class='count'>1</span>");
        let url = "http://nhlmg.com/notification/index/count";
        jQuery.ajax({
            url: url,
            type: "POST",
            showLoader: true,
            cache: false,
            success: function (response) {
                $(".count").html(response);
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
});
