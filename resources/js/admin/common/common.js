$(function () {
    let csrfToken = $('meta[name=csrf-token]').attr("content");
    let title = $('meta[name=title]').attr("content");
    let success = $('meta[name=success]').attr("content");
    let error = $('meta[name=error]').attr("content");
    if (success) {
        toastr.info(success, title, {timeOut: 2000});

    }
    if (error) {
        toastr.error(error, title, {timeOut: 2000});
    }

    $('.js-datatable').DataTable({
        responsive: true,
        "order": [[0, "desc"]],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, Language.all]]
    });

    $('.js-dropify').dropify();

    $('.js-summernote').each(function () {
        $(this).summernote({
            placeholder: $(this).attr('placeholder'),
            minHeight: 300,
            callbacks: {
                onMediaDelete: function (target) {
                    let url = target[0].getAttribute('src');
                    if (!url.includes('/images', 0)) {
                        return;
                    }

                    let formData = new FormData();
                    formData.append('_token', csrfToken);
                    formData.append('url', url);

                    fetch('/admin/image/delete', {method: 'POST', body: formData}).then();
                }
            }
        });
    });

    $(".js-delete-sweetalert").on('click', function (event) {
        event.preventDefault();
        Swal.fire({
            title: Language.titleDelete,
            text: Language.descriptionDelete,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: Language.confirmDelete,
            cancelButtonText: Language.cancelDelete
        }).then((result) => {
            if (result.value) {
                $(this).unbind('click').click();
            }
        })
    });

    document.querySelectorAll('.js-character-input').forEach(item => {
        item.parentElement.querySelector('.js-character-label').textContent = item.value.length;
        item.addEventListener('keyup', event => {
            if (event.currentTarget === event.target) {
                item.parentElement.querySelector('.js-character-label').textContent = item.value.length;
            }
        });
    });

    $('#js-slug-button').on('click', function () {
        let title = $('#title').val();
        if (title) {
            let formData = new FormData();
            formData.append('_token', $('meta[name=csrf-token]').attr("content"));
            formData.append('title', title);
            $.ajax({
                type: "POST", url: "/admin/generate-slug", contentType: false,
                cache: false, processData: false, data: formData,
                success: function (data) {
                    $('#slug').focus().val(data);
                }
            });
        }
    });
});
