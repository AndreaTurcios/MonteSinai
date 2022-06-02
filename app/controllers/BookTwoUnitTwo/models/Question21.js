class Question {
    /**
     *
     * @param {string} text texto de la pregunta
     * @param {string[]} choices lista de opciones de la pregunta 
     * @param {string} answer respuesta correcta 
     */
    constructor(text, choices, answer) {
      this.text = text;
      this.choices = choices;
      this.answer = answer;
    }
  
    /**
     *
     * @param {string} choice opcion seleccionada
     * @returns {boolean} retorna si la pregunta es correcta 
     */
    correctAnswer(choice) {
      return choice === this.answer;
    }
  }
  
  export { Question };
  