let $cmsName, cmsName, cmsContent;

window.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('img[data-cms]').forEach(item => {
        item.addEventListener('click', event => {
            if (event.currentTarget === event.target) {
                event.preventDefault();
                $cmsName = item;
                cmsName = $cmsName.dataset.cms;
                document.getElementById('cms-image').click();
            }
        });
    });

    document.querySelectorAll('[data-cms]:not(img)').forEach(item => {
        item.addEventListener('click', event => {
            if (event.currentTarget === event.target) {
                event.preventDefault();
                item.focus();
                cmsContent = item.innerText;
                item.contentEditable = true;
            }
        });

        item.addEventListener('blur', event => {
            if (item.innerText !== cmsContent) {
                fetchCms(item.dataset.cms, item.innerText, null, data => {
                    item.innerText = data.content;
                });
            }
        });
    });

    document.querySelectorAll('[data-cms-background]').forEach(item => {
        item.addEventListener('click', event => {
            if (event.currentTarget === event.target) {
                event.preventDefault();
                $cmsName = item;
                cmsName = $cmsName.dataset.cmsBackground;
                document.getElementById('cms-image').click();
            }
        });
    });

    document.querySelectorAll('[data-cms-listener]').forEach(item => {
        item.addEventListener('click', event => {
            if (event.currentTarget === event.target) {
                event.preventDefault();
                clickCms(`[data-cms-background=${event.target.dataset.cmsListener}]`);
                clickCms(`img[data-cms=${event.target.dataset.cmsListener}]`);
            }
        });
    });

    let $cmsImage = document.createElement("input");
    $cmsImage.id = "cms-image";
    $cmsImage.style.display = "none";
    $cmsImage.type = "file";
    $cmsImage.accept = "image/*";
    document.body.appendChild($cmsImage);

    document.getElementById("cms-image").onchange = function () {
        if (this.files.length) {
            fetchCms(cmsName, null, this.files[0], data => {
                if ($cmsName.tagName.toLowerCase() === 'img') {
                    $cmsName.src = data.content;
                } else {
                    $cmsName.style.backgroundImage = `url(${data.content})`;
                }
                this.value = '';
            });
        }
    };
});

function fetchCms(name, content, file, callback) {
    let formData = new FormData();
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
    formData.append('name', name);
    formData.append('content', content);
    if (file) {
        formData.append('file', file);
    }

    fetch('/admin/cms', {method: 'POST', body: formData})
        .then(response => response.json())
        .then(data => {
            callback(data);
        });
}

function clickCms(element) {
    let $element = document.querySelector(element);
    if ($element) {
        $element.click();
    }
}
