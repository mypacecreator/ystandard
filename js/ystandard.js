"use strict";document.addEventListener("DOMContentLoaded",function(){var a=document.getElementById("global-nav__search-button");a&&a.addEventListener("click",function(){var a=document.getElementById("global-nav__search");a&&a.classList.toggle("is-active")}),document.getElementById("global-nav__toggle").addEventListener("click",function(a){a.currentTarget.classList.toggle("is-open")});for(var b=document.querySelectorAll("a[href^=\"#\"]"),c=0;c<b.length;c++)b[c].addEventListener("click",function(a){a.preventDefault();var b=a.currentTarget.getAttribute("href").replace("#",""),c=document.getElementById(b);if(c){var d=c.getBoundingClientRect().top;window.scroll({top:d+window.pageYOffset-48,behavior:"smooth"})}})});