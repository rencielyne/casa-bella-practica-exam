/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import mixins from './mixins';

const app = createApp({});

import RegisterComponent from './components/RegisterComponent.vue';
app.component('register-component', RegisterComponent);

app.use(VueSweetalert2);
app.mixin(mixins);
app.mount('#app');
