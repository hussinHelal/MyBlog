<div class="sidebar bg-light" style="width: 250px; height: 100vh; " scope="col">
    <div>
      <ul class="list-group d-flex flex-column vh-100">
        <li class="list-group-item">
            <a href="{{ route('posts.index') }}" class=" {{ request()->routeIs('posts.index') ? 'active' : ''}} " aria-current="true">Posts</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('notes.index') }}" class=" {{ request()->routeIs('notes.index') ? 'active' : ''}}  ">Notes</a>
        </li>
        </ul>
    </div>
</div>
