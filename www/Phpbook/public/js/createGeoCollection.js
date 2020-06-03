$(document).ready (function () {
    $("#createCollectionForm").on("submit", function (event) {
        event.preventDefault();
        $.ajax ({
            url: "/maps",
            type: "POST",
            data: ({
                collectionName: $("#collectionName").val(),
                address: $("#address").val(),
                coords: $("#coords").val(),
            }),
            dataType: "html",
            success: function (data) {
                data = JSON.parse(data);

                if (data.status === 'success') {
                    window.location.href = "/maps/collections";
                }
            }
        })
    });
});