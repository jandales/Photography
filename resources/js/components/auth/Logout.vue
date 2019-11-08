
<template>
    
</template>

<script>
export default {
    methods : {
        logout () {
            var _this= this;
     
            
           axios.post('http://photography.com/api/logout').then(res => 
           {

             this.$auth.destroyToken('access_token')
             window.location = '/login'

             console.log('isAuthenticated ' + this.$auth.isAuthenticated())

           });
        }
    },
    created(){
        this.logout()
    }
    
}
</script>

<style>

</style>

