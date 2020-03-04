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
      v-if="headerImages.length > 0"
    >
      <img v-for="img in headerImages" :key="img.id" :src="'/storage/' + img.src" />
    </slick>
  </div>
</template>

<script>
import Slick from "vue-slick";
import axios from 'axios';

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
      },
      headerImages: []
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
  },
  mounted () {
    let _this = this

    axios
      .get('/header-images')
      .then(res => {
        _this.headerImages = res.data;
      })
      .catch(err => {
        console.log(err)
        _this.headerImages = [
          {
            id: 0,
            src: '../images/slides/slides1.jpg'
          },
          {
            id: 1,
            src: '../images/slides/slides2.jpg'
          },
          {
            id: 3,
            src: '../images/slides/slides3.jpg'
          }
        ]
      })
  }
};
</script>

<style scoped>
/* @import url("/slick-carousel/slick/slick.css"); */
</style>

