<?php
/**
 * @author Fudio101
 * Date: 18/04/2022
 * Time: 10:54
 */
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="#"><img src="{{asset('assets/images/logo.svg')}}"
                                                                   alt="logo"/></a>
        <a class="sidebar-brand brand-logo-mini" href="#"><img
                src="{{asset('assets/images/logo-mini.svg')}}"
                alt="logo"/></a>
    </div>
    <ul class="nav">
        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{route('sign')}}">
              <span class="menu-icon">
                <i class="mdi mdi-pen"></i>
              </span>
                <span class="menu-title">Sign</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{route('verify')}}">
              <span class="menu-icon">
                <i class="mdi mdi-check-decagram"></i>
              </span>
                <span class="menu-title">Verify</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
               aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
                <span class="menu-title">Basic UI Elements</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
