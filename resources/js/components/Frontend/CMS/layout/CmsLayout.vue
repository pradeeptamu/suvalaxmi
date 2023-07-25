<template>
  <div>
    <div class="gap"></div>
    <hr class="m-0">
    <div class="container-fluid mt-3">
      <div class="row ">
        <Sidebar></Sidebar>

        <div class="col-12 col-lg-9 col-xl-10 bg-color" id="main-container">
          <router-view></router-view>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Sidebar from './Sidebar.vue'
export default {
  name: "CmsLayout.vue",
  components: {
    Sidebar
  }
}
</script>

<style>
hr {
  border: 1px solid #38A1DA;
  border-radius: 1px;
}

.gap {
  padding-top: 62px;
}

.bg-color {
  background-color: #38A1DA;
}

.bg-select {
  background-color: #EBECF0;
}

/*@media screen and (max-width: 1024px) and (min-height: 750px) {*/
/**/
/*#sidebar,#main-container{*/
/*-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%;*/
/*}*/

/*#sidebar-img,#sidebar-name{*/
/*-webkit-box-flex:0;-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%;*/
/*}*/

/*}*/

/*@media screen and (max-height: 749px) and (max-width: 755px) {*/

/*#sidebar,#main-container{*/
/*-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%;*/
/*}*/
/*#sidebar-img,#sidebar-name{*/
/*-webkit-box-flex:0;-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%;*/
/*}*/
/*}*/
</style>