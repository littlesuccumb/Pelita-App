<!-- Mobile Overlay -->
<div class="mobile-overlay lg:hidden" x-data="{ open: false }" 
     @toggle-mobile-menu.window="open = !open" 
     :class="{ 'open': open }" 
     @click="open = false">
</div>