//@ts-check
import { Quiz } from "./models/Quiz21.js";
import { UI } from "./models/UI21.js";
import { questions } from "./data/questionsPage21.js";

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