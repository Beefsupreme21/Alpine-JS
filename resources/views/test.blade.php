<x-layout>
    <div x-data="quizData()">
        <template x-if="!currentQuestion">
            <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded" x-on:click="startQuiz()">Start Quiz</button>
        </template>
        <template x-if="currentQuestion && !showResults">
            <div>
                <h2 class="text-lg font-medium mb-2" x-text="'Question ' + (currentQuestionIndex + 1) + ' of ' + questions.length"></h2>
                <p class="mb-4" x-text="currentQuestion.text"></p>
                <div class="grid grid-cols-2 gap-4">
                    <template x-for="(answer, index) in currentQuestion.answers">
                        <div class="my-2 rounded-lg border border-gray-400 px-4 py-2 text-center cursor-pointer" x-on:click="selectedAnswer = index" :class="{ 'bg-blue-500 text-white': selectedAnswer === index, 'bg-gray-200': selectedAnswer !== index }">
                            <span x-text="answer.text"></span>
                        </div>
                    </template>
                </div>
                <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded mt-4" x-on:click="confirmAnswer()">Confirm Answer</button>
            </div>
        </template>      
        <template x-if="showResults">
            <div>
                <h2 class="text-lg font-medium mb-2" x-text="'Quiz Results'"></h2>
                <p class="mb-4">You got <span class="font-medium" x-text="correctAnswers"></span> out of <span class="font-medium" x-text="questions.length"></span> questions correct! (<span x-text="Math.round(correctAnswers / questions.length * 100)"></span>%)</p>
                <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded" x-on:click="restartQuiz()">Retry Quiz</button>
            </div>
        </template>
    </div>
      
    <script>
        function quizData() {
            return {
                questions: @json($questions),
                currentQuestionIndex: 0,
                currentQuestion: null,
                selectedAnswer: null,
                correctAnswers: 0,
                showResults: false,

                getAnswers(question) {
                    return question.answers;
                },
    
                nextQuestion() {
                    if (this.currentQuestionIndex < this.questions.length - 1) {
                        this.currentQuestionIndex++;
                        this.currentQuestion = this.questions[this.currentQuestionIndex];
                        this.currentQuestion.answers = this.getAnswers(this.currentQuestion);
                        this.selectedAnswer = null;
                    } else {
                        this.showResults = true;
                    }
                },
        
                confirmAnswer() {
                    if (this.selectedAnswer === null) {
                        alert("Please select an answer!");
                        return;
                    }
                    if (this.currentQuestion.answers[this.selectedAnswer].is_correct) {
                        this.correctAnswers++;
                    }
                    this.nextQuestion();
                },
                
                startQuiz() {
                    this.currentQuestion = this.questions[0];
                },

                restartQuiz() {
                    this.currentQuestionIndex = 0;
                    this.currentQuestion = null;
                    this.selectedAnswer = null;
                    this.correctAnswers = 0;
                    this.showResults = false;
                },
    
                get percentageCorrect() {
                    return Math.round((this.correctAnswers / this.questions.length) * 100);
                },
            };
        }
    </script>
</x-layout>