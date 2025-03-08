<template>
  <div class="test-container d-flex justify-content-center align-items-center">
    <div class="test-card p-4 shadow-lg">
      <div class="header-container mb-4">
        <PageHeader title="TCF" pageTitle="HOME" pageRoute="/" />
      </div>

      <div class="d-flex justify-content-center align-items-center mb-4">
        <!-- TCF Logo -->
        <div class="logo-tcf mx-3">
          <img src="@/assets/images/tcflogo.png" alt="Logo TCF" height="40" class="logo-image" />
        </div>

        <!-- Etawjihi Image -->
        <div class="logo-etawjihi mx-3">
          <img src="@/assets/images/etawjihi.webp" alt="Etawjihi" height="40" class="logo-image mb-3" />
        </div>
      </div>

      <!-- Start Test Button -->
      <div v-if="!isTestStarted" class="test-card mt-4">
        <h2 class="h2 text-center">Bienvenue au Test</h2>
        <p class="test-description text-center">
          Vous êtes prêt à relever le défi ? Passez un test dans des conditions identiques à celles du TCF et évaluez vos performances. Vous pouvez refaire le test autant de fois que vous le souhaitez, c'est entièrement gratuit.
          <br><br>
          Pour vous aider à vous préparer de manière optimale au TCF, nous vous proposons un test de 20 minutes, conçu pour reproduire les conditions exactes d'une session officielle. Attention, bien que les résultats de ce test ne garantissent pas le même score lors du TCF officiel, il constitue une excellente préparation pour maximiser vos chances de réussite.
        </p>
        <button @click="startTest" class="btn btn-soft-primary large-button d-block mx-auto">
          Commencer le test
        </button>
      </div>

      <!-- Container for Timer and Question Number -->
      <div v-if="isTestStarted" class="d-flex justify-content-between align-items-center mb-4">
        <button type="button" class="btn btn-soft-primary">
          Question {{ currentQuestionIndex + 1 }} / {{ questions.length }}
        </button>
        <button type="button" class="btn btn-soft-primary">
          {{ formattedTime }}
        </button>
      </div>

      <!-- Show the current question -->
      <div v-if="isTestStarted && !isSubmitted && !reviewMode" class="question-box">
        <div v-if="questions.length > 0 && questions[currentQuestionIndex]">
          <p class="h2">{{ currentQuestion.question }}</p>
          <hr>

          <div v-if="questions[currentQuestionIndex].audio" class="audio-container">
            <h3 class="audio-title">Écoutez l'exemple audio</h3>
            <audio ref="audioPlayer" :src="questions[currentQuestionIndex].audio" controls autoplay class="audio-player" style="display: none;" @canplay="checkAudio()"></audio>

            <div class="audio-controls">
              <!-- Restart Audio -->
              <i @click="restartAudio" class="ri-restart-line"></i>

              <!-- Play/Pause Control -->
              <i v-if="!isPlaying" @click="togglePlayPause" class="ri-play-line"></i>
              <i v-if="isPlaying" @click="togglePlayPause" class="ri-pause-line"></i>

            </div>
          </div>


          <div v-for="(response, i) in questions[currentQuestionIndex].shuffledReponses"
               :key="i"
               class="h3"
               :class="{'selected': answers[questions[currentQuestionIndex].id] === response}"
               @click="answers[questions[currentQuestionIndex].id] = response">
            <label>
              <input type="radio"
                     :name="'response-' + questions[currentQuestionIndex].id"
                     :value="response"
                     v-model="answers[questions[currentQuestionIndex].id]"
                     hidden />
              <span class="h3">{{ response }}</span>
            </label>
          </div>

          <div class="d-flex justify-content-between align-items-center mb-4">
            <button @click="previousQuestion"
                    :disabled="currentQuestionIndex === 0"
                    class="btn btn-soft-primary large-button d-block mx-auto">
              Previous
            </button>
            <button @click="nextQuestion"
                    :disabled="!answers[questions[currentQuestionIndex].id]"
                    class="btn btn-soft-primary large-button d-block mx-auto">
              {{ currentQuestionIndex === questions.length - 1 ? 'Submit' : 'Next' }}
            </button>
          </div>
        </div>
      </div>

      <!-- Show results after submitting -->
      <div v-if="isSubmitted && !reviewMode" class="result-box text-center mt-4">
        <p>Votre niveau et score :</p>
        <p>Score: {{ result.score }}</p>
        <p>Niveau: {{ result.niveau }}</p>
        <!-- Button to show answers -->
        <button @click="showAnswers = !showAnswers" class="btn btn-soft-primary mt-3">
          Show Answers
        </button>

        <!-- Show answers as buttons (1 to 40) -->
        <div v-if="showAnswers" class="mt-4 answer-buttons-container">
          <div v-for="(question, index) in questions" :key="question.id" class="mb-2">
            <button
                @click="reviewQuestion(index)"
                :class="{'btn-success': isCorrectAnswer(question.id), 'btn-danger': !isCorrectAnswer(question.id)}"
                class="btn"
                style="width: 50px; margin-right: 5px;">
              {{ index + 1 }}
            </button>
          </div>
        </div>

      </div>

      <!-- Correction View (Review Mode) -->
      <div v-if="reviewMode && isSubmitted" class="question-box">
        <div v-if="questions.length > 0 && questions[currentQuestionIndex]">
          <p class="h2">{{ currentQuestion.question }}</p>
          <hr>

          <div v-if="questions[currentQuestionIndex].audio" class="audio-container">
            <h3 class="audio-title">Écoutez l'exemple audio</h3>
            <audio ref="audioPlayer" :src="questions[currentQuestionIndex].audio" controls autoplay class="audio-player" style="display: none;" @canplay="checkAudio()"></audio>

            <div class="audio-controls">
              <!-- Restart Audio -->
              <i @click="restartAudio" class="ri-restart-line"></i>

              <!-- Play/Pause Control -->
              <i v-if="!isPlaying" @click="togglePlayPause" class="ri-play-line"></i>
              <i v-if="isPlaying" @click="togglePlayPause" class="ri-pause-line"></i>

            </div>
          </div>


          <div v-for="(response, i) in questions[currentQuestionIndex].shuffledReponses"
               :key="i"
               class="h3"
               :class="{
                'correct-answer': questions[currentQuestionIndex].reponse_correcte === response,
                'wrong-answer': answers[questions[currentQuestionIndex].id] === response && questions[currentQuestionIndex].reponse_correcte !== response,
                'selected': answers[questions[currentQuestionIndex].id] === response && questions[currentQuestionIndex].reponse_correcte === response
              }"

          >
            <label>
              <input type="radio"
                     :name="'response-' + questions[currentQuestionIndex].id"
                     :value="response"
                     :checked="answers[questions[currentQuestionIndex].id] === response"
                     disabled
                     hidden />
              <span class="h3">{{ response }}</span>
            </label>
          </div>

          <div class="d-flex justify-content-between align-items-center mb-4">
            <button @click="previousQuestionReview"
                    :disabled="currentQuestionIndex === 0"
                    class="btn btn-soft-primary large-button d-block mx-auto">
              Previous
            </button>
            <button @click="nextQuestionReview"
                    :disabled="currentQuestionIndex === questions.length - 1"
                    class="btn btn-soft-primary large-button d-block mx-auto">
              Next
            </button>

            <button @click="exitReviewMode"
                    class="btn btn-soft-primary large-button d-block mx-auto">
              Exit Review
            </button>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>
