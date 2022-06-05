<?php

use Illuminate\Support\Facades\Auth;
?>
<nav class="navbar navbar-expand-lg navbar-light bg-success bg-opacity-75">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
      
        <img src="{{URL::asset('logo/logo.png')}}" class="img-fluid" style="width: 100px;">
      
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
      
      <ul class="navbar-nav ">
        <li class="nav-item mx-5 fs-4 ">
          <a class="nav-link " aria-current="page" href="/tienda">{{__('Shop')}}</a>
        </li>
        <li class="nav-item mx-5 fs-4">
          <a class="nav-link" href="/afiliados">{{__('Affiliates')}}</a>
        </li>
        <li class="nav-item dropdown mx-5 fs-4">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">{{__('About us')}}</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/QuienesSomos">{{__('What we are?')}}</a></li>

            <?php

            if (!Auth::user()) {

            ?>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" onclick="alert('Debes estar registrado para poder afiliarte.')" href="#">{{__('Join us')}}</a></li>
            <?php
            } else if (!Auth::user()->esAfiliado())//da error pero funciona 
            { 
            ?>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="/afiliarse/{{Auth::user()->id;}}">{{__('Join us')}}</a></li>
            <?php
            }

            ?>
          </ul>
        </li>
        </ul>
        <?php
        if (!Auth::user()) {
        ?>
        <ul class="navbar-nav justify-content-end mb-2 mb-lg-0">
          <li class="nav-item mx-5 fs-4">
            <a class="nav-link  " href="/login">{{__('Log in')}}</a>
          </li>
          <li class="nav-item mx-5 fs-4" >
            <a class="nav-link  " href="/register">{{__('Register')}}</a>
          </li>
        </ul>
        <?php
        } else{
        ?>   
      
      <ul class="navbar-nav justify-content-end mb-2 mb-lg-0">
      <li class="nav-item dropdown">
          <a class="nav-link mx-3 dropdown-toggle mx-5 fs-4" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">{{__('My site')}}</a>
          <ul class="dropdown-menu ">
        
          <li><a class="dropdown-item"  href="/perfil/{{Auth::user()->id;}}">{{__('Profile')}}</a></li>
          <li><a class="dropdown-item"  href="/verCesta/{{Auth::user()->id;}}">{{__('Cart')}}</a></li>
          <?php
        
          if (Auth::user()->esAfiliado()) {
          ?>
          <li>
                <hr class="dropdown-divider">
              </li>
            <li><a class="dropdown-item" href="/crearProducto/{{Auth::user()->id}}">{{__('Create a product')}}</a></li>
            <li><a class="dropdown-item" href="/misProductos/{{Auth::user()->id}}">{{__('Manage products')}}</a></li>
            <li><a class="dropdown-item" href="/darseDeBaja/{{Auth::user()->id}}">{{__('Drop out')}}</a></li>
          
          <?php
          }
          ?>
          </ul>
          <li class="nav-item mx-5 fs-4">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{__('Leave')}}</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
      </ul>
      <?php
        }
      ?>
      <div class="mx-5 px-2"></div>
    </div>
  </div>
</nav>