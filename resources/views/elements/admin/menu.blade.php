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

                        <nav class="navbar navbar-default navbar-static-top  ">
                            <div class="container">
                                <div class="navbar-header">

                                    <!-- Collapsed Hamburger -->
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                                        <span class="sr-only">Toggle Navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>

                                    <!-- Branding Image -->
                                    <a class="navbar-brand" href="{{ url('/') }}">
                                        {{ config('app.name', 'Laravel') }}
                                    </a>
                                </div>

                                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                                    <!-- Left Side Of Navbar -->
                                    <ul class="nav navbar-nav">
                                        &nbsp;
                                    </ul>

                                    <!-- Right Side Of Navbar -->
                                    <ul class="nav navbar-nav navbar-right">
                                        <!-- Authentication Links -->
                                        @guest
                                        <li><a href="{{ route('login') }}">Login</a></li>
                                        <li><a href="{{ route('register') }}">Register</a></li>
                                        @else
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-file-text-o"></i> Posts <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('adminpostlist') }}"><i class="fa fa-file-text"></i> List All Posts</a></li>
                                                <li><a href="{{ route('adminpostcreate') }}"><i class="fa fa-plus-square"></i> Add new Post</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-picture-o"></i> Media <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('adminmedialist') }}"><i class="fa fa-image"></i> List All Media</a></li>
                                                <li><a href="{{ route('adminmediaadd') }}"><i class="fa fa-plus-square"></i> Add New Media</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                                <i class="fa fa-user-o"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                            </a>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                                               document.getElementById('logout-form').submit();">
                                                        Logout
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                        @endguest
                                    </ul>
                                </div>
                            </div>
                        </nav>