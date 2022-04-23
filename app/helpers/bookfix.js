// References to DOM Elements
const prevBtn = document.querySelector("#prev-btn");
const nextBtn = document.querySelector("#next-btn");
const book = document.querySelector("#book");

const paper1 = document.querySelector("#p1");
const paper2 = document.querySelector("#p2");
const paper3 = document.querySelector("#p3");
const paper4 = document.querySelector("#p4");
const paper5 = document.querySelector("#p5");
const paper6 = document.querySelector("#p6");
const paper7 = document.querySelector("#p7");
const paper8 = document.querySelector("#p8");
const paper9 = document.querySelector("#p9");
const paper10 = document.querySelector("#p10");
const paper11 = document.querySelector("#p11");
const paper12 = document.querySelector("#p12");
const paper13 = document.querySelector("#p13");
const paper14 = document.querySelector("#p14");
const paper15 = document.querySelector("#p15");
const paper16 = document.querySelector("#p16");
const paper17 = document.querySelector("#p17");
const paper18 = document.querySelector("#p18");
const paper19 = document.querySelector("#p19");
const paper20 = document.querySelector("#p20");
const paper21 = document.querySelector("#p21");


// Event Listener
prevBtn.addEventListener("click", goPrevPage);
nextBtn.addEventListener("click", goNextPage);

// Business Logic
let currentLocation = 1;
let numOfPapers = 21;
let maxLocation = numOfPapers + 1;

function openBook() {
    book.style.transform = "translateX(50%)";
    prevBtn.style.transform = "translateX(-186px)";
    nextBtn.style.transform = "translateX(186px)";
}

function closeBook(isAtBeginning) {
    if (isAtBeginning) {
        book.style.transform = "translateX(0%)";
    } else {
        book.style.transform = "translateX(100%)";
    }

    prevBtn.style.transform = "translateX(0px)";
    nextBtn.style.transform = "translateX(0px)";
}

function goNextPage() {
    if (currentLocation < maxLocation) {
        switch (currentLocation) {
            case 1:
                openBook();
                paper1.classList.add("flipped");
                paper1.style.zIndex = 1;
                break;
            case 2:
                paper2.classList.add("flipped");
                paper2.style.zIndex = 2;
                break;
            case 3:
                paper3.classList.add("flipped");
                paper3.style.zIndex = 3;
                break;
            case 4:
                paper4.classList.add("flipped");
                paper4.style.zIndex = 4;
                break;
            case 5:
                paper5.classList.add("flipped");
                paper5.style.zIndex = 5;
                break;
            case 6:
                paper6.classList.add("flipped");
                paper6.style.zIndex = 6;
                break;
            case 7:
                paper7.classList.add("flipped");
                paper7.style.zIndex = 7;
                break;
            case 8:
                paper8.classList.add("flipped");
                paper8.style.zIndex = 8;
                break;
            case 9:
                paper9.classList.add("flipped");
                paper9.style.zIndex = 9;
                break;
            case 10:
                paper10.classList.add("flipped");
                paper10.style.zIndex = 10;
                break;
            case 11:
                paper11.classList.add("flipped");
                paper11.style.zIndex = 11;
                break;
            case 12:
                paper12.classList.add("flipped");
                paper12.style.zIndex = 12;
                break;
            case 13:
                paper13.classList.add("flipped");
                paper13.style.zIndex = 13;
                break;
            case 14:
                paper14.classList.add("flipped");
                paper14.style.zIndex = 14;
                break;
            case 15:
                paper15.classList.add("flipped");
                paper15.style.zIndex = 15;
                break;
            case 16:
                paper16.classList.add("flipped");
                paper16.style.zIndex = 16;
                break;
            case 17:
                paper17.classList.add("flipped");
                paper17.style.zIndex = 17;
                break;
            case 18:
                paper18.classList.add("flipped");
                paper18.style.zIndex = 18;
                break;
            case 19:
                paper19.classList.add("flipped");
                paper19.style.zIndex = 19;
                break;
            case 20:
                paper20.classList.add("flipped");
                paper20.style.zIndex = 20;
                break;
            case 21:
                paper21.classList.add("flipped");
                paper21.style.zIndex = 21;
                closeBook(false);
                break;           
            default:
                throw new Error("unkown state");
        }
        currentLocation++;
    }
}

function goPrevPage() {
    if (currentLocation > 1) {
        switch (currentLocation) {
            case 2:
                closeBook(true);
                paper1.classList.remove("flipped");
                paper1.style.zIndex = 21;
                break;
            case 3:
                paper2.classList.remove("flipped");
                paper2.style.zIndex = 20;
                break;
            case 4:
                paper3.classList.remove("flipped");
                paper3.style.zIndex = 19;
                break;
            case 5:
                paper4.classList.remove("flipped");
                paper4.style.zIndex = 18;
                break;
            case 6:
                paper5.classList.remove("flipped");
                paper5.style.zIndex = 17;
                break;
            case 7:
                paper6.classList.remove("flipped");
                paper6.style.zIndex = 16;
                break;
            case 8:
                paper7.classList.remove("flipped");
                paper7.style.zIndex = 15;
                break;
            case 9:
                paper8.classList.remove("flipped");
                paper8.style.zIndex = 14;
                break;
            case 10:
                paper9.classList.remove("flipped");
                paper9.style.zIndex = 13;
                break;
            case 11:
                paper10.classList.remove("flipped");
                paper10.style.zIndex = 12;
                break;
            case 12:
                paper11.classList.remove("flipped");
                paper11.style.zIndex = 11;
                break;
            case 13:
                paper12.classList.remove("flipped");
                paper12.style.zIndex = 10;
                break;
            case 14:
                paper13.classList.remove("flipped");
                paper13.style.zIndex = 9;
                break;
            case 15:
                paper14.classList.remove("flipped");
                paper14.style.zIndex = 8;
                break;
            case 16:
                paper15.classList.remove("flipped");
                paper15.style.zIndex = 7;
                break;
            case 17:
                paper16.classList.remove("flipped");
                paper16.style.zIndex = 6;
                break;
            case 18:
                paper17.classList.remove("flipped");
                paper17.style.zIndex = 5;
                break;
            case 19:
                paper18.classList.remove("flipped");
                paper18.style.zIndex = 4;
                break;
            case 20:
                paper19.classList.remove("flipped");
                paper19.style.zIndex = 3;
                break;
            case 21:
                paper20.classList.remove("flipped");
                paper20.style.zIndex = 2;
                break;
            case 22:
                openBook();
                paper21.classList.remove("flipped");
                paper21.style.zIndex = 1;
                break;           
            default:
                throw new Error("unkown state");
        }

        currentLocation--;
    }
}