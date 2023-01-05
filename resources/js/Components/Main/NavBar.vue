<template>

<nav class="navbar navbar-expand-sm bg-light">

<!-- Links -->
<ul class="navbar-nav">
  <li class="nav-item">
    <Link class="navbar-brand" :href="route('dashboard')">Navbar</Link>
  </li>
  <li class="nav-item">
    <Link class="nav-link active" aria-current="page" :href="route('student')">Student list</Link>
  </li>
  <li class="nav-item">
    <Link class="nav-link active" aria-current="page" :href="route('login')">Login</Link>
  </li>
  <li class="nav-item">
    <Link class="nav-link active" aria-current="page" :href="route('register')">Register</Link>
  </li>
   

</ul>

</nav>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3'
export default{
    components:{
        Link
    }
}
</script>

<style>

</style>
