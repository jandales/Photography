<template>

    <div >

      <div  v-if="isAuth" class="wrapper">
        <div class="sidebar" data-color="purple" data-background-color="white" >
          <!--
            Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
    
            Tip 2: you can also add an image using data-image tag
        -->
          <div class="logo">
            <a href="/" class="simple-text logo-normal">
              <!-- {{ config('app.name', 'Laravel') }} -->
            </a>
          </div>
          <div  class="sidebar-wrapper">
              <side-navigation></side-navigation>
          </div>
        </div>
        <div class="main-panel">
          <!-- Navbar -->
                <top-navigation></top-navigation>
          <!-- End Navbar -->
          <div class="content">
            
            <div id="app" class="container-fluid">
    
     
              <!-- @include('private.partials.errors')-->
    
        
              <router-view></router-view>    
    
            </div><!-- end of Container-->
          </div>
        <footer-layout></footer-layout>
        </div>
      </div>

      <div  v-else>
        <div id="app" class="container-fluid">
           <router-view></router-view> 
        </div>
      </div>

    </div>
      
</template>

<script>
export default {
    data(){
      return {
        isAuth : this.$auth.isAuthenticated()
      }
    }
}
</script>

<style>

</style>
