<template>
  <div>
    <b-container class="p-3">
      <h2>Fill the form</h2>
      <b-form @submit="onSubmit">
        <b-form-group id="input-group-1" label="Your Name:" label-for="input-1">
          <b-form-input
            id="input-1"
            v-model="form.name"
            required
            placeholder="Enter name"
          ></b-form-input>
        </b-form-group>
        <b-form-group id="input-group-2" label="Your desc:" label-for="input-2">
          <b-form-input
            id="input-2"
            v-model="form.description"
            required
            placeholder="Enter the description"
          ></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-3" label="Price:" label-for="input-3">
          <b-form-input
            id="input-3"
            v-model="form.price"
            type="text"
            required
            placeholder="Enter price"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          id="input-group-4"
          label="Lesson count:"
          label-for="input-4"
        >
          <b-form-input
            id="input-4"
            v-model="form.lesson_count"
            type="number"
            required
            placeholder="Enter lesson count"
          ></b-form-input>
        </b-form-group>
        <b-form-group id="input-group-5" label="Status:" label-for="input-5">
          <b-form-input
            id="input-5"
            v-model="form.status"
            type="text"
            required
            placeholder="Enter status"
          ></b-form-input>
        </b-form-group>
        <b-form-group id="input-group-6" label="Category" label-for="input-6">
          <b-form-select
            id="input-6"
            v-model="form.category_id"
            :options="categories"
            value-field="id"
            text-field="name"
            required
          ></b-form-select>
        </b-form-group>
        <b-button type="submit" variant="primary">Submit</b-button>
      </b-form>
    </b-container>
  </div>
</template>
<script>
export default {
  name: "ModalForm",
  props: ["categories", "edit", "form", "update", "create"],
  data() {
    return {
    };
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      this.edit ? this.update(this.form.id) : this.create();
      this.$modal.hideAll();
    },
  },
 
};
</script>