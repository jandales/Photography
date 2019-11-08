<ul class="nav">
    <li class="nav-item active  ">
      <a  class="nav-link" href="/ph-admin">
        <i class="material-icons">dashboard</i>
        <p>Dashboard</p>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="/ph-admin/profile">
        <i class="material-icons">person</i>
        <p>User Profile</p>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="/ph-admin/posts">
        <i class="material-icons">content_paste</i>
        <p>Posts</p>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="/ph-admin/albums">
        <i class="material-icons">image</i>
        <p>Albums</p>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="/ph-admin/categories">
        <i class="material-icons">person</i>
        <p>Categories</p>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="/ph-admin/comments">
        <i class="material-icons">comment</i>
        <p>Comments</p>
      </a>
    </li>
    @if(auth()->user()->IsAdmin())

    <li class="nav-item ">
      <a class="nav-link" href="/ph-admin/messages">
        <i class="material-icons">email</i>
        <p>Messages</p>
      </a>
    </li>

    <li class="nav-item ">
      <a class="nav-link" href="/ph-admin/users">
        <i class="material-icons">group</i>
        <p>Users</p>
      </a>
    </li>

    <li class="nav-item ">
      <a class="nav-link" href="/ph-admin/users">
        <i class="material-icons">settings</i>
        <p>Settings</p>
      </a>
    </li>
    
    @endif
    <router-view></router-view>
    <li class="nav-item ">
    <a class="nav-link" href="{{route('logout')}}"  onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
     <i class="material-icons">logout</i>
        <p>Logout</p>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
           </form>
      </a>
    </li>
 
  </ul>