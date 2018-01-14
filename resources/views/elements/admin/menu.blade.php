<?php

/*
 *  File:menu.blade.php  encoding:UTF-8
 *  Created at 01-14-2018 (mm/dd/yyyy) 01:09:07
 *  Belongs to project:lav_app
 *  Copyright © 2018  @KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */
?>

<div class="nav-side-menu">
    <div class="brand">Brand Logo</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

        <div class="menu-list">

            <ul id="menu-content" class="menu-content collapse out">
                <li>
                  <a href="#">
                  <i class="fa fa-dashboard fa-lg"></i> Dashboard
                  </a>
                </li>

                <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                  <a href="#"><i class="fas fa-file-alt fa-lg"></i> Posts <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse @if(Route::is ('adminpost*')) in @endif" id="products">
                    <li class=""><a href="#">CSS3 Animation</a></li>

                    <li class="@if(Route::current()->getName() == 'adminpostlist') active  @endif"><a href="{{route('adminpostlist')}}">post list</a></li>

                    <li class="@if(Route::current()->getName() == 'adminpostform') active  @endif"><a href="{{route('adminpostform')}}">post create</a></li>
                    <li><a href="#">FontAwesome</a></li>
                    <li><a href="#">Slider</a></li>
                    <li><a href="#">Panels</a></li>
                    <li><a href="#">Widgets</a></li>
                    <li><a href="#">Bootstrap Model</a></li>
                </ul>


                <li data-toggle="collapse" data-target="#service" class="collapsed">
                  <a href="#"><i class="fas fa-image fa-lg"></i> Media <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse @if(Route::is ('adminmedia*')) in @endif" id="service">

                    <li class="@if(Route::current()->getName() == 'adminmedialist') active  @endif"><a href="{{route('adminmedialist')}}">media list</a></li>
                    <li class="@if(Route::current()->getName() == 'adminmediaform') active  @endif"><a href="{{route('adminmediaform')}}">media add</a></li>
                  <li>New Service 3</li>
                </ul>


                <li data-toggle="collapse" data-target="#new" class="collapsed">
                  <a href="#"><i class="fa fa-car fa-lg"></i> New <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="new">
                  <li>New New 1</li>
                  <li>New New 2</li>
                  <li>New New 3</li>
                </ul>


                 <li>
                  <a href="#">
                  <i class="fa fa-user fa-lg"></i> Profile
                  </a>
                  </li>

                 <li>
                  <a href="#">
                  <i class="fa fa-users fa-lg"></i> Users
                  </a>
                </li>
            </ul>
     </div>
</div>