let dumps = document.querySelectorAll('pre.sf-dump');

if (dumps.length) {
    document.body.style.flexWrap = "wrap";

    let dumpDiv = document.createElement('div');

    document.body.appendChild(dumpDiv);

    dumpDiv.style.width = "100%";

    dumps.forEach(el => {
        dumpDiv.appendChild(el);
    })
}