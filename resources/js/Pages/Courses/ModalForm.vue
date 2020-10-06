<template>
  <div>
    <div class="b-container-fluid">
    <h2>Salom</h2>
<b-form @submit.prevent="edit ? $emit('update-course',form.id) : $emit('create-course')">
      <b-form-group
        id="input-group-1"
        label="Price:"
        label-for="input-1"
        description="We'll never share your email with anyone else."
      >
        <b-form-input
          id="input-1"
          v-model="form.price"
          type="text"
          required
          placeholder="Enter price"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Your Name:" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="form.name"
          required
          placeholder="Enter name"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-3" label="Category" label-for="input-3">
        <b-form-select
          id="input-3"
          v-model="form.category_id"
          :options="categories"
                 value-field="id"
      text-field="name"

          required
        ></b-form-select>
      </b-form-group>
      <b-button type="submit" variant="primary">Submit</b-button>
    </b-form>
    </div>
  </div>
</template>
<script>
  export default {
      name: "ModalForm",
      props:['categories','edit','form'],
    data() {
return {
      
      }
    },
    methods: {
    }
  }
</script>