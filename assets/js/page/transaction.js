$("#create-transaction").on("submit", (e) => {
    e.preventDefault()
    $("#transaction-success").hide()
    $("#transaction-failed").hide()
    $('#submit').addClass('btn-progress')
    let data = $("#create-transaction").serialize()

    setTimeout(() => {
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: _baseUrl + "transaction/create",
            data: data,
            success: function (response) {
                if (response.status) {
                    $("#transaction-success").html(response.message)
                    $("#transaction-success").show()
                    $('#submit').removeClass('btn-progress')
                    setTimeout(() => {
                        window.location.href = response.data.CALLBACK
                    }, 1500);
                } else {
                    $("#transaction-failed").html(response.message)
                    $("#transaction-failed").show()
                    $('#submit').removeClass('btn-progress')
                }
            }
        });
    }, 1500);
})