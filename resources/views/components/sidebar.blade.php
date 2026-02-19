<div class="sidebar bg-white" style="width: 250px; height: 100vh; " scope="col">
    <div>
      <ul class="list-group d-flex flex-column vh-100">
        <li class="list-group-item">
            <a href="{{ route('posts.index') }}" class=" {{ request()->routeIs('posts.index') ? 'active' : ''}} " aria-current="true">Posts</a>
        </li>
        </ul>
    </div>
</div>
