<template>
  <div>
    <div class="d-flex p-3" style="justify-content: flex-end">
      <b-button variant="primary" @click="show">Add</b-button>
    </div>
    <b-table striped hover :items="courses" :fields="fields">
      <template v-slot:cell(actions)="row">
        <b-button
          variant="success"
          size="sm"
          @click="editCourse(row.item, row.index, $event.target)"
          class="mr-1"
        >
          Edit
        </b-button>
        <b-button variant="danger" size="sm" class="mr-1"> Delete </b-button>
      </template>
    </b-table>
  </div>
</template>
<script>
import Modal from "./../../Pages/Courses/ModalForm";
export default {
  components: { Modal },
  name: "Courses",
  data() {
    return {
      form: new Form({
        id: "",
        name: "",
        category_id: "",
        description: "",
        status: "",
        price: "",
        lesson_count: "",
      }),
      fields: [
        "name",
        { key: "category.name", label: "Category" },
        { key: "status", label: "Status" },
        { key: "price", label: "Price" },
        "actions",
      ],
      courses: [],
      categories: [],
      edit: false,
    };
  },
  methods: {
    show() {
      this.form.clear();
      this.form.reset();
      this.$modal.show(Modal, {
        categories: this.categories,
        edit: this.edit,
        form: this.form,
        create: this.createCourse,
      });
    },
    createCourse() {
      this.form
        .post("api/course")
        .then((response) => {
          this.form.clear();
          this.courses = response.data.data;
        })
        .catch((err) => console.log(err));
    },
    updateCourse() {
      this.form
        .put("api/courses/" + this.form.id)
        .then((response) => {
          this.courses = response.data.data;
        })
        .catch((err) => console.log(err));
    },
    destroy(id) {
      axios.delete(`/courses/${id}`).then((response) => {
        this.courses = response.data.data;
      });
    },
    editCourse(course) {
      this.edit = true;
      this.$modal.show(Modal, {
        categories: this.categories,
        edit: this.edit,
        form: this.form,
        update: this.updateCourse,
      });
      this.form.clear();
      this.form.reset();
      this.form.fill(course);
    },
  },
  created() {
    axios
      .get("api/courses")
      .then((response) => (this.courses = response.data.data));
    axios
      .get("api/categories")
      .then((response) => (this.categories = response.data.data));
  },
};
</script>