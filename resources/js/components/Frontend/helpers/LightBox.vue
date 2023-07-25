<template>
  <div>
    <div class="row">
      <div class="col-12 col-sm-12 col-md-5 col-lg-5 big_image">
        <img class="w-100 h-100" @click="lightboxEffect(0)" :key="thumbnails[0]" :src="thumbnailsPath + thumbnails[0]">
      </div>

      <div class="col-12 col-sm-12 col-md-7 col-lg-7 image-grid">
        <img v-for="(thumbnail, index) in visibleThumbnails" :key="thumbnail" :src="thumbnailsPath + thumbnail"
          class="light-box__thumbnail col-12 col-sm-12 col-md-6 col-lg-6 w-100 small_images" alt="property-images"
          @click="lightboxEffect(index)">

      </div>
    </div>

    <transition name="fade" mode="out-in">
      <div @click.stop="bg = !bg" class="light-box__bg" v-if="bg"></div>
    </transition>

    <div v-if="bg" class="light-box-container">
      <div class="light-box__close" @click.stop="bg = !bg"><i class="fas fa-times"></i></div>
      <p class="light-box__count" v-if="count">
        {{ arrayIndex + 1 }}/
        <span>{{ thumbnails.length }}</span>
      </p>
      <button @click="prev" v-on:keyup.left="prev" class="light-box__prev light-box__btn"><i
          class="fas fa-chevron-left"></i></button>

      <div v-if="bg" class="light-box__container">
        <transition name="fade" mode="out-in">
          <img :key="currentImage" :src="largePath + currentImage" class="light-box__container__img lightbox_image">
        </transition>
      </div>

      <div class="light-box__caption" v-if="caption">
        <p v-if="captions[currentImage]">{{ captions[currentImage] }}</p>
      </div>

      <button v-on:keyup.right="next" @click="next" class="light-box__next light-box__btn"><i
          class="fas fa-chevron-right"></i></button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      bg: false,
      currentImage: '',
      count: true,
      arrayIndex: 0,
      caption: false,
    };
  },
  props: {
    thumbnails: {
      type: Array,
      required: true
    },
    largeImages: {
      type: Array,
      required: true
    },
    captions: {
      type: Array,
      required: true
    },
    thumbnailsPath: {
      type: String,
      required: true
    },
    largePath: {
      type: String,
      required: true
    }
  },
  computed: {
    visibleThumbnails() {
      return this.thumbnails.slice(1, 5); // Return the first four thumbnails (skip the first one at index 0)
    },
  },
  methods: {
    lightboxEffect(index) {
      this.arrayIndex = index;
      this.currentImage = this.largeImages[this.arrayIndex];
      this.bg = !this.bg;
    },
    next() {
      if (this.arrayIndex < this.largeImages.length - 1) {
        this.arrayIndex++;
        this.currentImage = this.largeImages[this.arrayIndex];
      } else {
        this.arrayIndex = 0;
        this.currentImage = this.largeImages[this.arrayIndex];
      }
    },
    prev() {
      if (this.arrayIndex > 0) {
        this.arrayIndex--;
        this.currentImage = this.largeImages[this.arrayIndex];
      } else {
        this.arrayIndex = this.largeImages.length - 1;
        this.currentImage = this.largeImages[this.arrayIndex];
      }
    }
  }
};
</script>

<style lang="scss" scoped>
img {
  object-fit: cover;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.light-box {
  &__bg {
    position: fixed;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.89);
    z-index: 2000;
  }

  &__thumbnail {
    cursor: pointer;
  }

  &__close {
    padding: 10px;
    position: fixed;
    right: 20px;
    top: 20px;
    background-size: contain;
    background-position: center;
  }

  &__container {
    position: fixed;
    z-index: 2000;
    display: flex;
    justify-content: center;
    align-items: center;
    max-width: 900px;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    min-height: 800px;

    img {
      align-self: center;
    }
  }

  &__btn {
    background-size: contain;
    background-position: center;
    align-self: center;
    padding: 15px;
  }

  &__close,
  &__btn {
    cursor: pointer;
  }

  &__close,
  &__btn,
  &__caption,
  &__count {
    position: fixed;
    z-index: 3000;
  }

  &__next {
    right: 20px;
  }

  &__prev {
    left: 20px;
  }

  &__next,
  &__prev {
    background-size: contain;
    background-repeat: no-repeat;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0.7;
  }

  &__caption {
    bottom: 0;
    width: 100%;
    height: 50px;
    display: flex;
    align-items: center;
    color: #fff;
    font-size: 20px;
    justify-content: center;
  }

  &__count {
    left: 20px;
    font-size: 16px;
    color: #fff;
    top: 14px;
    padding: 0;
    margin: 0;
  }
}

.light-box-container {
  button {
    border: none;
  }
}

.big_image {
  height: 385px;
}

.small_images {
  height: 190px;
  margin-bottom: 5px;
  padding-left: 2.5px;
  padding-right: 2.5px;
}

.lightbox_image {
  width: 800px;
  height: 600px;
}

@media only screen and (max-width: 767px) {
  .image-grid {
    padding: 0;
    display: none;
  }

  .big_image {
    height: 250px;
    margin-bottom: 5px;
  }

  .small_images {
    padding: 0;
  }

  .lightbox_image {
    width: 400px;
    height: 300px;
  }
}

@media only screen and (min-width: 767px) {
  .big_image {
    padding-right: 3px !important;
  }

  .image-grid {
    padding: 0;
  }
}
</style>