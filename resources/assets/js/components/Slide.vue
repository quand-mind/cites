<!--
Ultima Actualización: 16/01/2020

Tipo de componente: Módulo

Donde se usa:
	Home.vue (vista)

Descripción:
	Slide con noticias
 -->

 <template>
  <div class="">
    <!-- Slider -->
    <slick 
      ref="slick"
      :options="slickOptions"
    >
      <img src="/images/slides/1.jpg" alt />
      <img src="/images/slides/2.jpg" alt />
      <img src="/images/slides/3.jpg" alt />
      <img src="/images/slides/4.jpg" alt />
      <img src="/images/slides/5.jpg" alt />
    </slick>
  </div>
</template>

<script>
import Slick from "vue-slick";

export default {
  name: "slide",
  components: { Slick },

  data() {
    return {
      slickOptions: {
        infinite: true,
        autoplay: true,
        autoplaySpeed: 5000,
        arrows: false,
        speed: 3000,
        fade: true,
        slidesToShow: 1,
        slidesToScroll: 1
      }
    };
  },

  // All slick methods can be used too, example here
  methods: {
    next() {
      this.$refs.slick.next();
    },

    prev() {
      this.$refs.slick.prev();
    },

    reInit() {
      // Helpful if you have to deal with v-for to update dynamic lists
      this.$nextTick(() => {
        this.$refs.slick.reSlick();
      });
    }
  }
};
</script>

<style scoped>
/* @import url("/slick-carousel/slick/slick.css"); */
</style>

