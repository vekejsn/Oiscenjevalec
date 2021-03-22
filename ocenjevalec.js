/*jshint esversion: 6 */ 

let oddaja = "";
let vrednotenje = {};

function cE(tag, innerHTML, classList, parent) {
    let el = document.createElement(tag);
    if (innerHTML) el.innerHTML = innerHTML;
    if (classList) el.classList = classList;
    if (parent) parent.appendChild(el);
    return el;
}

function zacniOcenjevanje() {
    document.getElementById('vnos').style.display = 'none';
    oddaja = document.getElementById('oddaja').value;

    let xhttp = new XMLHttpRequest();
    xhttp.onload = (ev) => {
        vrednotenje = JSON.parse(ev.target.responseText).vrednotenja;
        izpisiStran();
    };

    xhttp.open('GET', 'naloge/' + document.getElementById('naloga').value + '.json');
    xhttp.send();
}

function napaka(besedilo) {
    let naloge = document.getElementById('naloge');
    naloge.innerHTML = '';
    let row = cE('div', '', 'row mt-5', naloge);
    let col = cE('div', '', 'col-md-6 offset-md-3 text-center', row);
    cE('h2', besedilo, 'text-danger', col);
    let btn = cE('button', 'Nazaj', 'btn btn-secondary', col);
    btn.onclick = () => {
        document.getElementById('vnos').style.display = '';
        naloge.innerHTML = '';
    };
}

function izpisiStran() {
    let naloge = document.getElementById('naloge');
    naloge.innerHTML = '';
    vrednotenje.forEach((el) => {
        let row = cE('div', '', 'row mt-3 mx-5', naloge);
        cE('hr', '', '', row);
        let tockeDiv = cE('div', '', 'col-md-6', row);
        let prikazDiv = cE('div', '', 'col-md-6', row);

        if (el.naslov)
            cE('h5', el.naslov, '', tockeDiv);
        
        let ol = cE('ol', '', 'form-group mt-1', tockeDiv);

        for (let i = 0; i < el.navodila.length; i++) {
            let li = cE('li', '', '', ol);
            let cbx = cE('input', '', '', li);
            cbx.type = 'checkbox';
            cbx.value = el.navodila[i].tocke;
            cE('span', el.navodila[i].tocke + ' tocka' , 'tocke mx-2', li);
            cE('span', el.navodila[i].besedilo , '', li);
        }

        if (el.opomba)
            cE('p', el.opomba, 'small', tockeDiv);
            
        switch(el.tip) {
            case 'prikazi': {
                let rexp = new RegExp(el.format, 's');
                let resitev = rexp.exec(oddaja);
                if (resitev && resitev.length == 2) {
                    resitev = resitev[1];
                    cE('pre', resitev, '', prikazDiv);
                }
                else {
                    cE('h5', 'Ne najdem resitve v oddaji', 'text-danger', prikazDiv);
                }
                break;
            }
            case 'commit': {
                let rexp = new RegExp(el.format, 's');
                let url = rexp.exec(oddaja);
                if (url && url.length == 2) {
                    url = url[1];
                    let ifr = cE('iframe', '', '', prikazDiv);
                    ifr.src = url;
                }
                else {
                    cE('h5', 'Ne najdem resitve v oddaji', 'text-danger', prikazDiv);
                }
                break;
            }
            default:{
                cE('h5', 'Neznan tip prikaza', 'text-danger', prikazDiv);
                break;
            }
        }
    });
}