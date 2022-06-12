'use strict';

/*************************
 *       Variables       *
 *************************/

let errorShown = false;
let across = true;
let clueText;
let start = false;
let totalSeconds = JSON.parse(localStorage.getItem('timer')) || 0;
let crossword = JSON.parse(localStorage.getItem('crossword')) || {};
let timer;
let errors = JSON.parse(localStorage.getItem('errors')) || 0;
let score = JSON.parse(localStorage.getItem('score')) || 0;
let cluesData;

const minutes = document.querySelector('.minutes');
const seconds = document.querySelector('.seconds');
const table = document.querySelector('.table');
const cells = document.querySelectorAll('.letter');
const clueBox = document.querySelector('.clue-box');
const checkBtn = document.querySelector('.btn-check');
const solveBtn = document.querySelector('.btn-solve');
const clearBtn = document.querySelector('.btn-clear');
const closeBtn = document.querySelector('.dialog-close-btn');
const dialog = document.querySelector('.dialog');
const form = document.querySelector('.form');
const scoreLevel = document.querySelector('.score');
const scoreText = document.querySelector('.score-text');

/*************************
 *       Listeners       *
 *************************/

table.addEventListener('mousedown', handleClick);
table.addEventListener('touchstart', handleClick, { passive: true });
table.addEventListener('input', handleWriting);
table.addEventListener('keydown', handleKeyDown);
checkBtn.addEventListener('click', showErrors);
clearBtn.addEventListener('click', clearGame);
cells.forEach((cell) => cell.addEventListener('focus', handleFocus));

/*************************
 *         Start        *
 *************************/

startGame();

function startGame() {
    fetchClues();
    if (Object.keys(crossword).length > 0) {
        //check and paint localStorage data in DOM
        const keysArr = Object.keys(crossword);
        keysArr.forEach((key) => {
            let cell = document.getElementById(key);
            cell.value = crossword[key];
        });
    }
    if (totalSeconds > 0) {
        setTime();
    }
}

/*************************
 *        Buttons        *
 *************************/

function showErrors() {
    if (errorShown) {
        document.documentElement.style.setProperty(
            `--colorerror`,
            `var(--blue)`
        );
        errorShown = false;
        checkBtn.innerHTML = `mostrar errores`;
    } else {
        document.documentElement.style.setProperty(`--colorerror`, `red`);
        errorShown = true;
        checkBtn.innerHTML = `ocultar errores`;
        scoreDown();
    }
}

function clearGame() {
    window.localStorage.clear();
    removeHighligh();
    totalSeconds = -1;
    clearInterval(timer);
    start = false;
    setTime();
}

/*************************
 *     LocalStorage      *
 *************************/

function saveCrossword(e) {
    const id = e.target.id;
    const letter = e.target.value;
    //save crossword object: id as key, letter as value
    crossword[id] = letter;
    localStorage.setItem('crossword', JSON.stringify(crossword));
    //save crossword timer, score and errors
    localStorage.setItem('timer', JSON.stringify(totalSeconds));
    localStorage.setItem('score', JSON.stringify(score));
    localStorage.setItem('errors', JSON.stringify(errors));
}

/*************************
 *     Flow-writing     *
 *************************/

function handleWriting(e) {
    saveCrossword(e);
    checkInput(e);
    if (checkForm()) {
        return;
    }
    if (!start) {
        startTimer();
    }
    // don't move back after deleting a letter
    if (!e.target.value) {
        return;
    }

    let td = e.target.parentElement;
    getNextInput(td).focus();
}

function getNextInput(currentCell) {
    let currentInput = currentCell.querySelector('input');
    const initialId = currentInput.id;
    if (across) {
        do {
            if (currentCell.nextElementSibling) {
                currentCell = currentCell.nextElementSibling;
            } else {
                // change row
                let tr = currentCell.parentElement;
                if (tr.nextElementSibling) {
                    tr = tr.nextElementSibling;
                } else {
                    // go to first row again
                    tr = tr.parentElement.children[0];
                }
                currentCell = tr.children[0];
            }
            currentInput = currentCell.querySelector('input');
        } while (
            currentCell.classList.contains('cell-black') ||
            (currentInput.id !== initialId &&
                (currentInput.value || !currentInput.dataset.across))
        );
        return currentInput;
    } else {
        let index = currentCell.cellIndex;
        let tr = currentCell.parentElement;
        do {
            if (tr.nextElementSibling) {
                tr = tr.nextElementSibling;
            } else {
                // change column
                tr = tr.parentElement.children[0];
                index = (index + 1) % tr.children.length;
            }
            currentCell = tr.children[index];
            currentInput = currentCell.querySelector('input');
        } while (
            currentCell.classList.contains('cell-black') ||
            (currentInput.id !== initialId &&
                (currentInput.value || !currentInput.dataset.down))
        );
        return currentInput;
    }
}

/*************************
 *  keyboard behavior   *
 *************************/

