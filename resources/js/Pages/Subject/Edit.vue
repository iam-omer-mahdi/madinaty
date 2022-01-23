<template>
  <authenticated-layout>
    <section class="py-5 mt-5">
      <div class="container d-flex gap-4 flex-column justify-content-start align-items-start">
        <div class="col-10 mx-auto">
          <h4 class="fw-bold">تعديل المادة</h4>
          <form @submit.prevent="submit" class="shadow-sm border-top border-success border-2 p-4 bg-white">
            <div class="mb-2">
              <label for="name" class="form-label">الصف</label>
              <select class="form-select" name="grade_id" id="grade_id" v-model="form.grade_id" required>
                <option :value="grade.id" v-for="grade in grades" :key="grade.id">{{ grade.name }}</option>
              </select>
              <small class="text-danger mt-1 d-inline-block" v-if="errors.grade_id">
                {{ errors.grade_id }}
              </small>
            </div>
            <div class="mb-4">
              <label for="name" class="form-label">اسم المادة</label>
              <input type="text" name="name" id="name" class="form-control" v-model="form.name" required>
              <small class="text-danger mt-1 d-inline-block" v-if="errors.name">
                {{ errors.name }}
              </small>
            </div>
            <div class="mb-4">
              <label for="mark" class="form-label">العلامة الكاملة</label>
              <input type="number" name="mark" id="mark" class="form-control" v-model="form.mark" required>
              <small class="text-danger mt-1 d-inline-block" v-if="errors.mark">
                {{ errors.mark }}
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
    subject: Object,
    grades: Array
  },
  data() {
    return {
      form: this.$inertia.form({
        name: this.subject.name,
        mark: this.subject.mark,
        grade_id: this.subject.grade_id,
      })
    }
  },
  methods: {
    submit() {
      this.form.put(this.route('subjects.update', this.subject.id), {
          onFinish: () => this.form.reset('name'),
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