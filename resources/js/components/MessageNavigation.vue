<template>

    <div class="sidebar-wrapper">  
     <ul class="nav">
         <li class="li-item li-active">
             <a class="item">
                 <i class="material-icons">move_to_inbox</i>Inbox
            </a>
        </li>
         <li class="li-item">
             <a class="item">
                 <i class="material-icons">send</i>Sent
             </a>
             
        </li>
         <li class="li-item">
             <a class="item">
                 <i class="material-icons">drafts</i>Draft
             </a>
             </li>
         <li class="li-item">
             <a class="item">
                 <i class="material-icons">archive</i>Archived
             </a>
        </li>
     </ul>
    </div>
</template>

<style>

    .nav{

        display: block;
        margin-top: 20px;
    }
    .nav .li-item{
        margin-top:10px;
        padding:  5px;
        border-radius: 5px;
       
    }
    .nav .li-item i{
        margin: 10px;
    }
    .nav .item{
        cursor: pointer;
        color: #a039b5 !important;
       
    }
    .nav .li-active, .nav .li-active .item{
        color: #fff !important;
        background-color: #a039b5 !important;
    }
    .nav .li-active.item{
        color: #fff !important;
       
    }
   
    .nav .li-item:hover{
        background: #eee;
    }
</style>

