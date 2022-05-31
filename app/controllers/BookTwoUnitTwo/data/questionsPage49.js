import { Question } from "../models/QuestionPage49.js";
import { data } from "./dataUnitTwoPage49.js";

export const questions = data.map(
  (question) =>
    new Question(question.question, question.choices, question.answer)
);
