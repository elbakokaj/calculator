class Calculator {
    constructor() {
        this.expression = '';
    }

    input(value) {
        this.expression += value;
        document.querySelector('.maininput').value = this.expression;
    }

    clear() {
        this.expression = '';
        document.querySelector('.maininput').value = '';
    }

    calculate() {
        fetch('calculator.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `expression=${encodeURIComponent(this.expression)}`
        })
            .then(response => response.text())
            .then(result => {
                document.querySelector('.maininput').value = result;
                this.expression = result;
            })
            .catch(error => console.error('Error:', error));
    }
}

const calc = new Calculator();

document.querySelectorAll('.numbtn, .calbtn').forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        calc.input(button.value);
    });
});

document.querySelector('.equal').addEventListener('click', (e) => {
    e.preventDefault();
    calc.calculate();
});

document.querySelector('.c').addEventListener('click', (e) => {
    e.preventDefault();
    calc.clear();
});

document.addEventListener('keydown', (e) => {
    e.preventDefault();

    let key = e.key;

    switch (key) {
        case '0':
        case 'Numpad0':
            key = '0';
            break;
        case '1':
        case 'Numpad1':
            key = '1';
            break;
        case '2':
        case 'Numpad2':
            key = '2';
            break;
        case '3':
        case 'Numpad3':
            key = '3';
            break;
        case '4':
        case 'Numpad4':
            key = '4';
            break;
        case '5':
        case 'Numpad5':
            key = '5';
            break;
        case '6':
        case 'Numpad6':
            key = '6';
            break;
        case '7':
        case 'Numpad7':
            key = '7';
            break;
        case '8':
        case 'Numpad8':
            key = '8';
            break;
        case '9':
        case 'Numpad9':
            key = '9';
            break;
        case 'NumpadAdd':
            key = '+';
            break;
        case 'NumpadSubtract':
            key = '-';
            break;
        case 'NumpadMultiply':
            key = '*';
            break;
        case 'NumpadDivide':
            key = '/';
            break;
        case 'NumpadEnter':
        case 'Enter':
            calc.calculate();
            return;
        case 'NumpadDecimal':
            key = '.';
            break;
    }

    if (key >= '0' && key <= '9') {
        calc.input(key);
    } else if (key === '+' || key === '-' || key === '*' || key === '/') {
        calc.input(key);
    } else if (key === 'Enter' || key === '=') {
        calc.calculate();
    } else if (key === 'c' || key === 'C' || key === 'Escape') {
        calc.clear();
    }
});