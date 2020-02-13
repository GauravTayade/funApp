const CLASS_X = 'x';
const CLASS_CIRCLE = 'circle';

const elements = document.querySelectorAll('[data-cell]');
let turn;
const COMBINATION = [
    [0,1,2],
    [3,4,5],
    [6,7,8],
    [0,3,6],
    [1,4,7],
    [2,5,8],
    [0,4,8],
    [2,4,6],
]

startGane();

function startGane(){
    turn = false;
    elements.forEach(cell => {
        cell.addEventListener('click', handleClick, { once:true });
    });
}

function handleClick(e){
    const cell  = e.target;
    const currentClass = turn ? CLASS_CIRCLE : CLASS_X;
    placeMark(cell, currentClass);
    
    if(checkWin(currentClass)){
        console.log('winner');
    }
    
    swapTurn();
}

function placeMark(cell,currentClass){
    cell.classList.add(currentClass);
}

function swapTurn(){
    turn = !turn;
}

function checkWin(currentClass){
    return COMBINATION.some(combination => {
        return combination.every(index => {
            return elements[index].classList.contains(currentClass)
        })
    })
}