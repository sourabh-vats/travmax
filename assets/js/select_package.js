$(document).ready(function () {
    $(".select_package_id").click(function () {
        console.log($(this).attr("title"));
        console.log($(this).parent().children(".package_information").val());
    });
});
