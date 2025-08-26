@extends('layouts.admin') 

@guest
    <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/login') }}">{{ __('Login') }}</a> //修正
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/register') }}">{{ __('Register') }}</a> //修正
    </li>
@else
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('admin/logout') }}"     //修正
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" class="d-none"> //修正
                @csrf
            </form>
        </div>
    </li>
@endguest

