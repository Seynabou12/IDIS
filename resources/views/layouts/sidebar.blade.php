<aside class="sidebar-wrapper mm-active" data-simplebar="true">
  <div class="sidebar-header">
    <div>
      <img src="/assets/images/products/ironwifi.png" class="logo-icon" alt="logo icon">
    </div>
    <div>
      <h4 class="logo-text" style="color: #0270e0; font-size: 30px;">Cloudi-fi</h4>
    </div>
    <div class="toggle-icon ms-auto" style="color: #0270e0;"><i class="bi bi-chevron-double-left"></i>
    </div>
  </div>
  @auth

  <ul class="metismenu mm-show" id="menu">
    @if (Auth::user()->profil == 'superadmin')
    <li class="menu-label">Dashbord</li>
    <li>
      <a href="/dashbord" class="">
        <div class="parent-icon"><i class="bi bi-grid"></i>
        </div>
        <div class="menu-title">Dashbord</div>
      </a>
    </li>
    @endif
    @if (Auth::user()->profil == 'superadmin')
    <li class="menu-label">Gestion des Entreprises</li>
    <li>
      <a href="/customers" class="">
        <div class="parent-icon"><i class="bi bi-house-door"></i>
        </div>
        <div class="menu-title">Customers</div>
      </a>
    </li>
    @endif

    @if (Auth::user()->profil == 'customer')
    <li class="menu-label">Graphes</li>
    <li>
      <a href="/" class="">
        <div class="parent-icon"><i class="bi bi-house-door"></i>
        </div>
        <div class="menu-title">Dashboard</div>
      </a>
    </li>
    <li>
      <a href="/reporting" class="">
        <div class="parent-icon"><i class="bi bi-grid"></i>
        </div>
        <div class="menu-title">Reporting</div>
      </a>
    </li>
    <li class="menu-label">Networks</li>
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="bi bi-lock"></i>
        </div>
        <div class="menu-title">Networks</div>
      </a>
      <ul class="mm-collapse">
        <li> <a href="/networks"><i class="bi bi-hdd-network"></i>Networks</a>
        </li>
        <li> <a href="/portail_captifs"><i class="bi bi-wifi"></i>Captive Portals</a>
        </li>
        <li> <a href="/pointacces"><i class="bi bi-router"></i></i>Access Points</a>
        </li>
      </ul>
    </li>
    <li class="menu-label">Utilisateurs</li>
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="bi bi-lock"></i>
        </div>
        <div class="menu-title">Users</div>
      </a>
      <ul class="mm-collapse">
        <li> <a href="/users"><i class="bi bi-person-plus-fill"></i>Users</a></li>
        <li> <a href="/groups"><i class="bi bi-people-fill"></i>Groups</a></li>
        <li> <a href="/orgunits"><i class="bi bi-hdd-network"></i>Organizational Units</a> </li>

      </ul>
    </li>
    @endif
  </ul>
  @endauth

</aside>