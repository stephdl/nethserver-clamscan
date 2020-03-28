<!--
#
# Copyright (C) 2019 Nethesis S.r.l.
# http://www.nethesis.it - nethserver@nethesis.it
#
# This script is part of NethServer.
#
# NethServer is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License,
# or any later version.
#
# NethServer is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with NethServer.  If not, see COPYING.
#
-->

<template>
<div id="app">
  <nav id="navbar-left" class="nav-pf-vertical nav-pf-vertical-with-sub-menus nav-pf-persistent-secondary panel-group">
    <ul class="list-group panel">
      <router-link tag="li" to="/Clamscan" active-class="active" class="list-group-item" id="Clamscan-item">
        <a>
          <span class="fa fa-gear"></span>
          <span class="list-group-item-value">{{$t('clamscan.title')}}</span>
        </a>
      </router-link>
      <li class="li-empty"></li>
      <router-link tag="li" to="/Detections" active-class="active" class="list-group-item" id="Detections-item">
        <a>
          <span class="fa fa-gear"></span>
          <span class="list-group-item-value">{{$t('detections.title')}}</span>
        </a>
      </router-link>
      <li class="li-empty"></li>
      <router-link tag="li" to="/Files" active-class="active" class="list-group-item" id="Files-item">
        <a>
          <span class="fa fa-gear"></span>
          <span class="list-group-item-value">{{$t('files.title')}}</span>
        </a>
      </router-link>
      <li class="li-empty"></li>
      <router-link tag="li" to="/Pua" active-class="active" class="list-group-item" id="Pua-item">
        <a>
          <span class="fa fa-gear"></span>
          <span class="list-group-item-value">{{$t('pua.title')}}</span>
        </a>
      </router-link>
      <li class="li-empty"></li>
      <router-link tag="li" to="/Signatures" active-class="active" class="list-group-item" id="Signatures-item">
        <a>
          <span class="fa fa-gear"></span>
          <span class="list-group-item-value">{{$t('signatures.title')}}</span>
        </a>
      </router-link>
      <li class="li-empty"></li>
      <router-link tag="li" to="/Quarantine" active-class="active" class="list-group-item" id="Quarantine-item">
        <a>
          <span class="fa fa-lock"></span>
          <span class="list-group-item-value">{{$t('quarantine.title')}}</span>
        </a>
      </router-link>
      <li class="li-empty"></li>
      <router-link tag="li" to="/logs" active-class="active" class="list-group-item">
        <a>
          <span class="fa fa-list"></span>
          <span class="list-group-item-value">{{$t('logs.title')}}</span>
        </a>
      </router-link>
      <router-link tag="li" to="/about" active-class="active" class="list-group-item">
        <a>
          <span class="fa fa-info"></span>
          <span class="list-group-item-value">{{$t('about.title')}}</span>
        </a>
      </router-link>
    </ul>
  </nav>
    <div class="container-fluid container-cards-pf">
        <router-view/>
    </div>
</div>
</template>
