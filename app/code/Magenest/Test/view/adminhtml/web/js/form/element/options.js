require(['jquery'], function ($) {
    $(".admin__control-select").click(function () {
        let country = $(".admin__control-select").val();
        let url = "http://nhlmg.com/admin/test/index/filter";
        $.ajax({
            url: url,
            data: {selected: country},
            showLoader: true,
            cache: false,
            success: function (response) {
                console.log(response);
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
});
