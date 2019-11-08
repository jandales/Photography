<template>
        <div class="sidebar-wrapper">                    
                
                <ul class="nav">
                    <li class="nav-item">
                        <router-link  class="nav-link" to="/ph-admin">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </router-link>
                    </li>
                    <li class="nav-item ">
                        <router-link class="nav-link" to="/ph-admin/profile">
                            <i class="material-icons">person</i>
                            <p>User Profile</p>
                        </router-link>
                    </li>
                    <li class="nav-item ">
                        <router-link class="nav-link" to="/ph-admin/posts">
                            <i class="material-icons">content_paste</i>
                            <p>Posts</p>
                        </router-link>
                    </li>
                    <li class="nav-item ">
                        <router-link class="nav-link" to="/ph-admin/albums">
                            <i class="material-icons">image</i>
                            <p>Albums</p>
                        </router-link>
                    </li>
                    <li class="nav-item ">
                        <router-link class="nav-link" to="/ph-admin/categories">
                            <i class="material-icons">person</i>
                            <p>Categories</p>
                        </router-link>
                    </li>
                    <li class="nav-item ">
                        <router-link class="nav-link" to="/ph-admin/comments">
                            <i class="material-icons">comment</i>
                            <p>Comments</p>
                        </router-link>
                    </li>
                    <li class="nav-item ">
                        <router-link class="nav-link" to="/ph-admin/messages">
                            <i class="material-icons">email</i>
                            <p>Messages</p>
                        </router-link>
                    </li>

                    <li class="nav-item ">
                        <router-link class="nav-link" to="/ph-admin/users">
                            <i class="material-icons">group</i>
                            <p>Users</p>
                        </router-link>
                    </li>

                    <li class="nav-item ">
                        <router-link class="nav-link" to="/ph-admin/settings">
                            <i class="material-icons">settings</i>
                            <p>Settings</p>
                        </router-link>
                    </li>
                    
                
                    
                    <li class="nav-item">
                        <router-link class="nav-link" to="/ph-admin/logout">
                        <i class="material-icons">power_setting</i>
                            <p>Logout</p>                   
                        </router-link>
                    </li>           
                 </ul>
      </div>
</template>

<script>
export default {
    methods :{
        logout(){
            axios.post('/logout').then(res => console.log(resdata))
        }
    }
}
</script>

