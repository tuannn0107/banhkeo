// --------- BEGIN CMS ---------
const FORM_DATA = new FormData();
FORM_DATA.append('_token', document.querySelector('meta[name="csrf-token"]').content);

window.addEventListener('DOMContentLoaded', () => {
    fetch('/cms', {method: 'POST', body: FORM_DATA})
        .then(response => response.json())
        .then(data => {
            document.querySelectorAll('img[data-cms]').forEach(item => {
                if (data.hasOwnProperty(item.dataset.cms)) {
                    if (item.dataset.scroll) {
                        item.dataset.scroll = data[item.dataset.cms];
                    } else {
                        item.src = data[item.dataset.cms];
                        if (item.dataset.load) {
                            item.dataset.load = data[item.dataset.cms];
                        }
                    }
                    item.onload = function () {
                        item.style.visibility = 'visible';
                    };
                    item.onerror = function () {
                        item.style.visibility = 'visible';
                    };
                } else {
                    item.style.visibility = 'visible';
                }
            });
            document.querySelectorAll('[data-cms]:not(img)').forEach(item => {
                if (data.hasOwnProperty(item.dataset.cms)) {
                    if (data[item.dataset.cms]) {
                        item.innerText = data[item.dataset.cms];
                    } else {
                        item.innerHTML = '&nbsp;';
                    }
                    let href = item.getAttribute('href');
                    if (item.tagName.toLowerCase() === 'a' && !href.startsWith('http') && !href.startsWith('#') && !href.startsWith('/')) {
                        item.href = getHref(data[item.dataset.cms]);
                    }
                }
                item.style.visibility = 'visible';
            });
            document.querySelectorAll('[data-cms-clone]').forEach(item => {
                if (data.hasOwnProperty(item.dataset.cmsClone)) {
                    item.href = data[item.dataset.cmsClone];
                }
            });
            document.querySelectorAll('[data-cms-background]').forEach(item => {
                if (data.hasOwnProperty(item.dataset.cmsBackground)) {
                    item.style.backgroundImage = `url(${data[item.dataset.cmsBackground]})`;
                }
                item.style.visibility = 'visible';
            });
        });
});
// --------- END CMS ---------

// --------- BEGIN CUSTOMER REGISTER ---------
window.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.js-disabled-form').forEach(item => {
        item.addEventListener('submit', function (event) {
            event.preventDefault();
            event.currentTarget.submit();
            for (let i = 0; i < item.elements.length; i++) {
                item[i].disabled = true;
            }
        });
    });

    document.querySelectorAll('.js-form').forEach(item => {
        item.addEventListener('submit', function (event) {
            event.preventDefault();
            let registerForm = new FormData(item);
            registerForm.append('_token', document.querySelector('meta[name="csrf-token"]').content);
            for (let i = 0; i < item.elements.length; i++) {
                item[i].disabled = true;
            }
            setText(item, Language.sending);
            let action = item.getAttribute('action') ? item.getAttribute('action') : '/contact';
            let method = item.getAttribute('method') ? item.getAttribute('method') : 'post';
            fetch(action, {method: method, body: registerForm})
                .then(response => {
                    if (!response.ok) {
                        throw Error(response.statusText);
                    }
                    return response.text();
                })
                .then(data => {
                    setText(item, Language.sentSuccessfully);
                })
                .catch(error => {
                    setText(item, Language.sentFailed);
                });
        });
    });
});

function setText(item, data) {
    let $submit = item.querySelector('[type=submit]');
    if ($submit.tagName.toLowerCase() === 'input') {
        $submit.value = data;
    } else {
        $submit.innerText = data;
    }
}

// --------- END CUSTOMER REGISTER ---------

function getHref(content) {
    if (content) {
        content = content.trim();
        let emailPattern = /^.{1,30}@.+\..{1,25}$/;
        if (emailPattern.test(content)) {
            return 'mailto:' + content;
        }

        if (content.length < 25) {
            let phone = content.replace(/[^+0-9]/g, '');
            if (phone.length > 9) {
                return 'tel:' + phone;
            }
        }

        if (content.length < 30 && content.startsWith('http')) {
            return content;
        }
    }

    return 'javascript:void(0)';
}

// --------- BEGIN LAZY LOAD IMAGE ---------
window.onload = loadImage;

function loadImage() {
    document.querySelectorAll('img[data-load]').forEach(item => {
        item.src = item.dataset.load;
    });
}

let fired = false;
window.addEventListener("scroll", function () {
    if (fired === false && (document.documentElement.scrollTop != 0 || document.body.scrollTop != 0)) {
        document.querySelectorAll('img[data-scroll]').forEach(item => {
            item.src = item.dataset.scroll;
        });
        fired = true;
    }
}, true);
// --------- END LAZY LOAD IMAGE ---------
