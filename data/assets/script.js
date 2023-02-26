let main, frame, pageInfo;
const listeners = [];

(function () {
    console.info('Initial DockerBlank project v0.1');

    document.addEventListener('DOMContentLoaded', (e) => {
        console.info('Page loading completed.');

        main    = document.getElementById('main');
        frame   = document.getElementById('frame');

        getPageInfo(window.location.pathname)
            .then(() => {
                mainProcess();
                ssrProcessor()
                    .then(() => {
                        mainProcess();
                    });
            });

        function mainProcess() {
            console.log(pageInfo);
        }
    });
})();

function getPageInfo(uri) {
    return new Promise((resolve, reject) => {
        fetch(uri + '?ssr')
            .then( async (response) => {
                pageInfo = await response.json();
                resolve();
            })
            .catch((e) => {
                console.error(`Ошибка заргузки страницы ${uri}. \r\n ${e}`);
            });
    });
}

function ssrProcessor() {
    const ssrHrefs = document.querySelectorAll('a[data-ssr]');
    return new Promise((resolve, reject) => {
        ssrHrefs.forEach((a) => {
            if (a.getAttribute('listener')) {
                a.removeEventListener('click', () => {}, false);
                a.setAttribute('listener', false);
            }
            a.setAttribute('listener', true);
            a.addEventListener('click', (e) => {
                e.preventDefault();
                ssrProcessor();
                getPageInfo(e.target.getAttribute('href') + '?ssr')
                    .then(() => {
                        document.title = pageInfo.data?.title ?? pageInfo.dataCommon?.siteName;
                        window.history.pushState({}, '', `/${pageInfo.uriPath}`);
                        // main.innerHTML = `<div id="frame">${pageInfo.html}</div>`;
                        // ssrProcessor();
                    });
            });
        });
    });
}

// function getSsrPageInfo() {
//     const hrefs = document.querySelectorAll('a[data-ssr]');
//     return new Promise((resolve, reject) => {
//         hrefs.forEach((a) => {
//             a.addEventListener('click', (e) => {
//                 e.preventDefault();
//                 fetch(a.getAttribute('href') + '?ssr')
//                     .then(async (response) => {
//                         pageInfo = await response.json();
//                         resolve();
//                     })
//                     .catch((e) => {
//                         console.error('При загрузке страницы произошла ошибка.\r\n', e);
//                     });
//             });
//         });
//     });
// }
//
// function setSsrPage() {
//     document.title = pageInfo.data?.title ?? pageInfo.dataCommon?.siteName;
//     window.history.pushState({}, '', `/${pageInfo.uriPath}`);
//     main.innerHTML = `<div id="frame">${pageInfo.html}</div>`;
// }

function asyncLoadPage(uri, cb) {
    const frameContainer = document.querySelector('.frame-container');
    fetch(`${uri}?ssr`)
        .then(async (response) => {
            window.history.pushState({}, '', uri);
            frameContainer.innerHTML = await response.text();
        });
}
