<div class="sidebar bg-dark" style="width: 250px; height: 100vh; ">
    <div>
      <div class="list-group ">
        {{-- <li class="list-group-item"> --}}
            <a href="{{ route('posts.index') }}" class=" list-group-item list-group-item-dark {{ request()->routeIs('posts.index') ? 'active' : ''}} " aria-current="true">Posts</a>
        {{-- </li> --}}
        {{-- <li class="list-group-item"> --}}
            <a href="{{ route('notes.index') }}" class="list-group-item list-group-item-dark {{ request()->routeIs('notes.index') ? 'active' : ''}}  ">Notes</a>
        {{-- </li> --}}
        </div>
    </div>
</div>
