<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Courses</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <h2>Slides</h2>
          <div class="d-flex">
            <button @click="all" class="btn btn-success" v-text="'All'" />
            <div v-for="category in categories" :key="category.id">
              <button
                @click="selectCategory(category.id)"
                class="btn btn-success"
                v-text="category.name"
              />
            </div>
          <div class="d-flex">  <b-button variant="success" @click="showPrev">Prev</b-button> <b-button variant="success" @click="showNext">Next</b-button>
</div>

          </div>
          <br />
          <VueSlickCarousel
          ref="carousel"
            v-if="filteredCourses.length > 0"
            v-bind="settings"
            class="carousel m-4"
          >
            <div v-for="course in filteredCourses" :key="course.id">
              <div class="m-1">
                <b-card
                  title="Card Title"
                  img-src="https://picsum.photos/600/300/?image=27"
                  img-alt="Image"
                  img-top
                  tag="article"
                  style="max-width: 20rem"
                  class="mb-2"
                >
                  <b-card-text>
                   {{course.description}}
                  </b-card-text>
                  <b-button href="#" variant="primary">Go somewhere</b-button>
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
      selectedCategoryId: "",
      settings: {
        slidesToShow: 4,
        infinite: true,
        accessibility: true,
        adaptiveHeight: false,
        arrows: true,
        dots: true,
        draggable: true,
        edgeFriction: 0.3,
        swipe: true,
      },
    };
  },
  methods: {
        showNext() {
        this.$refs.carousel.next()
      },
       showPrev() {
        this.$refs.carousel.prev()
      },
 
    all() {
      this.selectedCategoryId = "";
      //   this.settings.slidesToScroll = 3;
      this.settings.slidesToShow = 4;
    },
    selectCategory(id) {
      //   this.settings.slidesToScroll = 1;
      this.settings.slidesToShow = 1;
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
