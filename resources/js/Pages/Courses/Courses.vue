<template>
  <div>
    <b-button @click="show">Show</b-button>
    <b-table striped hover :items="courses" :fields="fields"></b-table>
    <modal :categories="categories"
      :form="form"
      :edit="edit"
      @create-course="createCourse"
      @update-course="updateCourse" />
  </div>
</template>
<script>
import Modal from "./../../Pages/Courses/ModalForm";
export default {
  components: {Modal},
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
      edit:false
    };
  },
  methods:{
       show () {
            this.$modal.show(Modal),{
              categories:this.categories,
              edit:this.edit,
              form:this.form,
            }},
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
          $("#exampleModal").modal("hide");
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
      this.form.clear();
      this.edit = true;
      this.form.reset();
      this.categories;
      $("#exampleModal").modal("show");
      this.form.fill(course);
      console.log(this.edit);
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