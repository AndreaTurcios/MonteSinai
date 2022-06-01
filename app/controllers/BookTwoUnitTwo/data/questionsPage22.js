import { Question } from "../models/Question22.js";
import { data } from "./dataUnitTwoPage22.js";

export const questions = data.map(
  (question) =>
    new Question(question.question, question.choices, question.answer)
);
