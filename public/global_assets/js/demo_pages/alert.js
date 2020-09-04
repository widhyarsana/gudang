/* ------------------------------------------------------------------------------
 *
 *  # Sweet Alert component
 *
 *  Demo JS code for extra_sweetalert.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var SweetAlert = function () {


    //
    // Setup module components
    //

    // Sweet Alerts
    var _componentSweetAlert = function () {
        if (typeof swal == 'undefined') {
            console.warn('Warning - sweet_alert.min.js is not loaded.');
            return;
        }

        // Defaults
        var swalInit = swal.mixin({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light'
        });

        // ============================================================
        // alert succces
        var message = $('#message').val();
        if (message) {
            swalInit.fire({
                text: message,
                type: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top-right'
            });

        }

        // ========================================================


        // ==========================================================
        // delete on admin
        var sub = $('#sub').val();
        var obj = $('#obj').val();
        $('body').on('click', '.delete-item', function (e) {
            var btn = $(this);
            var id = btn.attr('data-id');
            console.log(id);
            swalInit.fire({
                title: 'Yakin Hapus?',
                text: "Jika sudah dihapus data tidak bisa dikembalikan lagi",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus !',
                cancelButtonText: 'Batal !',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: "/" + sub + "/" + obj + "/delete",
                        headers: {
                            'X-CSRF-TOKEN': $('#csrf').val(),
                            Accept: "application/json"
                        },
                        type: 'post',
                        data: {
                            'id': id,
                        }
                    }).done(function (response) {
                        swalInit.fire(
                            'Berhasil',
                            'Data telah dihapus.',
                            'success'
                        );
                        $('#child').remove();
                        $('#content').html(response['content']);
                    });

                }
                else if (result.dismiss === swal.DismissReason.cancel) {
                    swalInit.fire(
                        'Batal',
                        'Data tidak jadi dihapus',
                        'error'
                    );
                }
            });

        });

        $('body').on('click', '.delete-item-no', function (e) {
            var btn = $(this);
            var id = btn.attr('data-id');
            console.log(id);
            swalInit.fire({
                title: 'Yakin Hapus?',
                text: "Jika sudah dihapus data tidak bisa dikembalikan lagi",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus !',
                cancelButtonText: 'Batal !',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    window.location = "/" + sub + "/" + obj + "/delete/" + id;

                }
                else if (result.dismiss === swal.DismissReason.cancel) {
                    swalInit.fire(
                        'Batal',
                        'Data tidak jadi dihapus',
                        'error'
                    );
                }
            });

        });


        // =========================================================
        // update cart
        $('body').on('click', '.update-cart', function (e) {
            var btn = $(this);

            console.log(12);

            var count = $('#cartsCount').val();
            var data = [];
            var product = [];
            var qty = [];

            for (i = 1; i <= count; i++) {
                var a = $('#product_' + i).val();
                var b = $('#value_' + i).val();

                product.push(
                    a
                );
                qty.push(
                    b
                );
            }
            $.ajax({
                url: "/customer/product/cart/update",
                headers: {
                    'X-CSRF-TOKEN': $('#csrf').val(),
                    Accept: "application/json"
                },
                type: 'post',
                data: {
                    'product': product,
                    'qty': qty
                }
            }).done(function (response) {
                product = [];
                qty = [];
                $('#child').remove();
                $('#cart-content').html(response['content']);
                swalInit.fire({
                    text: 'Success toast message',
                    type: 'success',
                    toast: true,
                    showConfirmButton: false,
                    position: 'top-right'
                });
            });

        });

        // ============================================================
        // logout
        $('#logout-button').on('click', function () {
            swalInit.fire({
                title: 'Yakin Keluar?',
                text: "Anda akan keluar dari sistem dan dapat masuk kembali",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Keluar !',
                cancelButtonText: 'Batal !',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    swalInit.fire(
                        'Berhasil',
                        'Anda berhasil Keluar.',
                        'success'
                    );

                    setTimeout(function () {
                        $("#logout-form").submit();
                    }, 3000);


                }
                else if (result.dismiss === swal.DismissReason.cancel) {
                    swalInit.fire(
                        'Batal',
                        'Tidak jadi keluar sistem',
                        'error'
                    );
                }
            });
        });

        // ==============================================


        // Success alert
        $('#sweet_toast_success').on('click', function () {
            swalInit.fire({
                text: 'Success toast message',
                type: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top-right'
            });
        });

        var i = 0;
        $('#sweet_toast_success1').on('click', function () {
            i = 1;
        });

        if (i == 1) {
            swalInit.fire({
                text: 'Success toast message',
                type: 'error',
                toast: true,
                showConfirmButton: false,
                position: 'top-right'
            });
        }


        // Error alert
        $('#sweet_toast_error').on('click', function () {
            swalInit.fire({
                text: 'Something went wrong!',
                type: 'error',
                toast: true,
                showConfirmButton: false,
                position: 'top-right'
            });
        });

        // Warning alert
        $('#sweet_toast_warning').on('click', function () {
            swalInit.fire({
                text: 'Warning toast message',
                type: 'warning',
                toast: true,
                showConfirmButton: false,
                position: 'top-right'
            });
        });

        // Info alert
        $('#sweet_toast_info').on('click', function () {
            swalInit.fire({
                text: 'Info toast message',
                type: 'info',
                toast: true,
                showConfirmButton: false,
                position: 'top-right'
            });
        });

        // Question
        $('#sweet_toast_question').on('click', function () {
            swalInit.fire({
                text: 'Toast message with question',
                type: 'question',
                toast: true,
                showConfirmButton: false,
                position: 'top-right'
            });
        });


        // Top
        $('#sweet_toast_top').on('click', function () {
            swalInit.fire({
                text: 'Success toast message',
                type: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top'
            });
        });

        // Top left
        $('#sweet_toast_top_left').on('click', function () {
            swalInit.fire({
                text: 'Success toast message',
                type: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top-left'
            });
        });

        // Center left
        $('#sweet_toast_center_left').on('click', function () {
            swalInit.fire({
                text: 'Success toast message',
                type: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'center-left'
            });
        });

        // Center
        $('#sweet_toast_center').on('click', function () {
            swalInit.fire({
                text: 'Success toast message',
                type: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'center'
            });
        });

        // Center right
        $('#sweet_toast_center_right').on('click', function () {
            swalInit.fire({
                text: 'Success toast message',
                type: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'center-right'
            });
        });

        // Bottom left
        $('#sweet_toast_bottom_left').on('click', function () {
            swalInit.fire({
                text: 'Success toast message',
                type: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'bottom-left'
            });
        });

        // Bottom
        $('#sweet_toast_bottom').on('click', function () {
            swalInit.fire({
                text: 'Success toast message',
                type: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'bottom'
            });
        });

        // Bottom right
        $('#sweet_toast_bottom_right').on('click', function () {
            swalInit.fire({
                text: 'Success toast message',
                type: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'bottom-right'
            });
        });



    };



    return {
        initComponents: function () {
            _componentSweetAlert();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function () {
    SweetAlert.initComponents();
});


