var url = window.location.href;
var localization = url.match(/\/([a-zA-Z]{2})\//)[1];
var originLink = window.location.origin;

// Start Get Sub Category
$(function () {
    console.log(window.location.origin);
    data();
    $("#category_id").on("change", function () {
        data();
    });
});

function data() {
    const id = $("#category_id").val();
    if (id) {
        $.ajax({
            type: "GET",
            url: `${window.location.origin}/get_data/${id}`,
            success: function (response) {
                $("#sub_category_id").empty();
                $.each(response.data, function (i, ele) {
                    $("#sub_category_id").append(
                        `<option value="${ele.id}">${ele.title[localization]}</option>`
                    );
                });
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });
    }
}

// Start Logic Notifications Code (Reale Time)

// setInterval(() => {
$(function () {
    $.ajax({
        type: "GET",
        url: `${window.location.origin}/notifications`,
        success: function (response) {
            var eleNotifications = $(
                ".notifications .notifications-body .notifications-ele"
            );
            var count = response.count > 99 ? "99+" : response.count;
            $(".notifications-count").html(count);
            if (count > 0) {
                eleNotifications.empty();
                $.each(response.notifications, function (i, notification) {
                    var ele = notification.data.data;
                    eleNotifications.append(`
                        <a class="nav-link bg-secondary-subtle d-flex" href="#">
                            <img src="${originLink}/${ele.photo}" width="125" height="75"/>
                            <div class="content ps-3">
                                <h5 class="text-black mb-0">${ele.title[localization]}</h5>
                                <p class="mb-0">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quas explicabo corrupti, error voluptatems</p>
                            </div>
                        </a>
                    `);
                });
            } else {
                eleNotifications.append(
                    `<p class="text-center p-5 m-5 fs-5 fw-bold">Not Found Notifications</p>`
                );
            }
        },
    });
});
// }, 2000);

$(".notifications").on("click", function () {
    $(".notifications-body").toggleClass("d-none");
});
