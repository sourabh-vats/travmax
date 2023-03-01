$(document).ready(function () {
    $(".select_package_id").click(function () {
        var package = $(this).parent().children(".package_information").val();
        package = JSON.parse(package);
        $("#pick_a_plan_section").removeClass("d-none");
        $("#travnow_price").text(package['total']);
        $("input[name=package_id]").val(package['id']);
    });

    $(".plan_box").click(function () {
        $(this).addClass("selected");
        var planName = $(this).attr("id");
        var planId;
        switch (planName) {
            case "travnow_plan":
                planId = 1;
                break;
            case "travlater_plan":
                planId = 2;
                break;
            case "traveasy_plan":
                planId = 3;
                break;
            default:
                break;
        }
        $("input[name=payment_type]").val(planId);
    })
});
