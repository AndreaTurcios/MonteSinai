//@ts-check
<<<<<<< HEAD
import { Quiz } from "./models/QuizPage48.js";
import { UI } from "./models/UIPage48.js";
import { questions } from "./data/questionsPage48.js";
=======
import { Quiz } from "./models/QuizPage48.js";
import { UI } from "./models/UIPage48.js";
import { questions } from "./data/questionsPage48.js";
>>>>>>> 0a3ee4900ba05c6ac6982f0f765fbb00742442ca

// Renderring the page
const renderPage = (quiz, ui) => {
  if (quiz.isEnded()) {
    ui.showScores(quiz.score);
  } else {
    console.log(quiz);
    ui.showQuestion(quiz.getQuestionIndex().text);
    ui.showProgress(quiz.questionIndex + 1, quiz.questions.length);
    ui.showChoices(quiz.getQuestionIndex().choices, (currenChoice) => {
      quiz.guess(currenChoice);
      renderPage(quiz, ui);
    });
  }
};

function main() {
  const quiz = new Quiz(questions);
  const ui = new UI();

  renderPage(quiz, ui);
}

main();
