$(document).ready(function () {
    $(".select_package_id").click(function () {
        console.log($(this).attr("title"));
        var package = $(this).parent().children(".package_information").val();
        package = JSON.parse(package);
        $("#pick_a_plan_section").removeClass("d-none");
        $("#travnow_price").text(package['total']);
        $("input[name=package_id]").val(package['id']);
    });
});
