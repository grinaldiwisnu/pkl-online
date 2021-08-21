'use strict';

$("#add-institution").on("submit", (e) => {
    e.preventDefault()

    let data = $("#add-institution").serialize()

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _baseUrl + "/master/add/institution",
        data: data,
        success: function (response) {
            if (response.status) {
                window.location.reload()
            } else {
                alert(response.message)
            }
        }
    });
})

$("#update-institution").on("submit", (e) => {
    e.preventDefault()

    let data = $("#update-institution").serialize()

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _baseUrl + "/master/update/institution",
        data: data,
        success: function (response) {
            if (response.status) {
                window.location.reload()
            } else {
                alert(response.message)
            }
        }
    });
})

function editInstitution(id) {
    $('#id_admin').val('')
    $('#admin_name').val('')
    $('#admin_email').val('')
    $('#admin_nohp').val('')
    $('#admin_password').val('')


    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _baseUrl + "/master/get/institution/" + id,
        success: function (response) {
            if (response.status) {
                $('#id').val(response.data.INSTITUTION_ID)
                $('#name').val(response.data.INSTITUTION_NAME)
                $('#address').val(response.data.INSTITUTION_ADDRESS)
                if (response.data.ADMIN !== null) {
                    $('#id_admin').val(response.data.ADMIN.ADMIN_ID)
                    $('#admin_name').val(response.data.ADMIN.ADMIN_NAME)
                    $('#admin_email').val(response.data.ADMIN.ADMIN_EMAIL)
                    $('#admin_nohp').val(response.data.ADMIN.ADMIN_NOHP)
                    $('#admin_password').val(response.data.ADMIN.ADMIN_PASSWORD)
                }

                $('#editModal').modal('show')
            } else {
                alert(response.message)
            }
        }
    });
}

$("#update-user-institution").on("submit", (e) => {
    e.preventDefault()

    let data = $("#update-user-institution").serialize()
    console.log(data);

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _baseUrl + "/master/update/user",
        data: data,
        success: function (response) {
            if (response.status) {
                window.location.reload()
            } else {
                alert(response.message)
            }
        }
    });
})

function editUserInstitution(id) {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _baseUrl + "/master/get/user/" + id,
        success: function (response) {
            if (response.status) {
                $('#id').val(response.data.USER_ID)
                $('#fullname').val(response.data.USER_FULLNAME)
                $('#email').val(response.data.USER_EMAIL)
                $('#phone').val(response.data.USER_PHONE)
                $('#target').val(response.data.TARGET)
                $('#status').val(response.data.USER_STATUS)
                if (response.data.COMPANY_ID != null)
                    $('#company').val(response.data.COMPANY_ID)

                $('#editModal').modal('show')
            } else {
                alert(response.message)
            }
        }
    });
}

$("#add-company").on("submit", (e) => {
    e.preventDefault()

    let data = $("#add-company").serialize()

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _baseUrl + "/master/add/company",
        data: data,
        success: function (response) {
            if (response.status) {
                window.location.reload()
            } else {
                alert(response.message)
            }
        }
    });
})

function editCompany(id) {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _baseUrl + "/master/get/company/" + id,
        success: function (response) {
            if (response.status) {
                $('#id').val(response.data.COMPANY_ID)
                $('#name').val(response.data.COMPANY_NAME)
                $('#address').val(response.data.COMPANY_ADDRESS)
                $('#pendamping').val(response.data.COMPANY_PARTNER)
                $('#nohp').val(response.data.COMPANY_NOHP)

                $('#editModal').modal('show')
            } else {
                alert(response.message)
            }
        }
    });
}

$("#update-company").on("submit", (e) => {
    e.preventDefault()

    let data = $("#update-company").serialize()
    console.log(data);

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _baseUrl + "/master/update/company",
        data: data,
        success: function (response) {
            if (response.status) {
                window.location.reload()
            } else {
                alert(response.message)
            }
        }
    });
})

$("#add-product").submit(function(e) {
    e.preventDefault()

    let data = $("#add-product").serialize()
    var formData = new FormData(this)
    $.ajax({
        type: "POST",
        url: _baseUrl + "/master/add/product",
        data: formData,
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        dataType:'json',
        success: function (response) {
            if (response.status) {
                window.location.reload()
            } else {
                alert(response.message)
            }
        }
    });
})

$("#update-product").submit(function(e) {
    e.preventDefault()

    var formData = new FormData(this)
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _baseUrl + "/master/update/product",
        data: formData,
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        dataType:'json',
        success: function (response) {
            if (response.status) {
                window.location.reload()
            } else {
                alert(response.message)
            }
        }
    });
})