<script>
import { ref, computed } from 'vue';
import PageHeader from "@/components/page-header";
import Swal from "sweetalert2";
import axios from 'axios';
import { watch } from 'vue';
import { nextTick } from 'vue';


export default {
  components: { PageHeader },

  setup() {
    // Reactive state variables
    const questions = ref([]);
    const answers = ref({});
    const result = ref(null);
    const currentQuestion = computed(() => questions.value[currentQuestionIndex.value] || {});
    const currentQuestionIndex = ref(0);
    const timer = ref(20 * 60); // 20 minutes in seconds
    let timerInterval;
    const isTestStarted = ref(false); // Track if the test has started
    const isSubmitted = ref(false);
    const responsesDetails = ref([]);// Track if the test is submitted
    const showAnswers = ref(false); // Control the visibility of answer buttons
    const reviewMode = ref(false); // Correction reviewMode
    // Access the audio player ref
    const audioPlayer = ref(null);
    const isPlaying = ref(true);

    watch(currentQuestionIndex, (newIndex) => {
      console.log("Current Question Index Updated:", newIndex);
    });

    // Fetch questions from the API
    const fetchQuestions = async () => {
      try {
        const response = await axios.get('https://127.0.0.1:8000/api/test/questions');
        questions.value = response.data; // Assuming the response is in JSON format

        // Shuffle the answers for each question once
        questions.value.forEach(question => {
          question.shuffledReponses = shuffleAnswers(question.reponses);
        });
      } catch (error) {
        console.error('Error fetching questions:', error);
      }
    };
    const successmsg=()=> {
      Swal.fire("bravo!", "Test soumis avec succès!", "success");
    }

    const checkAudio = () => {
      // Check if audio is loaded and can be played
      if (audioPlayer.value && audioPlayer.value.readyState >= 3) {
        // If audio is ready, show the play/stop buttons accordingly
        if (audioPlayer.value.paused) {
          isPlaying.value = false;
        } else {
          isPlaying.value = true;
        }
      } else {
        // If audio is not ready (not loaded or broken), show play
        isPlaying.value = false;
      }
    };

    const restartAudio = () => {
      if (audioPlayer.value) {
        audioPlayer.value.currentTime = 0; // Rewind to the beginning
        audioPlayer.value.play(); // Start the audio again
        isPlaying.value = true; // Set play status
      }
    };

    const stopAudio = () => {
      if (audioPlayer.value) {
        audioPlayer.value.pause(); // Pause the audio
        audioPlayer.value.currentTime = 0; // Reset the time to the beginning
        isPlaying.value = false; // Set pause status
      }
    };
    const togglePlayPause = () => {
      if (audioPlayer.value) {
        if (isPlaying.value) {
          audioPlayer.value.pause();
        } else {
          audioPlayer.value.play();
        }
        isPlaying.value = !isPlaying.value;
      }
    };




    // Shuffle the answers for random order
    const shuffleAnswers = (responses) => {
      return responses.sort(() => Math.random() - 0.5);
    };

    // Start the test and timer
    const startTest = () => {
      isTestStarted.value = true;
      fetchQuestions();
      startTimer();
    };

    // Move to the next question or submit the test
    const nextQuestion = async () => {
      if (currentQuestionIndex.value < questions.value.length - 1) {
        currentQuestionIndex.value++;
        await nextTick();
        console.log("New question:", questions.value[currentQuestionIndex.value]);
      } else {
        await submitTest(); // If last question, submit the test
      }
    }
    const previousQuestion = () => {
      if (currentQuestionIndex.value > 0) {
        currentQuestionIndex.value--;
      }
    };

    // Correction next question review
    const nextQuestionReview = () => {
      if (currentQuestionIndex.value < questions.value.length - 1) {
        currentQuestionIndex.value++;
      }
    };

    const previousQuestionReview = () => {
      if (currentQuestionIndex.value > 0) {
        currentQuestionIndex.value--;
      }
    };
    const isCorrectAnswer = (questionId) => {
      const question = questions.value.find(q => q.id === questionId);

      if (!question) {
        console.warn(`Question not found with ID: ${questionId}`);
        return false; // Or handle the error appropriately
      }

      return answers.value[questionId] === question.reponse_correcte;
    };

    // Submit answers
    const submitTest = async () => {
      clearInterval(timerInterval);
      const answersArray = Object.keys(answers.value).map(questionId => ({
        questionId: questionId,
        response: answers.value[questionId],
      }));

      console.log('Submitting answers:', answersArray);
      successmsg();

      try {
        const response = await axios.post('https://127.0.0.1:8000/api/test/submit', {
          answers: answersArray,
        });

        result.value = response.data; // Save the result from the response
        isSubmitted.value = true; // Mark the test as submitted
        console.log('Test submission response:', response.data);

        if (response.data.responsesDetails) {
          responsesDetails.value = response.data.responsesDetails;
        }
        console.log('Responses details:', responsesDetails.value);
      } catch (error) {
        console.error('Error submitting test:', error);
      }
    };


    const reviewQuestion = (index) => {
      currentQuestionIndex.value = index;
      reviewMode.value = true;
    };

    const exitReviewMode = () => {
      reviewMode.value = false;
      showAnswers.value = false;
      currentQuestionIndex.value = 0;
    };
// Start the timer
    const startTimer = () => {
      timerInterval = setInterval(() => {
        if (timer.value > 0) {
          timer.value--;
        } else {
          clearInterval(timerInterval);
          submitTest(); // Auto submit when time is over
        }
      }, 1000);
    };

    // Format the timer as minutes:seconds
    const formattedTime = computed(() => {
      const minutes = Math.floor(timer.value / 60);
      const seconds = timer.value % 60;
      return `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    });

    // Return reactive properties and methods to the template
    return {
      questions,
      answers,
      result,
      showAnswers,
      currentQuestionIndex,
      responsesDetails,
      reviewMode,
      reviewQuestion,
      timer,
      audioPlayer,
      fetchQuestions,
      startTest,
      nextQuestion,
      previousQuestion,
      submitTest,
      formattedTime,
      isTestStarted,
      isSubmitted,
      checkAudio,
      stopAudio,
      restartAudio,
      togglePlayPause,
      successmsg,
      currentQuestion,
      isPlaying,// Add isSubmitted to the return
      nextQuestionReview,
      previousQuestionReview,
      exitReviewMode,
      isCorrectAnswer
    };
  }
};
</script>

<style scoped>
.test-container {
  background-image: url('@/assets/images/greenbackground.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  height: 100vh;
  width: 100vw;
}

.test-card {
  background-color: white;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
  text-align: center;
  max-width: 800px;
  width: 100%;
  margin: 0 auto;

  /* Adjust padding for small screens */
  @media (max-width: 576px) {
    padding: 15px;
  }
}

.large-button {
  font-size: 1.4rem;
  padding: 12px 24px;
  border-radius: 8px;

  /* Adjust for smaller screens */
  @media (max-width: 576px) {
    font-size: 1.1rem;
    padding: 10px 20px;
  }
}

.test-header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
  padding: 10px;
  border-radius: 8px;
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);

  /* Remove background color */
  background: none;
}

.question-box {
  margin-top: 20px;
}

.medium-text {
  font-size: 1.5rem;
  font-weight: bold;
  margin-bottom: 10px;
}

.answer-option {
  margin: 10px 0;
  font-size: 0.2rem;
  cursor: pointer;
}

.selected {
  background-color: #DDD5f3;
  border-radius: 8px;
  padding: 10px;
}

.result-box {
  margin-top: 20px;
  font-size: 1.3rem;
}

.logo-image {
  margin-top: -10px; /* Adjust this value as needed */
  height: 50px; /* Keep the logo size consistent */
}

/* Responsive styles */
@media (max-width: 768px) {
  .test-card {
    padding: 20px;
  }

  .test-header {
    flex-direction: row;
    justify-content: space-between;
  }

  .logo-image {
    height: 35px;
  }

  .large-button {
    font-size: 1.2rem;
    padding: 10px 18px;
  }

  .test-description {
    font-size: 1rem;
  }

  .h2 {
    font-size: 1rem;
  }

  .h3 {
    font-size: 0.7rem;
  }
}

@media (max-width: 576px) {
  /* Existing styles */
  .test-card {
    padding: 10px;
  }

  .large-button {
    font-size: 1rem;
    padding: 10px 15px;
  }

  .logo-image {
    height: 30px;
  }

  .test-description {
    font-size: 0.9rem;
  }

  .h2 {
    font-size: 1.3rem;
  }

  .h3 {
    font-size: 0.9rem;
  }

  /* Adjust the question size */
  .question-box .h2 {
    font-size: 1.1rem; /* Reduce the font size here for mobile */
  }
}
.audio-container {
  margin-top: 30px;
  text-align: center;
}

.audio-title {
  font-size: 1.5rem;
  font-weight: 600;
  color: #333;
  margin-bottom: 15px;
}

.audio-player {
  width: 80%;
  max-width: 600px;
  border-radius: 10px;
  background-color: #f1f1f1;
  padding: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}


.audio-controls i {
  font-size: 36px;  /* Adjust this value to make the icons bigger or smaller */
  cursor: pointer;  /* Make it clear that the icons are clickable */
  margin: 0 10px;    /* Space between the icons */
  transition: transform 0.3s ease;
  color: mediumpurple/* Optional: Smooth scaling transition */
}

.audio-controls i:hover {
  transform: scale(1.2); /* Optional: Adds a hover effect to slightly increase the size */
}
.btn-success {
  border-color:lightgreen;
  font-size: 16px;
  background-color: white; /* Set background to white */
  color: black
}

.btn-danger {
  border-color: red;
  font-size: 16px;
  background-color: white; /* Set background to white */
  color: black
}
.answer-buttons-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.answer-buttons-container button {
  margin: 5px;
}
.correct-answer {
  border: 3px solid lightgreen !important; /* Green border for correct answer */
  background-color: transparent !important; /* No background color */
  color: black; /* Keep text color readable */
}

.wrong-answer {
  border: 3px solid #ff7f7f !important; /* Red border for incorrect answer */
  background-color: transparent !important; /* No background color */
  color: black; /* Keep text color readable */
}


</style>