import { Question } from "../models/Question21.js";
import { data } from "./dataUnitTwoPage21.js";

export const questions = data.map(
  (question) =>
    new Question(question.question, question.choices, question.answer)
);