function editProduct(id) {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _baseUrl + "/master/get/product/" + id,
        success: function (response) {
            if (response.status) {
                let img = _baseUrlOrigin + "assets/img/news/img09.jpg"
                if (response.data.IMAGE != null) {
                    img = _baseUrlOrigin + "upload/products/" + response.data.IMAGE.PRODUCT_IMAGE_NAME
                }
                $('#id').val(response.data.PRODUCT_ID)
                $('#name').val(response.data.PRODUCT_NAME)
                $('#stock').val(response.data.PRODUCT_STOCK)
                $('#price').val(response.data.PRODUCT_PRICE)
                $('#desc').val(response.data.PRODUCT_DESCRIPTION)
                $('#category').val(response.data.CATEGORY_ID)
                $('.gallery-item').attr("data-image", img)
                $('.gallery-item').attr("style", "height: 350px; background-image: url('"+ img +"');")

                $('#editModal').modal('show')
            } else {
                alert(response.message)
            }
        }
    });
}

function deleteProduct(id) {
    
    if (confirm('Ingin mengapus produk')) {
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: _baseUrl + "/master/delete/product/" + id,
            success: function (response) {
                if (response.status) {
                    window.location.reload()
                } else {
                    alert(response.message)
                }
            }
        });
    }
}

$("#add-category").on("submit", (e) => {
    e.preventDefault()

    let data = $("#add-category").serialize()

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _baseUrl + "/master/add/category",
        data: data,
        success: function (response) {
            if (response.status) {
                window.location.reload()
            } else {
                alert(response.message)
            }
        }
    });
})

$("#update-category").on("submit", (e) => {
    e.preventDefault()

    let data = $("#update-category").serialize()

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _baseUrl + "/master/update/category",
        data: data,
        success: function (response) {
            if (response.status) {
                window.location.reload()
            } else {
                alert(response.message)
            }
        }
    });
})

function editCategory(id) {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _baseUrl + "/master/get/category/" + id,
        success: function (response) {
            if (response.status) {
                $('#id').val(response.data.CATEGORY_ID)
                $('#name').val(response.data.CATEGORY_NAME)

                $('#editModal').modal('show')
            } else {
                alert(response.message)
            }
        }
    });
}

function deleteCategory(id) {
    
    if (confirm('Ingin mengapus category')) {
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: _baseUrl + "/master/delete/category/" + id,
            success: function (response) {
                if (response.status) {
                    window.location.reload()
                } else {
                    alert(response.message)
                }
            }
        });
    }
}

$("#add-job").submit(function(e) {
    e.preventDefault()

    var formData = new FormData(this)
    $.ajax({
        type: "POST",
        url: _baseUrl + "/master/add/job",
        data: formData,
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        dataType:'json',
        success: function (response) {
            if (response.status) {
                window.location.reload()
            } else {
                alert(response.message)
            }
        }
    });
})

$("#update-job").submit(function(e) {
    e.preventDefault()

    var formData = new FormData(this)
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _baseUrl + "/master/update/job",
        data: formData,
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        dataType:'json',
        success: function (response) {
            if (response.status) {
                window.location.reload()
            } else {
                alert(response.message)
            }
        }
    });
})

function editJob(id) {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _baseUrl + "/master/get/job/" + id,
        success: function (response) {
            if (response.status) {
                let img = _baseUrlOrigin + "assets/img/news/img09.jpg"
                if (response.data.JOB_POSITION != null) {
                    img = _baseUrlOrigin + "upload/jobs/" + response.data.JOB_POSTER
                }
                $('#id').val(response.data.JOB_ID)
                $('#position').val(response.data.JOB_POSITION)
                $('#company').val(response.data.JOB_COMPANY)
                $('#start').val(response.data.JOB_START)
                $('#end').val(response.data.JOB_END)
                $('#description').val(response.data.JOB_DESCRIPTION)
                $('.gallery-item').attr("data-image", img)
                $('.gallery-item').attr("style", "height: 350px; background-image: url('"+ img +"');")

                $('#editModal').modal('show')
            } else {
                alert(response.message)
            }
        }
    });
}

function deleteJob(id) {
    
    if (confirm('Ingin mengapus pekerjaan?')) {
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: _baseUrl + "/master/delete/job/" + id,
            success: function (response) {
                if (response.status) {
                    window.location.reload()
                } else {
                    alert(response.message)
                }
            }
        });
    }
}