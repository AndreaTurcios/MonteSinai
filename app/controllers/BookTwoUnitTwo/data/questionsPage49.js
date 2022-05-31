import { Question } from "../models/QuestionPage49";
import { data } from "./dataUnitTwoPage49";

export const questions = data.map(
  (question) =>
    new Question(question.question, question.choices, question.answer)
);
