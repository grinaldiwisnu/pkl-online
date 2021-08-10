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

$("#payment-method").submit(function(e) {
    e.preventDefault()

    const name = $("#name").val()
    const norek = $("#norek").val()
    const proof = $("#proof").val()

    if (name == "" || norek == "" || proof == "") {
        Swal.fire(
            'Gagal!',
            'Data masih ada yang kosong!',
            'error'
          )
          return
    }

    const formData = new FormData(this)

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
      })
      
      swalWithBootstrapButtons.fire({
        title: 'Pembayaran',
        text: "apakah data pembayaran sudah benar?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Iya',
        cancelButtonText: 'Tidak',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: _baseUrl + "/transaction/payment",
                data: formData,
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                dataType: 'json',
                success: function (response) {
                    console.log(response)
                    if (response.status) {
                        Swal.fire(
                            'Berhasil!',
                            'Bukti Pembayaran Berhasil Disimpan, Tunggu Pembayaran Terverifikasi!',
                            'success'
                          )
                        setTimeout(() => {
                            window.location.reload()
                        }, 1500);
                    } else {
                        Swal.fire(
                            'Gagal!',
                            response.message,
                            'error'
                          )
                    }
                }
            });
        }
      })
})

function updateStatus(id, sts) {
    if (id == '' || sts == '') {
        return
    }

    const data = new FormData()
    data.append('trans_id', id)
    data.append('status', sts)

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
      })
      
      swalWithBootstrapButtons.fire({
        title: 'Status Pemesanan',
        text: "apakah anda ingin merubah status pemesanan?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Iya',
        cancelButtonText: 'Tidak',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: _baseUrl + "transaction/status",
                data: data,
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function (response) {
                    if (response.status) {
                        Swal.fire(
                            'Berhasil!',
                            'Status berhasil diperbarui!',
                            'success'
                          )
                        setTimeout(() => {
                            window.location.reload()
                        }, 1500);
                    } else {
                        Swal.fire(
                            'Gagal!',
                            response.message,
                            'error'
                          )
                    }
                }
            });
        }
      })
}