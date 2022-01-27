<template>
  <authenticated-layout>
    <section class="py-5 mt-5">
      <div class="container d-flex gap-4 flex-column justify-content-start align-items-start">
        <div class="col-10 mx-auto">
          <h4 class="fw-bold">تعديل الامتحان</h4>
          <form @submit.prevent="submit" class="shadow-sm border-top border-success border-2 p-4 bg-white">
            <div class="mb-3">
              <label for="name" class="form-label">الصف</label>
              <select class="form-select" name="grade_id" id="grade_id" v-model="form.grade_id">
                <option :value="grade.id" v-for="grade in grades" :key="grade.id">{{ grade.name }}</option>
              </select>
              <small class="text-danger mt-1 d-inline-block" v-if="errors.grade_id">
                {{ errors.grade_id }}
              </small>
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">اسم الامتحان</label>
              <input type="text" name="name" id="name" class="form-control" v-model="form.name">
              <small class="text-danger mt-1 d-inline-block" v-if="errors.name">
                {{ errors.name }}
              </small>
            </div>
            <div class="mb-4">
              <label for="exam_date" class="form-label">التاريخ</label>
              <input type="date" name="exam_date" id="exam_date" class="form-control" v-model="form.exam_date">
              <small class="text-danger mt-1 d-inline-block" v-if="errors.exam_date">
                {{ errors.exam_date }}
              </small>
            </div>
            <button class="btn btn-success w-100" :disabled='form.processing'>تعديل</button>
          </form>
        </div>
      </div>
    </section>
  </authenticated-layout>
</template>

<script>
import AuthenticatedLayout from '../../Layouts/Authenticated.vue'
import {Link} from '@inertiajs/inertia-vue3'
export default {
  props: {
    errors: Object,
    exam: Object,
    grades: Array
  },
  data() {
    return {
      form: this.$inertia.form({
        name: this.exam.name,
        exam_date: this.exam.exam_date,
        grade_id: this.exam.grade_id,
      })
    }
  },
  methods: {
    submit() {
      this.form.put(this.route('exams.update', this.exam.id), {
          onFinish: () => this.form.reset(),
      })
    }
  },
  components: {
    AuthenticatedLayout,
    Link
  }
}
</script>

<style>

</style>