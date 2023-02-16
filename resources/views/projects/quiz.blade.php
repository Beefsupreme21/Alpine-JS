<x-layout>
    <div x-data="quizData()">
        <template x-if="!currentQuestion">
            <button x-on:click="startQuiz()">Start Quiz</button>
        </template>
        <template x-if="currentQuestion">
            <div>
                <h2 x-text="'Question ' + (currentQuestionIndex + 1) + ' of ' + questions.length"></h2>
                <p x-text="currentQuestion.question"></p>
                <ul>
                    <template x-for="answer in currentQuestion.answers">
                        <label>
                            <input type="radio" name="answer" x-model="selectedAnswer" x-bind:value="answer">
                            <span x-text="answer"></span>
                        </label>
                    </template>
                </ul>
                <button x-on:click="confirmAnswer()">Confirm Answer</button>
            </div>
        </template>
        <template x-if="showResults">
            <div>
                <h2 x-text="'Quiz Results'"></h2>
                <p>You got <span x-text="correctAnswers"></span> out of <span x-text="questions.length"></span> questions correct! (<span x-text="Math.round(correctAnswers / questions.length * 100)"></span>%)</p>
              </div>
        </template>
    </div>
      
    <script>
        function quizData() {
            return {
                questions: [
                    {
                        question: "What is the capital of France?",
                        answers: ["Paris", "Berlin", "Madrid", "Rome"],
                        correctAnswer: "Paris",
                    },
                    {
                        question: "What is the largest ocean in the world?",
                        answers: ["Atlantic", "Indian", "Arctic", "Pacific"],
                        correctAnswer: "Pacific",
                    },
                    {
                        question: "What is the currency of Japan?",
                        answers: ["Dollar", "Euro", "Yen", "Pound"],
                        correctAnswer: "Yen",
                    },
                ],
        
                currentQuestionIndex: 0,
                currentQuestion: null,
                selectedAnswer: null,
                correctAnswers: 0,
                showResults: false,

                nextQuestion() {
                    this.currentQuestionIndex++;

                    if (this.currentQuestionIndex >= this.questions.length) {
                        this.showResults = true;
                    } else {
                        this.currentQuestion = this.questions[this.currentQuestionIndex];
                        this.selectedAnswer = null;
                        console.log(this.correctAnswers);
                    }
                },
        
                confirmAnswer() {
                    if (this.selectedAnswer === null) {
                        alert("Please select an answer!");
                        return;
                    }
                    if (this.selectedAnswer === this.currentQuestion.correctAnswer) {
                        this.correctAnswers++;
                        console.log(this.correctAnswers);
                    }
                    this.nextQuestion();
                },
                
                startQuiz() {
                    this.currentQuestion = this.questions[0];
                },

                get percentageCorrect() {
                    return Math.round((this.correctAnswers / this.questions.length) * 100);
                },
            };
        }
    </script>
</x-layout>