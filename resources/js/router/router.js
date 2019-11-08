import Vue from  'vue';
import VueRouter from 'vue-router';

/// components 
import Categories from '../components/views/category/Categories.vue'
import Adminpage from '../components/views/Index.vue'
import Users from '../components/views/users/Users.vue'
import Usercreate from '../components/views/users/Usercreate.vue'
import Useredit from '../components/views/users/Useredit.vue'

import Posts from '../components/views/posts/Posts.vue'
import Createpost from '../components/views/posts/Createpost.vue'
import EditPost from '../components/views/posts/Editpost.vue'

import Comments from '../components/views/comments/Comments.vue'

import Albums from '../components/views/album/Albums.vue'
import AlbumCreate from '../components/views/album/AlbumCreate.vue'
import AlbumEdit from '../components/views/album/AlbumEdit.vue'
import AlbumAddPhotos from '../components/views/album/AlbumAddPhotos.vue'

import Profile from '../components/views/profile/Profile.vue'

import Messages from '../components/views/message/Messages.vue'
import ReadMessage from '../components/views/message/ReadMessage.vue'
import Inbox from '../components/views/message/Inbox.vue'
import Sentbox from '../components/views/message/Sendbox.vue'
import Draft from '../components/views/message/Draft.vue'
import Archived from '../components/views/message/Archived.vue'
import Settings from '../components/views/setting/Settings.vue'
import Compose from '../components/views/message/compose.vue'
import ViewCompose from '../components/views/message/ViewCompose.vue'
import Trash from '../components/views/message/Trash.vue'
import Login from  '../components/auth/login.vue'
import logout from  '../components/auth/Logout.vue'

Vue.use(VueRouter);

  const router = new VueRouter({ 

     routes : [

      {

        path : '/ph-admin/login',

        name : 'login',

        component : Login,

        meta: {

            guest : true

        }

      },

      { 
        path      : '/ph-admin',

        name      : 'index',

        component : Adminpage,

        meta : {

          Authenticated : true

        }

      },

      {
        path : '/ph-admin/categories',

        component: Categories,

        meta : {

            Authenticated : true

        }

      },

      { 
        path : '/ph-admin/users',

        component : Users,

        meta : {

          Authenticated : true

        }

      },
      
      { 
        path : '/ph-admin/users/create',

        component: Usercreate,

        meta : {

          Authenticated : true

        }

      },

      {
         path : '/ph-admin/users/edit/:id',
         
         name : 'useredit',

         component : Useredit,

         meta : {

          Authenticated : true

        }
      },

      { 
        path : '/ph-admin/posts',

        component : Posts,

        meta : {

          Authenticated : true

        }

      },

      { 

        path : '/ph-admin/posts/create',

        name: 'createpost',

        component : Createpost,

        meta : {

          Authenticated : true

        },

      },

      { 
        path : '/ph-admin/posts/edit/:id',

        name : 'editpost',

        component : EditPost,

        meta : {

          Authenticated : true

        }

      },

      { 
        path : '/ph-admin/comments',

        name : 'comments',

        component : Comments,

        meta : {

          Authenticated : true

        }

      },

      { 

        path : '/ph-admin/albums',

        name : 'album',

        component : Albums,

        meta : {

          Authenticated : true

        }

      },

      { 

        path : '/ph-admin/albums/create',

        name :  'createalbum',

        component : AlbumCreate,

        meta : {

          Authenticated : true

        }

      },

      { 
        path : '/ph-admin/albums/edit/:id',

        name : 'editalbum',

        component : AlbumEdit,

        meta : {

          Authenticated : true

        }

     },

      { 
        path : '/ph-admin/albums/gallery/:id',

        name : 'galleryAlbum', 

        component : AlbumAddPhotos,

        meta : {

          Authenticated : true

        }

     },

     { 
       path : '/ph-admin/profile',

       name : 'profile',

       component : Profile,

       meta : {

        Authenticated : true

      }

     },

    { 
      path : '/ph-admin/messages',

      name : 'messages', 

      component : Messages,

      meta : {

        Authenticated : true

      },


            children : [

              { 

                path : 'compose',

                name : 'compose',

                component : Compose,

              },

              { 

                path : 'viewcompose/:id',

                name : 'viewcompose',

                component : ViewCompose,


              },

              {
                
                path : 'inbox',

                name : 'inbox',

                component : Inbox

              },

              { 
                
                path : 'sentbox',

                name : 'sentbox',

                component : Sentbox
              
              },

              { 
                 
                path : 'draft',

                name : 'draft',

                component : Draft

              },

              { 

                path : 'archived',

                name : 'archived',

                component : Archived,

              },

              {
                
                path : 'trash',

                name : 'trash',

                component : Trash

              },

              { 

                path : 'inbox/read/:id',

                name : 'readmessage',

                component : ReadMessage

              }            

            ]

    },

     

      { 
        
        path : '/ph-admin/settings',

        name : 'settings',

        component : Settings,

        meta : {

          Authenticated : true

        }

      
      },

      { 
        
        path : '/ph-admin/logout',

        name : 'logout',

        component : logout,

        meta : {

          Authenticated : true

        }

      
      }
    



    ],
     mode : 'history'
  })



  export default router