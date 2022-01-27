<template>
  <authenticated-layout>
    <section class="py-5 mt-5">
      <div class="container">
        <h4 class="fw-bold">اضافة امتحان</h4>
        <form @submit.prevent="submit" class="bg-white shadow-sm p-4 border-top border-2 border-success">
          <div class="mb-3">
            <label for="grade_id" class="form-label">الصف</label>
            <select name="grade_id" id="grade_id" class="form-select" v-model="form.grade_id" required>
              <option v-for="grade in grades" :key="grade.id" :value="grade.id">{{grade.name}}</option>
            </select>
            <small class="text-danger mt-1 d-inline-block" v-if="errors.grade_id">
              {{ errors.grade_id }}
            </small>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">اسم الامتحان</label>
            <input type="text" class="form-control" name="name" id="name" v-model="form.name" required>
            <small class="text-danger mt-1 d-inline-block" v-if="errors.name">
              {{ errors.name }}
            </small>
          </div>
          <div class="mb-3">
            <label for="date" class="form-label">تاريخ الامتحان</label>
            <input type="date" class="form-control" name="date" id="date" v-model="form.date" required>
            <small class="text-danger mt-1 d-inline-block" v-if="errors.date">
              {{ errors.date }}
            </small>
          </div>
          <button type="submit" class="btn btn-success w-100">اضافة</button>
        </form>
      </div>
    </section>
  </authenticated-layout>
</template>

<script>
import AuthenticatedLayout from "../../Layouts/Authenticated.vue";
import {Link} from "@inertiajs/inertia-vue3";
import debounce from 'lodash/debounce'
export default {
  props: {
    errors: Object,
    grades: Array,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        date: null,
        grade_id: null,
      }),
      filter: '',
      search: '',
    }
  },
  components: {
    AuthenticatedLayout,
    Link
  },
  methods: {
    submit() {
      this.form.post(this.route('exams.store'), {
        // onFinish: () => this.form.reset()
      })
    }
  }
}
</script>

<style>

</style>