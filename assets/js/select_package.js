$(document).ready(function () {
    $(".select_package_id").click(function () {
        var package = $(this).parent().children(".package_information").val();
        package = JSON.parse(package);
        $("#pick_a_plan_section").removeClass("d-none");
        $("#travnow_price").text(package['total']);
        $("input[name=package_id]").val(package['id']);
        $(".plan_box").each(function () {
            $(this).removeClass("selected");
        })
        $("#book_package_btn").addClass("d-none");
    });

    $(".plan_box").click(function () {
        $(".plan_box").each(function () {
            $(this).removeClass("selected");
        })
        $(this).addClass("selected");
        var planName = $(this).attr("id");
        $("input[name=payment_type]").val(planName);
        $("#book_package_btn").removeClass("d-none");
    })
});
