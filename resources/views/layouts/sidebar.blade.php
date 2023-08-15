       <!-- Main Sidebar Container -->
       <aside class="main-sidebar sidebar-dark-primary elevation-4">
           <!-- Brand Logo -->
           <a href="index3.html" class="brand-link">
               <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                   class="brand-image img-circle elevation-3" style="opacity: .8">
               <span class="brand-text font-weight-light">FFIMS - LUPON</span>
           </a>

           <!-- Sidebar -->
           <div class="sidebar">
               <!-- Sidebar user panel (optional) -->
               <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                   <div class="image">
                       <img src="{{ asset('asset/user') . '/' . Auth()->user()->image }}" class="img-circle elevation-2"
                           alt="User Image">
                   </div>
                   <div class="info">
                       @php
                           $userName = Auth()->user()->name . ' ' . Auth()->user()->lastname;
                       @endphp
                       <a href="#" class="d-block">{{ $userName }} </a>
                   </div>
               </div>



               @switch(Auth::user()->role)
                   @case('Administrator')
                       <nav class="mt-2">
                           <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                               data-accordion="false">
                               <li class="nav-item">
                                   <a href="{{ route('administrator.dashboard') }}"
                                       class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                                       <i class="fa-solid fa-gauge-high nav-icon"></i>
                                       <p>Dashboard</p>
                                   </a>
                               </li>
                               <li class="nav-header">Functions</li>
                               <li class="nav-item @if (Request::segment(2) == 'management') menu-open @endif">
                                   <a href="#" class="nav-link @if (Request::segment(2) == 'management') active @endif">
                                       <i class="nav-icon fas fa-copy"></i>
                                       <p>
                                           Management
                                           <i class="fas fa-angle-left right"></i>

                                       </p>
                                   </a>
                                   <ul class="nav nav-treeview">
                                       <li class="nav-item">
                                           <a href="{{ route('management.program') }}"
                                               class="nav-link @if (Request::segment(3) == 'program') active @endif">
                                               <i class="fa-solid fa-file-contract nav-icon"></i>
                                               <p>Program</p>
                                           </a>
                                       </li>
                                       <li class="nav-item">
                                           <a href="{{ route('management.programcategory') }}"
                                               class="nav-link @if (Request::segment(3) == 'pc') active @endif">
                                               <i class="fa-solid fa-diagram-project nav-icon"></i>
                                               <p>Program Category</p>
                                           </a>
                                       </li>
                                       {{-- Start Multiple level dropdown   --}}
                                       <li class="nav-item @if (Request::segment(3) == 'rbo') menu-open @endif">
                                           <a href="#" class="nav-link @if (Request::segment(3) == 'rbo') active @endif">
                                               <i class="fa-solid fa-house-user nav-icon"></i>
                                               <p>
                                                   RBO
                                                   <i class="right fas fa-angle-left"></i>
                                               </p>
                                           </a>
                                           <ul class="nav nav-treeview">
                                               <li class="nav-item">
                                                   <a href="{{ route('rbo.index') }}"
                                                       class="nav-link @if (Request::segment(4) == 'list') active @endif">
                                                       <i class="fa-solid fa-highlighter nav-icon"></i>
                                                       <p>List</p>
                                                   </a>
                                               </li>
                                               <li class="nav-item">
                                                   <a href="{{ route('rbo.cluster') }}"
                                                       class="nav-link @if (Request::segment(4) == 'cluster') active @endif">
                                                       <i class="fa-solid fa-highlighter nav-icon"></i>
                                                       <p>Cluster</p>
                                                   </a>
                                               </li>
                                               <li class="nav-item">
                                                   <a href="{{ route('rbo.association') }}"
                                                       class="nav-link @if (Request::segment(4) == 'association') active @endif">
                                                       <i class="fa-solid fa-highlighter nav-icon"></i>
                                                       <p>Association</p>
                                                   </a>
                                               </li>

                                           </ul>
                                       </li>
                                       {{-- End Multiple level dropdown   --}}
                                   </ul>
                               </li>

                               <li class="nav-item  @if (Request::segment(2) == 'f2') menu-open @endif">
                                   <a href="#" class="nav-link @if (Request::segment(2) == 'f2') active @endif">
                                       <i class="fa-solid fa-users nav-icon"></i>
                                       <p>
                                           Farmer/Fisherfolk
                                           <i class="fas fa-angle-left right"></i>

                                       </p>
                                   </a>
                                   <ul class="nav nav-treeview">
                                       <li class="nav-item">
                                           <a href="{{ route('f2.index') }}"
                                               class="nav-link @if (Request::segment(3) == 'list') active @endif">
                                               <i class="fa-solid fa-users-between-lines nav-icon"></i>
                                               <p>List</p>
                                           </a>
                                       </li>
                                       <li class="nav-item">
                                           <a href="" class="nav-link">
                                               <i class="fa-solid fa-users-between-lines nav-icon"></i>
                                               <p>Activity</p>
                                           </a>
                                       </li>
                                   </ul>
                               </li>

                               <li class="nav-header">Accounts</li>
                               <li class="nav-item @if (Request::segment(2) == 'user') menu-open @endif">
                                   <a href="#" class="nav-link @if (Request::segment(2) == 'user') active @endif">
                                       <i class="fa-solid fa-users nav-icon"></i>
                                       <p>
                                           User
                                           <i class="fas fa-angle-left right"></i>
                                       </p>
                                   </a>
                                   <ul class="nav nav-treeview">
                                       <li class="nav-item">
                                           <a href="{{ route('user.index') }}"
                                               class="nav-link @if (Request::segment(3) == 'user') active @endif">
                                               <i class="fa-solid fa-users-between-lines nav-icon"></i>
                                               <p>User List</p>
                                           </a>
                                       </li>
                                       <li class="nav-item">
                                           <a href="{{ route('user.ascomindex') }}"
                                               class="nav-link @if (Request::segment(3) == 'assignment') active @endif">
                                               <i class="fa-solid fa-user-pen nav-icon"></i>
                                               <p>User Assignment</p>
                                           </a>
                                       </li>


                                   </ul>
                               </li>

                               <li class="nav-item">
                                   <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                       <i class="fa-solid fa-user-tie nav-icon"></i>
                                       <p>My Account</p>
                                   </a>
                               </li>
                               <li class="nav-header">Settings</li>
                               <li class="nav-item @if (Request::segment(2) == 'location') menu-open @endif">
                                   <a href="#" class="nav-link @if (Request::segment(2) == 'location') active @endif">
                                       <i class="fa-solid fa-users-gear nav-icon"></i>
                                       <p>
                                           User Settings
                                           <i class="fas fa-angle-left right"></i>

                                       </p>
                                   </a>
                                   <ul class="nav nav-treeview">
                                       <li class="nav-item">
                                           <a href="{{ route('location.index') }}"
                                               class="nav-link @if (Request::segment(2) == 'location') active @endif">
                                               <i class="fa-solid fa-map-location-dot nav-icon"></i>
                                               <p>Fixed Location</p>
                                           </a>
                                       </li>



                                   </ul>
                               </li>


                               <li class="nav-item">
                                   <a href="#" class="nav-link">
                                       <i class="fa-solid fa-users nav-icon"></i>
                                       <p>
                                           Template Node 1
                                           <i class="fas fa-angle-left right"></i>

                                       </p>
                                   </a>
                                   <ul class="nav nav-treeview">
                                       <li class="nav-item">
                                           <a href="" class="nav-link">
                                               <i class="fa-solid fa-users-between-lines nav-icon"></i>
                                               <p>Template Node 2</p>
                                           </a>
                                       </li>
                                   </ul>
                               </li>



                               <li class="nav-item">
                                   <a href="{{ route('auth.logout') }}" class="nav-link">
                                       <i class="fa-solid fa-arrow-right-from-bracket nav-icon"></i>
                                       <p>Logout</p>
                                   </a>
                               </li>

                           </ul>
                       </nav>
                   @break

                   @case('Technician')
                       <nav class="mt-2">
                           <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                               data-accordion="false">
                               <li class="nav-item">
                                   <a href="{{ route('administrator.dashboard') }}"
                                       class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                                       <i class="fa-solid fa-gauge-high nav-icon"></i>
                                       <p>Dashboard</p>
                                   </a>
                               </li>


                               <li class="nav-header">Accounts</li>


                               <li class="nav-item">
                                   <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                       <i class="fa-solid fa-user-tie nav-icon"></i>
                                       <p>My Account</p>
                                   </a>
                               </li>

                               <li class="nav-header">Settings</li>


                               <li class="nav-item">
                                   <a href="{{ route('auth.logout') }}" class="nav-link">
                                       <i class="fa-solid fa-map-location-dot nav-icon"></i>
                                       <p>Fixed Location</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="{{ route('auth.logout') }}" class="nav-link">
                                       <i class="fa-solid fa-arrow-right-from-bracket nav-icon"></i>
                                       <p>Logout</p>
                                   </a>
                               </li>

                           </ul>
                       </nav>
                   @break

                   @case('Office Head')
                       <nav class="mt-2">
                           <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                               data-accordion="false">
                               <li class="nav-item">
                                   <a href="{{ route('administrator.dashboard') }}"
                                       class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                                       <i class="fa-solid fa-gauge-high nav-icon"></i>
                                       <p>Dashboard</p>
                                   </a>
                               </li>


                               <li class="nav-header">Accounts</li>


                               <li class="nav-item">
                                   <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                       <i class="fa-solid fa-user-tie nav-icon"></i>
                                       <p>My Account</p>
                                   </a>
                               </li>

                               <li class="nav-header">Settings</li>


                               <li class="nav-item">
                                   <a href="" class="nav-link">
                                       <i class="fa-solid fa-map-location-dot nav-icon"></i>
                                       <p>Fixed Location</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="" class="nav-link">
                                       <i class="fa-solid fa-map-location-dot nav-icon"></i>
                                       <p>Message Request</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="{{ route('auth.logout') }}" class="nav-link">
                                       <i class="fa-solid fa-arrow-right-from-bracket nav-icon"></i>
                                       <p>Logout</p>
                                   </a>
                               </li>

                           </ul>
                       </nav>
                   @break

                   @default
                       <nav class="mt-2">
                           <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                               data-accordion="false">
                               <li class="nav-item">
                                   <a href="{{ route('administrator.dashboard') }}"
                                       class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                                       <i class="fa-solid fa-gauge-high nav-icon"></i>
                                       <p>Dashboard</p>
                                   </a>
                               </li>


                               <li class="nav-header">Accounts</li>


                               <li class="nav-item">
                                   <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                       <i class="fa-solid fa-user-tie nav-icon"></i>
                                       <p>My Account</p>
                                   </a>
                               </li>

                               <li class="nav-header">Settings</li>


                               <li class="nav-item">
                                   <a href="{{ route('auth.logout') }}" class="nav-link">
                                       <i class="fa-solid fa-map-location-dot nav-icon"></i>
                                       <p>Fixed Location</p>
                                   </a>
                               </li>
                               <li class="nav-item">
                                   <a href="{{ route('auth.logout') }}" class="nav-link">
                                       <i class="fa-solid fa-arrow-right-from-bracket nav-icon"></i>
                                       <p>Logout</p>
                                   </a>
                               </li>

                           </ul>
                       </nav>
               @endswitch



               </>
               <!-- /.sidebar -->
       </aside>
