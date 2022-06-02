import { Question } from "../models/Question20.js";
import { data } from "./dataUnitTwoPage20.js";

export const questions = data.map(
  (question) =>
    new Question(question.question, question.choices, question.answer)
);
