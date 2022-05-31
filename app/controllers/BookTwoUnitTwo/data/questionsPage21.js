import { Question } from "../models/QuestionPage21.js";
import { data } from "./dataUnitTwoPage21.js";

export const questions = data.map(
  (question) =>
    new Question(question.question, question.choices, question.answer)
);
