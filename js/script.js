async function getTable() {
    let url = 'ajax/getTable.php?table=' + document.querySelector('.select').value;
    console.log(url);
    let response = await fetch(url);

    if (response.ok) { // если HTTP-статус в диапазоне 200-299
        // получаем тело ответа (см. про этот метод ниже)
        let textResponse = await response.text();
        let htmlObject = document.createElement('div');
        htmlObject.innerHTML = textResponse;
        document.querySelector('.table-section').replaceWith(htmlObject.querySelector('.table-section'));
        document.querySelector('.form-section').replaceWith(htmlObject.querySelector('.form-section'));
        buttonsInit();
    } else {
        alert("Ошибка HTTP: " + await response.text());
    }
}

async function insertIntoTable(formData) {

    let response = await fetch('ajax/insertIntoTable.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(Object.assign({}, formData))
    });

    if (response.ok) { // если HTTP-статус в диапазоне 200-299
        let textResponse = await response.text();
        let htmlObject = document.createElement('div');
        htmlObject.innerHTML = textResponse;
        document.querySelector('.table-section').replaceWith(htmlObject.querySelector('.table-section'));
        document.querySelector('.form-section').replaceWith(htmlObject.querySelector('.form-section'));
        buttonsInit();
    } else {
        alert("Ошибка HTTP: " + await response.text());
    }
}

async function sendSQL(sqlString) {

    let body = {
        query: sqlString
    };

    let response = await fetch('ajax/customQuery.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(body)
    });

    if (response.ok) {
        let textResponse = await response.text();
        let htmlObject = document.createElement('div');
        htmlObject.innerHTML = textResponse;
        document.querySelector('.table-section').replaceWith(htmlObject.querySelector('.table-section'));
        document.querySelector('.form-section').replaceWith(htmlObject.querySelector('.form-section'));
        buttonsInit();
    } else {
        alert("Ошибка HTTP: " + await response.text());
    }
}

function buttonsInit() {

    document.querySelector('.select-btn').addEventListener('click', () => {
        getTable();
    });

    document.querySelector('.insert-submit').addEventListener('click', () => {
        let inputs = document.querySelectorAll('input');
        let formData = [];
        formData['table'] = document.querySelector('.select').value;
        inputs.forEach((input) => {
            formData[input.name] = input.value;
        });
        insertIntoTable(formData);
    });

    document.querySelector('.sql-submit').addEventListener('click', (e) => {
        let sqlString = document.querySelector('#sql').value;
        sendSQL(sqlString);
    });

}

buttonsInit();

