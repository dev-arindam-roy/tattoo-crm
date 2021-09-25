<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel" style="background-color: #fff; text-align: center;">
      <a href="{{ route('dashboard') }}" id="brandBox">
        <img src="{{ asset('public/images/logo.png') }}" class="brandBox_logo">
      </a>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      
      <li class="">
        <a href="{{ route('dashboard') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      
      
      <li class="treeview @if(isset($GparentMenu) && $GparentMenu == 'management') active @endif">
        <a href="#">
          <i class="fa fa-bars" aria-hidden="true"></i> <span>User Management</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          
          <li class="treeview @if(isset($parentMenu) && $parentMenu == 'userManagement') active @endif">
            <a href="#">
              <i class="fa fa-user" aria-hidden="true"></i> <span>Admin Users</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              
              <li class="@if(isset($childMenu) && $childMenu == 'usersList') active @endif">
                <a href="{{ route('users_list') }}"><i class="fa fa-circle-o"></i> All Admin Users</a>
              </li>
              
              <li class="@if(isset($childMenu) && $childMenu == 'createUser') active @endif">
                <a href="{{ route('crte_user') }}"><i class="fa fa-circle-o"></i> Create Admin User</a>
              </li>
              
            </ul>
          </li>
          <li class="@if(isset($childMenu) && $childMenu == 'vendorList') active @endif">
            <a href=""><i class="fa fa-circle-o"></i> All Guest Users</a>
          </li>
        </ul>
      </li>     
      

      <li class="treeview @if(isset($parentMenu) && $parentMenu == 'tattooMng') active @endif">
        <a href="#">
          <i class="fa fa-bars" aria-hidden="true"></i> <span>Tattoo Management</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="@if(isset($childMenu) && $childMenu == 'tattoos') active @endif">
            <a href="{{ route('media_all_imgs') }}"><i class="fa fa-circle-o"></i> All Tattoos</a>
          </li>
          <li class="@if(isset($childMenu) && $childMenu == 'tattooAddEdit') active @endif">
            <a href="{{ route('media_img_add') }}"><i class="fa fa-circle-o"></i> Add Tattoo</a>
          </li>
          <li class="@if(isset($childMenu) && $childMenu == 'tattooCat') active @endif">
            <a href="{{ route('media_all_img_cats') }}"><i class="fa fa-circle-o"></i> Categories</a>
          </li>
        </ul>
      </li>
      
      <!--li class="header">SETTINGS</li-->
      <li class="treeview @if(isset($parentMenu) && $parentMenu == 'settings') active @endif">
        <a href="#">
          <i class="fa fa-cogs" aria-hidden="true"></i> <span>Settings</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
        
          <li class="@if(isset($childMenu) && $childMenu == 'genSett') active @endif">
            <a href="{{ route('gen_sett') }}"><i class="fa fa-circle-o"></i> General Settings</a>
          </li>
        
          <li class="@if(isset($childMenu) && $childMenu == 'profile') active @endif">
            <a href="{{ route('usr_profile') }}"><i class="fa fa-circle-o"></i> My Profile</a>
          </li>
          <li class="@if(isset($childMenu) && $childMenu == 'cngPwd') active @endif">
            <a href="{{ route('cng_pwd') }}"><i class="fa fa-circle-o"></i> Change Password</a>
          </li>
        </ul>
      </li>
      
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

<!-- =============================================== -->