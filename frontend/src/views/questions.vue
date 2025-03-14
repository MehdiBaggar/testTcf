<template>
  <Layout>
    <h1>Gestion des formulaires :</h1>
    <router-link to="/addQuestion" class="nav-link custom-abc" data-key="t-forms">
      <button type="button" class="btn btn-primary">Add Question</button>
    </router-link>

    <div class="table-responsive table-card mt-4">
      <table class="table align-middle table-nowrap mb-0" id="tasksTable">
        <thead class="table-light text-muted">
        <tr>
          <th>ID</th>
          <th>Question</th>
          <th>Type</th>
          <th>Niveau</th>
          <th>Reponse correct</th>
          <th>reponses</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="question in questions" :key="question.id">
          <td>{{ question.id }}</td>
          <td>{{ question.question }}</td>
          <td>{{ question.type }}</td>
          <td>{{ question.difficulteeeee }}</td>
          <td>{{ question.reponseCorrecte }}</td>
          <td>{{ question.reponses }}</td>

          <td>
            <ul class="list-inline tasks-list-menu mb-0">
              <li class="list-inline-item" @click.prevent="editDetails(question)">
                <a href="#"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a>
              </li>
              <li class="list-inline-item">
                <a class="remove-item-btn" href="javascript:void(0);" @click.prevent="deleteForm(question)">
                  <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                </a>
              </li>
            </ul>
          </td>
        </tr>
        </tbody>
      </table>
    </div>

  </Layout>
</template>

<script>
import Layout from "@/layouts/main.vue";
import axios from 'axios';

export default {
  components: { Layout },
  data() {
    return {
      questions: [],
    };
  },
  mounted() {
    this.fetchQuestions();
  },
  methods: {
    async fetchQuestions() {
      try {
        const response = await axios.get('https://127.0.0.1:8000/api/get/questions');
        this.questions = response.data;
      } catch (error) {
        console.error('Error fetching forms:', error);
      }
    },
    editDetails(question) {
      this.$router.push({ name: 'editQuestion', params: { id: parseInt(question.id, 10) } });
    },
    async deleteForm(question) {
      try {
        await axios.delete(`https://127.0.0.1:8000/api/delete/question/${question.id}`);
        this.fetchQuestions(); // Refresh the list
      } catch (error) {
        console.error('Error deleting form:', error);
        // Handle the error appropriately (e.g., display an error message)
      }
    },
  },
};
</script>