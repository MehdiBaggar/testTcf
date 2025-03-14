<template>
  <div
      class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100"
  >
    <div class="bg-overlay"></div>
    <div class="auth-page-content overflow-hidden pt-lg-5">
      <b-container>
        <b-row>
          <b-col lg="12">
            <b-card no-body class="overflow-hidden">
              <b-row class="g-0">
                <b-col lg="12">
                  <div class="p-lg-5 p-4">
                    <form
                        v-on:submit.prevent="submitForm()"
                        class="form-steps"
                        autocomplete="off"
                    >
                      <div class="text-center pt-3 pb-4 mb-1">
                        <b-link href="/"
                        ><img
                            src="@/assets/images/etawjihi.webp"
                            alt=""
                            height="45"
                        /></b-link>
                      </div>
                      <div class="step-arrow-nav mb-4">
                        <ul class="nav nav-pills custom-nav nav-justified" role="tablist">
                          <li class="nav-item" role="presentation">
                            <b-button
                                variant="link"
                                class="nav-link active"
                                id="form-tab"
                                type="button"

                            >Edit Question</b-button
                            >
                          </li>
                        </ul>
                      </div>
                      <div>
                        <label for="question">Question :</label>
                        <textarea v-model="formData.question" id="question" required></textarea>
                      </div>

                      <div>
                        <label for="type">Type :</label>
                        <div>
                          <input type="radio" id="comprehension_orale" value="Compréhension orale" v-model="formData.type" /> Compréhension orale
                          <input type="radio" id="maitrise_structures" value="Maîtrise des structures de la langue" v-model="formData.type" /> Maîtrise des structures de la langue
                          <input type="radio" id="comprehension_langue_ecrite" value="Compréhension de la langue écrite" v-model="formData.type" /> Compréhension de la langue écrite
                        </div>
                      </div>

                      <div>
                        <label for="difficulteeeee">Difficulté :</label>
                        <div>
                          <input type="radio" id="A1" value="A1" v-model="formData.difficulteeeee" /> A1
                          <input type="radio" id="A2" value="A2" v-model="formData.difficulteeeee" /> A2
                          <input type="radio" id="B1" value="B1" v-model="formData.difficulteeeee" /> B1
                          <input type="radio" id="B2" value="B2" v-model="formData.difficulteeeee" /> B2
                          <input type="radio" id="C1" value="C1" v-model="formData.difficulteeeee" /> C1
                          <input type="radio" id="C2" value="C2" v-model="formData.difficulteeeee" /> C2
                        </div>
                      </div>

                      <div v-if="formData.type === 'Compréhension orale'">
                        <label for="audio">Audio (fichier) :</label>
                        <input type="file" @change="handleFileUpload" id="audio" />
                        <audio v-if="audioURL" :src="audioURL" controls></audio>

                      </div>

                      <div>
                        <label for="reponseCorrecte">Réponse correcte :</label>
                        <input v-model="formData.reponseCorrecte" type="text" id="reponseCorrecte" />
                      </div>

                      <div>
                        <label for="reponses">Réponses (séparées par des virgules) :</label>
                        <input v-model="formData.reponses" type="text" id="reponses" />
                      </div>

                      <button type="submit">Modifier</button>

                    </form>
                  </div>
                </b-col>
              </b-row>
            </b-card>
          </b-col>
        </b-row>
      </b-container>
    </div>

  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      formData: {
        question: '',
        type: '',
        difficulteeeee: '',
        reponseCorrecte: '',
        reponses: '',
        audio: null, // To store the new file
      },
      audioURL: null, // To store the existing audio URL
    };
  },
  mounted() {
    this.fetchQuestionDetails();
  },
  methods: {
    async fetchQuestionDetails() {
      try {
        const response = await axios.get(`https://127.0.0.1:8000/questions/${this.id}`);
        const questionData = response.data;

        this.formData = {
          question: questionData.question,
          type: questionData.type,
          difficulteeeee: questionData.difficulteeeee,
          reponseCorrecte: questionData.reponseCorrecte,
          reponses: questionData.reponses ? questionData.reponses.join(',') : '', // Convert array to comma-separated string
          audio: null, // Reset audio
        };

        this.audioURL = questionData.audio; // Set the initial audio URL

      } catch (error) {
        console.error('Error fetching question details:', error);
        alert('Failed to load question details.');
      }
    },
    handleFileUpload(event) {
      this.formData.audio = event.target.files[0]; // Save the new file in form data
      this.audioURL = URL.createObjectURL(event.target.files[0]); // Create a preview URL
    },
    async submitForm() {
      try {
        const formDataToSend = new FormData();
        formDataToSend.append('question', this.formData.question);
        formDataToSend.append('type', this.formData.type);
        formDataToSend.append('difficulteeeee', this.formData.difficulteeeee);
        formDataToSend.append('reponseCorrecte', this.formData.reponseCorrecte);
        formDataToSend.append('reponses', JSON.stringify(this.formData.reponses.split(','))); // Split and stringify

        // Append the audio file only if a new file is selected
        if (this.formData.audio) {
          formDataToSend.append('audio', this.formData.audio);
        }
        console.log('formDataToSend', formDataToSend);

        const response = await axios.post(`https://127.0.0.1:8000/edit/questions/${this.id}`, formDataToSend, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });

        if (response.status === 200) {
          alert('Question modifiée avec succès');
          this.$router.push({ name: 'TCF' }); // Navigate back to the index page
        }
      } catch (error) {
        console.error('Error updating the question:', error);
        alert('Failed to update the question.');
      }
    },
  },
};
</script>

<style scoped>
.auth-page-wrapper {
  background-image: url('@/assets/images/greenbackground.jpg'); /* Adjust the path as needed */
  background-size: cover;
  background-position: center;
}
</style>