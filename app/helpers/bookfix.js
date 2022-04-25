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

const f1 = document.getElementById("f1");
const f2 = document.getElementById("f2");
const f3 = document.getElementById("f3");
const f4 = document.getElementById("f4");
const f5 = document.getElementById("f5");
const f6 = document.getElementById("f6");
const f7 = document.getElementById("f7");
const f8 = document.getElementById("f8");
const f9 = document.getElementById("f9");
const f10 = document.getElementById("f10");
const f11 = document.getElementById("f11");

const f12 = document.getElementById("f12");
const f13 = document.getElementById("f13");
const f14 = document.getElementById("f14");
const f15 = document.getElementById("f15");
const f16 = document.getElementById("f16");
const f17 = document.getElementById("f17");
const f18 = document.getElementById("f18");
const f19 = document.getElementById("f19");
const f20 = document.getElementById("f20");
const f21 = document.getElementById("f21");


const b1 = document.getElementById("b1");
const b2 = document.getElementById("b2");
const b3 = document.getElementById("b3");
const b4 = document.getElementById("b4");
const b5 = document.getElementById("b5");
const b6 = document.getElementById("b6");
const b7 = document.getElementById("b7");
const b8 = document.getElementById("b8");
const b9 = document.getElementById("b9");
const b10 = document.getElementById("b10");
const b11 = document.getElementById("b11");
const b12 = document.querySelector("#b12");
const b13 = document.getElementById("b13");
const b14 = document.getElementById("b14");
const b15 = document.getElementById("b15");
const b16 = document.getElementById("b16");
const b17 = document.getElementById("b17");
const b18 = document.getElementById("b18");
const b19 = document.getElementById("b19");
const b20 = document.getElementById("b20");
const b21 = document.getElementById("b21");

var front = document.querySelector('.front-content');
var back = document.querySelector('.front-content');

// // Event Listener
prevBtn.addEventListener("click", goPrevPage);
nextBtn.addEventListener("click", goNextPage);

back.addEventListener("click", goPrevPage);
front.addEventListener("click", goNextPage);


b1.addEventListener("click", goPrevPage);
f1.addEventListener("click", goNextPage);

b2.addEventListener("click", goPrevPage);
f2.addEventListener("click", goNextPage);

b3.addEventListener("click", goPrevPage);
f3.addEventListener("click", goNextPage);

b4.addEventListener("click", goPrevPage);
f4.addEventListener("click", goNextPage);

b5.addEventListener("click", goPrevPage);
f5.addEventListener("click", goNextPage);

b6.addEventListener("click", goPrevPage);
f6.addEventListener("click", goNextPage);

b7.addEventListener("click", goPrevPage);
f7.addEventListener("click", goNextPage);

b8.addEventListener("click", goPrevPage);
f8.addEventListener("click", goNextPage);

b9.addEventListener("click", goPrevPage);
f9.addEventListener("click", goNextPage);

b10.addEventListener("click", goPrevPage);
f10.addEventListener("click", goNextPage);

b11.addEventListener("click", goPrevPage);
f11.addEventListener("click", goNextPage);

b12.addEventListener("click", goPrevPage);
f12.addEventListener("click", goNextPage);

b13.addEventListener("click", goPrevPage);
f13.addEventListener("click", goNextPage);

b14.addEventListener("click", goPrevPage);
f14.addEventListener("click", goNextPage);

b15.addEventListener("click", goPrevPage);
f15.addEventListener("click", goNextPage);

b16.addEventListener("click", goPrevPage);
f16.addEventListener("click", goNextPage);

b17.addEventListener("click", goPrevPage);
f17.addEventListener("click", goNextPage);

b18.addEventListener("click", goPrevPage);
f18.addEventListener("click", goNextPage);

b19.addEventListener("click", goPrevPage);
f19.addEventListener("click", goNextPage);

b20.addEventListener("click", goPrevPage);
f20.addEventListener("click", goNextPage);

b21.addEventListener("click", goPrevPage);
f21.addEventListener("click", goNextPage);

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