$('#btnSubmit').click(function () {
    var url, data;
    url = "../inc/send_message.php";
    data = {
        userTwoId: $('#otherUsers').attr("value"),
        message: $('#message').val()
    }
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: () => {
            loadMessage($('#otherUsers').attr("value"));
            $('#message').val("");
        },
        error: (err) => {
            alert(err)
        }
    });
    return false;
})
