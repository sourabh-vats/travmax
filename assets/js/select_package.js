$(document).ready(function () {
    $(".select_package_id").click(function () {
        console.log($(this).attr("title"));
        console.log($(this).parent().child(".package_information").val());
    });
});
