import Messages from '../components/views/message/Messages.vue'
import ReadMessage from '../components/views/message/ReadMessage.vue'

import Settings from '../components/views/setting/Settings.vue'

Vue.use(VueRouter);



  const router = new VueRouter({ 

     routes : [
     
    

      { path : '/ph-admin/messages/inbox/read/:id', name : 'readmessage', compotent : ReadMessage },

    
    



    ],
     mode : 'history'
  })



  export default router