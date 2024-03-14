<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('stand') }}">
                    <i class="mdi mdi-grid-large menu-icon"></i>
                    <span class="menu-title">Search</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('sorts') }}">
                    <i class="mdi mdi-flower menu-icon"></i>
                    <span class="menu-title">Tree</span>
                </a>
            </li>
             <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-circle-outline menu-icon"></i>
              <span class="menu-title">Misc</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('misc') }}">Vue Tests</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin') }}">Documents</a></li>
              </ul>
            </div>
          </li>
         </ul>
      </nav>