function handleKeyDown(e) {
    const td = e.target.parentElement;

    if (e.key === 'Backspace' && !e.target.value) {
        const ref = getReferences(td);
        const cells = across ? ref.x || ref.y : ref.y || ref.x;
        const index = cells.indexOf(td);

        if (index > 0) {
            cells[index - 1].querySelector('input').focus();
            e.preventDefault();
        }
        return;
    }

    if (e.key === 'Enter') {
        return handleClick(e);
    }

    if (e.key === 'ArrowRight') {
        let cell = td;

        while (cell.nextElementSibling) {
            cell = cell.nextElementSibling;
            if (!cell.classList.contains('cell-black')) {
                cell.querySelector('input').focus();
                return;
            }
        }
        return;
    }

    if (e.key === 'ArrowLeft') {
        let cell = td;

        while (cell.previousElementSibling) {
            cell = cell.previousElementSibling;
            if (!cell.classList.contains('cell-black')) {
                cell.querySelector('input').focus();
                return;
            }
        }
        return;
    }

    if (e.key === 'ArrowUp') {
        const index = td.cellIndex;
        let cell = td;
        let tr = td.parentElement;

        while (tr.previousElementSibling) {
            tr = tr.previousElementSibling;
            cell = tr.children[index];

            if (!cell.classList.contains('cell-black')) {
                cell.querySelector('input').focus();
                return;
            }
        }
        return;
    }

    if (e.key === 'ArrowDown') {
        const index = td.cellIndex;
        let cell = td;
        let tr = td.parentElement;

        while (tr.nextElementSibling) {
            tr = tr.nextElementSibling;
            cell = tr.children[index];

            if (!cell.classList.contains('cell-black')) {
                cell.querySelector('input').focus();
                return;
            }
        }
    }
}

/*************************
 *  Fetch & paint clues  *
 *************************/

function fetchClues() {
    fetch('../../app/controllers/BookTwoUnitOne/clues.json')
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            cluesData = data;
        });
}

function paintClue(num) {
    if (num) {
        clueBox.innerHTML = `${num}. ${
            cluesData[across ? 'across' : 'down'][num]
        }`;
    } else {
        clueBox.innerHTML = '';
    }
}

/************************************
 *  Cell direction & highlighting   *
 ************************************/

function handleClick(e) {
    if (e.type === 'touchstart') {
        e.stopPropagation();
    }
    if (document.activeElement === e.target) {
        across = !across;
        handleFocus(e);
    }
}

function handleFocus(e) {
    const td = e.target.closest('td');

    if (!td) {
        return;
    }

    removeHighligh();
    const ref = getReferences(td);
    let cells = across ? ref.x : ref.y;
    if (!cells) {
        cells = ref.x || ref.y;
        across = !across;
    }

    cells.forEach((cell) => {
        cell.classList.add('highlight');
    });

    paintClue(across ? e.target.dataset.across : e.target.dataset.down);
}

function removeHighligh() {
    const highlightCell = document.querySelectorAll('.highlight');
    highlightCell.forEach((cell) => cell.classList.remove('highlight'));
}

/********************
 *  Get references   *
 **********************/

function getReferences(td) {
    const x = getXCells(td);
    const y = getYCells(td);

    return { x, y };
}

function getXCells(td) {
    const cells = [td];
    let curr = td;

    //Get previous
    while (
        curr.previousElementSibling &&
        !curr.previousElementSibling.classList.contains('cell-black')
    ) {
        curr = curr.previousElementSibling;
        cells.unshift(curr);
    }

    //Check if there's a clue
    if (!cells[0].querySelector('label')) {
        return null;
    }

    //Get next
    curr = td;
    while (
        curr.nextElementSibling &&
        !curr.nextElementSibling.classList.contains('cell-black')
    ) {
        curr = curr.nextElementSibling;
        cells.push(curr);
    }

    return cells;
}

function getYCells(td) {
    const cells = [td];
    const index = td.cellIndex;
    let tr = td.parentElement;

    //Get previous
    while (
        tr.previousElementSibling &&
        !tr.previousElementSibling.children[index].classList.contains(
            'cell-black'
        )
    ) {
        tr = tr.previousElementSibling;
        cells.unshift(tr.children[index]);
    }

    //Check if there's a clue
    if (!cells[0].querySelector('label')) {
        return null;
    }

    //Get next
    tr = td.parentElement;
    while (
        tr.nextElementSibling &&
        !tr.nextElementSibling.children[index].classList.contains('cell-black')
    ) {
        tr = tr.nextElementSibling;
        cells.push(tr.children[index]);
    }

    return cells;
}

/*************************
 *         Timer         *
 *************************/

function startTimer() {
    start = true;
    timer = setInterval(setTime, 1000);
}

function setTime() {
    ++totalSeconds;
    seconds.innerHTML = pad(totalSeconds % 60);
    minutes.innerHTML = pad(parseInt(totalSeconds / 60));
}

function pad(val) {
    var valString = val + '';
    if (valString.length < 2) {
        return '0' + valString;
    } else {
        return valString;
    }
}

/*************************
 *         Score         *
 *************************/

function checkInput(e) {
    if (e.target.validity.valid) {
        scoreUp();
    } else {
        if (e.target.value) {
            countError();
        }
        if (errorShown) scoreDown();
    }
}

function scoreDown() {
    score -= errors * 5;
    errors = 0;
}

function checkForm() {
    if (form.checkValidity()) {
        setTwitterSharing();
        clearInterval(timer);
        writeScore();
        dialog.showModal();
    }
    return form.checkValidity();
}

function scoreUp() {
    score += 10;
}

function countError() {
    errors += 1;
}

