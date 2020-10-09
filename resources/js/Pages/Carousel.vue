<template>
  <app-layout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <h2 class="p-3">Slides</h2>
          <div class="d-flex m-3">
            <button @click="all" class="btn btn-success" v-text="'All'" />
            <div v-for="category in categories" :key="category.id">
              <b-button
                @click="selectCategory(category.id)"
                variant="light"
                v-text="category.name"
              />
            </div>
            <div class="d-flex ml-5">
              <b-button  variant="success" @click="showPrev"><i class="fas fa-arrow-left"></i></b-button>
              <b-button variant="success" @click="showNext"><i class="fas fa-arrow-right"></i></b-button>
            </div>
          </div>
          <br />
          <VueSlickCarousel
            ref="carousel"
            v-if="filteredCourses.length > 0"
            v-bind="settings"
            :key="selectedCategoryId"
            class="carousel m-4"
          >
            <div v-for="course in filteredCourses" :key="course.id">
              <div class="m-1">
                <b-card
                  :title="course.name"
                  :img-src="url + course.id"
                  img-alt="Image"
                  img-top
                  tag="article"
                  style="max-width: 20rem"
                  class="mb-2"
                >
                  <b-card-text>
                    {{ course.description }}
                  </b-card-text>
                </b-card>
              </div>
            </div>
          </VueSlickCarousel>
          <div v-if="filteredCourses.length == 0">
            <h3>No,course available</h3>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "./../Layouts/AppLayout";
import VueSlickCarousel from "vue-slick-carousel";
import "vue-slick-carousel/dist/vue-slick-carousel.css";
import "vue-slick-carousel/dist/vue-slick-carousel-theme.css";
export default {
  components: { AppLayout, VueSlickCarousel },
  name: "Carousel",
  data() {
    return {
      categories: [],
      courses: [],
      url: "https://picsum.photos/600/300/?image=",
      selectedCategoryId: "",
      settings: {
        slidesToShow: 4,
        infinite: false,
        accessibility: true,
        adaptiveHeight: false,
        arrows: true,
        draggable: true,
        edgeFriction: 0.3,
        swipe: true,
      },
    };
  },
  methods: {
    showNext() {
      this.$refs.carousel.next();
    },
    showPrev() {
      this.$refs.carousel.prev();
    },
    reInit() {
            // Helpful if you have to deal with v-for to update dynamic lists
            this.$nextTick(() => {
                this.$refs.slick.reSlick();
            });
        },
    all() {
      this.selectedCategoryId ="";
      this.courses;
    },
    selectCategory(id) {
      this.selectedCategoryId = id;
    },
  },
  computed: {
    filteredCourses() {
      if (this.selectedCategoryId === "") {
        return this.courses;
      } else if (this.selectedCategoryId != "") {
        return this.courses.filter(
          (course) => course.category_id == this.selectedCategoryId
        );
      }
    },
  },
  mounted() {
    axios
      .get("api/courses")
      .then((response) => (this.courses = response.data.data));
    axios
      .get("api/categories")
      .then((response) => (this.categories = response.data.data));
},
};
</script>
